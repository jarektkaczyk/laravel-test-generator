<?php

namespace Sofa\LaravelTestGenerator\Tests\Unit;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Container\Container;
use PHPUnit\Framework\TestCase;
use Sofa\LaravelTestGenerator\Generators\PHPUnitGenerator;
use Sofa\LaravelTestGenerator\TestGeneratorManager;

class TestGeneratorManagerTest extends TestCase
{
    private TestGeneratorManager $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $config = new Repository([
            'test_generator' => [
                'driver' => 'phpunit',
                'drivers' => [
                    'phpunit' => [
                        'method_naming' => 'prefix',
                        'method_case' => 'snake',
                        'base_namespace' => 'App',
                        'tests_namespace' => 'Tests\Feature',
                        'tests_base_path' => __DIR__ . '/../Feature',
                        'base_test_case' => 'Tests\TestCase',
                    ],
                ],
            ],
        ]);
        $container = $this->createMock(Container::class);
        $container->method('make')->with('config')->willReturn($config);
        $this->manager = new TestGeneratorManager($container);
    }

    public function testDriver()
    {
        $this->assertInstanceOf(PHPUnitGenerator::class, $this->manager->driver());
    }
}
