<?php

namespace Sofa\LaravelTestGenerator;

use Illuminate\Support\Collection;

interface Generator
{
    /**
     * Generate the happy path test case, usually 200 OK http response
     * @param RouteParser $route
     * @return TestMethod
     */
    public function generateHappyPath(RouteParser $route): TestMethod;

    /**
     * Generate the failing path test case, usually 404 NOT FOUND or 422 UNPROCESSABLE ENTITY (aka validation failed)
     * @param RouteParser $route
     * @return TestMethod
     */
    public function generateFailingPath(RouteParser $route): TestMethod;

    /**
     * Generate the test file for a single controller
     * @param string $fqcn Fully qualified test class name to generate
     * @param Collection|TestMethod[] $tests Collection of tests to generate
     * @psalm-param Collection<int, TestMethod> $tests
     */
    public function generateTestFile(string $fqcn, Collection $tests): void;
}
