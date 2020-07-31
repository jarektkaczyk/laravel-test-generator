<?php

namespace Sofa\LaravelTestGenerator\Tests\Integration;

use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use PHPUnit\Framework\TestCase;
use Sofa\LaravelTestGenerator\Commands\GeneratorCommand;
use Sofa\LaravelTestGenerator\Generators\PHPUnitGenerator;
use Sofa\LaravelTestGenerator\Tests\LoadsFixtures;

class GeneratorCommandTest extends TestCase
{
    use LoadsFixtures;

    private string $generatedPath = __DIR__ . '/../__output__/Feature/Http/Controllers/UserControllerTest.php';
    private string $methodNaming;

    protected function setUp(): void
    {
        parent::setUp();
        $this->prepareOutputPath();
    }

    protected function tearDown(): void
    {
        // In order to leave the output for easier testing, but ignore it by the autoloader during the next run
        rename($this->generatedPath, $this->generatedPath . '-generated-' . $this->methodNaming);
        parent::tearDown();
    }

    /**
     * @dataProvider methodNamings
     * @param string $methodNaming
     */
    public function testGenerateFeatureTestsForSingleCrudController(string $methodNaming)
    {
        $this->methodNaming = $methodNaming;

        $routesCollection = new RouteCollection();
        foreach ($this->loadRoutes('crud') as $route) {
            $routesCollection->add($route);
        }

        $command = new GeneratorCommand;
        $router = $this->createMock(Router::class);
        $router->method('getRoutes')->willReturn($routesCollection);

        $command->handle(new PHPUnitGenerator([
            'tests_base_path' => __DIR__ . '/../__output__/Feature',
            'tests_namespace' => 'LaravelTestGeneratorTests\Feature',
            'base_test_case' => 'LaravelTestGeneratorTests\TestCase',
            'method_naming' => $methodNaming,
        ]), $router);

        $this->assertTrue(file_exists($this->generatedPath));
    }

    protected function prepareOutputPath(): void
    {
        $outputPath = __DIR__ . '/../__output__';
        if (realpath($outputPath)) {
            shell_exec('rm -r ' . escapeshellcmd(realpath($outputPath)));
        }
        mkdir($outputPath);
    }

    public function methodNamings()
    {
        return [
            ['prefix'],
            ['annotation'],
        ];
    }
}
