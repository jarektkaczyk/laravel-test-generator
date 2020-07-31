<?php

return [
    /**
     * Choose the testing driver/framework you are using
     * @see \Sofa\LaravelTestGenerator\Generator
     *
     * Currently supported:
     * - phpunit
     */
    'driver' => 'phpunit',

    'drivers' => [
        'phpunit' => [
            /**
             * PHPUnit test method naming @link https://phpunit.readthedocs.io/en/9.2/writing-tests-for-phpunit.html
             * - `prefix` -> create methods with 'test' prefix
             * - `annotation` -> create methods with '@test' annotation
             */
            'method_naming' => 'prefix',

            /**
             * Test method naming case
             * - `snake` -> 'test_some_method()'
             * - `camel` -> 'testSomeMethod()'
             */
            'method_case' => 'snake',

            /**
             * Your base application root namespace
             */
            'base_namespace' => 'App',

            /**
             * Base namespace for generated Feature tests
             */
            'tests_namespace' => 'Tests\Feature',

            /**
             * Base path where tests will be generated
             */
            'tests_base_path' => base_path('tests/Feature'),

            /**
             * Default TestCase class in a Laravel app that generated tests will extend
             */
            'base_test_case' => 'Tests\TestCase',
        ],
    ],
];
