<?php

namespace Sofa\LaravelTestGenerator\Generators;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\PsrPrinter;
use Sofa\LaravelTestGenerator\Generator;
use Sofa\LaravelTestGenerator\RouteParser;
use Sofa\LaravelTestGenerator\TestMethod;

class PHPUnitGenerator implements Generator
{
    private array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config + [
                'method_naming' => 'prefix',
                'method_case' => 'snake',
                'base_namespace' => 'App',
                'tests_namespace' => 'Tests\Feature',
                'tests_base_path' => __DIR__ . '/../../../../tests/Feature',
                'base_test_case' => 'Tests\TestCase',
            ];
    }

    public function generateHappyPath(RouteParser $route): TestMethod
    {
        return $this->generateTestMethod($route);
    }

    public function generateFailingPath(RouteParser $route): TestMethod
    {
        return $this->generateTestMethod($route, false);
    }

    private function generateHappyPathExpression(RouteParser $route): string
    {
        // TODO add setup for test method
        $setup = '';
        $uri = str_replace('{user}', '0', $route->getUri());

        $payload = in_array($route->getHttpMethod(), ['POST', 'PUT', 'PATCH'])
            ? ', [/* valid payload here */]'
            : '';

        return trim(vsprintf("%s\n\n\$this->%s('%s'%s)->assertStatus(%d);", [
            $setup,
            strtolower($route->getHttpMethod()),
            $uri,
            $payload,
            $route->getSuccessHttpCode(),
        ]));
    }

    private function generateFailingExpression(RouteParser $route): string
    {
        $setup = '';
        $uri = str_replace('{user}', '0', $route->getUri());

        $payload = in_array($route->getHttpMethod(), ['POST', 'PUT', 'PATCH'])
            ? ', [/* invalid payload here */]'
            : '';

        return trim(vsprintf("%s\n\n\$this->%s('%s'%s)->assertStatus(%d);", [
            $setup,
            strtolower($route->getHttpMethod()),
            $uri,
            $payload,
            $route->getErrorHttpCode(),
        ]));
    }

    /**
     * @param RouteParser $route
     * @param bool $happy
     * @return TestMethod
     */
    private function generateTestMethod(RouteParser $route, bool $happy = true): TestMethod
    {
        $test = new TestMethod;

        // test class name
        $test->classname = str_replace(
            $this->config['base_namespace'],
            $this->config['tests_namespace'],
            $route->getControllerClassname() . 'Test',
        );

        // test method name
        $case = $this->config['method_case'];
        $testMethod = $route->getControllerMethod();

        if (!$happy) {
            $testMethod .= '_failing';
        }

        if ($this->config['method_naming'] === 'annotation') {
            $test->test_annotation = true;
            $test->name = Str::$case($testMethod);
        } else {
            $test->name = Str::$case('test_' . $testMethod);
        }

        $test->expression = $happy
            ? $this->generateHappyPathExpression($route)
            : $this->generateFailingExpression($route);

        return $test;
    }

    public function getTestFilePath(string $classname): string
    {
        $relativePath = str_replace($this->config['tests_namespace'], '', $classname) . '.php';

        return sprintf(
            '%s/%s',
            $this->config['tests_base_path'],
            trim(str_replace('\\', '/', $relativePath), '/'),
        );
    }

    /**
     * @param string $fqcn
     * @param Collection|TestMethod[] $tests
     * @psalm-param Collection<int, TestMethod> $tests
     */
    public function generateTestFile(string $fqcn, Collection $tests): void
    {
        $path = $this->getTestFilePath($fqcn);

        $directory = pathinfo($path, PATHINFO_DIRNAME);

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        $testClassname = class_basename($fqcn);
        $namespace = trim(str_replace($testClassname, '', $fqcn), '\\');
        $ns = new PhpNamespace($namespace);
        $ns->addUse($this->config['base_test_case']);
        $class = $ns->addClass($testClassname);
        $class->setExtends($this->config['base_test_case']);

        // parse existing file and check which methods need to be added
        foreach ($tests as $test) {
            if (!$class->hasMethod($test->name)) {
                $method = $class->addMethod($test->name);
                $method->addBody($test->expression);
                if ($test->test_annotation) {
                    $method->addComment('@test');
                }
            }
        }

        $printer = new PsrPrinter;

        file_put_contents($path, "<?php\n\n" . $printer->printNamespace($ns));
    }
}
