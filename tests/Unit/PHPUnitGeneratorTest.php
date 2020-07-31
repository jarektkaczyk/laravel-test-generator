<?php


namespace Sofa\LaravelTestGenerator\Tests\Unit;


use PHPUnit\Framework\TestCase;
use Sofa\LaravelTestGenerator\Generators\PHPUnitGenerator;
use Sofa\LaravelTestGenerator\RouteParser;
use Sofa\LaravelTestGenerator\TestMethod;
use Sofa\LaravelTestGenerator\Tests\LoadsFixtures;

class PHPUnitGeneratorTest extends TestCase
{
    use LoadsFixtures;

    /** @dataProvider getIndexConfigsHappyPath */
    public function testGenerateIndexHappyPath(array $config, TestMethod $output)
    {
        $generator = new PHPUnitGenerator($config);
        $route = new RouteParser(
            $this->loadRoutes('prefix_crud')->first()
        );

        $this->assertEquals($output, $generator->generateHappyPath($route));
    }

    /** @dataProvider getShowConfigsFailingPath */
    public function testGenerateShowFailingPath(array $config, TestMethod $output)
    {
        $generator = new PHPUnitGenerator($config);
        $route = new RouteParser(
            $this->loadRoutes('prefix_crud')->where('action.as', 'api.users.show')->first()
        );

        $this->assertEquals($output, $generator->generateFailingPath($route));
    }

    /** @dataProvider getStoreConfigsHappyPath */
    public function testGenerateStoreHappyPath(array $config, TestMethod $output)
    {
        $generator = new PHPUnitGenerator($config);
        $route = new RouteParser(
            $this->loadRoutes('prefix_crud')->where('action.as', 'api.users.store')->first()
        );

        $this->assertEquals($output, $generator->generateHappyPath($route));
    }

    /** @dataProvider getStoreConfigsFailingPath */
    public function testGenerateStoreFailingPath(array $config, TestMethod $output)
    {
        $generator = new PHPUnitGenerator($config);
        $route = new RouteParser(
            $this->loadRoutes('prefix_crud')->where('action.as', 'api.users.store')->first()
        );

        $this->assertEquals($output, $generator->generateFailingPath($route));
    }

    public function getIndexConfigsHappyPath()
    {
        return $this->loadDataProvider('crud_index_happy_path');
    }

    public function getShowConfigsFailingPath()
    {
        return $this->loadDataProvider('crud_show_failing_path');
    }

    public function getStoreConfigsHappyPath()
    {
        return $this->loadDataProvider('crud_store_happy_path');
    }

    public function getStoreConfigsFailingPath()
    {
        return $this->loadDataProvider('crud_store_failing_path');
    }
}
