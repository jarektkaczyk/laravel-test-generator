<?php

use Sofa\LaravelTestGenerator\TestMethod;

return [
    'defaults' => [
        [],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'test_index',
            "\$this->get('api/users')->assertStatus(200);",
            false
        ),
    ],

    'camel_case_prefix' => [
        [
            'method_case' => 'camel',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'testIndex',
            "\$this->get('api/users')->assertStatus(200);",
            false,
        ),
    ],

    'snake_case_prefix' => [
        [
            'method_case' => 'snake',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'test_index',
            "\$this->get('api/users')->assertStatus(200);",
            false,
        ),
    ],

    'camel_case_annotation' => [
        [
            'method_case' => 'camel',
            'method_naming' => 'annotation',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'index',
            "\$this->get('api/users')->assertStatus(200);",
            true,
        ),
    ],

    'snake_case_annotation' => [
        [
            'method_case' => 'snake',
            'method_naming' => 'annotation',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'index',
            "\$this->get('api/users')->assertStatus(200);",
            true,
        ),
    ],
];
