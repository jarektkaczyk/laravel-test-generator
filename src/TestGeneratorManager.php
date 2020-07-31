<?php

namespace Sofa\LaravelTestGenerator;

use Illuminate\Support\Manager;
use Sofa\LaravelTestGenerator\Generators\PHPUnitGenerator;

class TestGeneratorManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->config->get('test_generator.driver');
    }

    protected function createPhpunitDriver(): PHPUnitGenerator
    {
        return new PHPUnitGenerator(
            $this->config->get('test_generator.drivers.phpunit')
        );
    }
}
