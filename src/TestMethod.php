<?php

namespace Sofa\LaravelTestGenerator;

class TestMethod
{
    /** @var string Class name of the test to generate */
    public string $classname;
    /** @var string Method name of the test case to generate */
    public string $name;
    /** @var string Body of the test case */
    public string $expression;
    /** @var bool Whether or not to generate the annotation - applicable for PHPUnit */
    public bool $test_annotation;

    public function __construct(
        string $classname = '',
        string $name = '',
        string $expression = '',
        bool $test_annotation = false
    ) {
        $this->classname = $classname;
        $this->name = $name;
        $this->expression = $expression;
        $this->test_annotation = $test_annotation;
    }
}
