<?php

namespace Sofa\LaravelTestGenerator;

/**
 * Filters out routes for which we don't want to generate tests:
 * - existing
 * - non-applicable (config)
 */
class Filter
{
    public function __invoke(TestMethod $test)
    {
        // TODO currently we'll simply skip existing tests for simplicity, later we'd like to add new test cases instead
        return !class_exists($test->classname);
    }
}
