<?php

use Sofa\LaravelTestGenerator\TestMethod;

return [
    'defaults' => [
        [],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'test_store',
            "\$this->post('api/users', [/* valid payload here */])->assertStatus(201);",
            false
        ),
    ],

    'camel_case_prefix' => [
        [
            'method_case' => 'camel',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'testStore',
            "\$this->post('api/users', [/* valid payload here */])->assertStatus(201);",
            false,
        ),
    ],

    'snake_case_prefix' => [
        [
            'method_case' => 'snake',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'test_store',
            "\$this->post('api/users', [/* valid payload here */])->assertStatus(201);",
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
            'store',
            "\$this->post('api/users', [/* valid payload here */])->assertStatus(201);",
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
            'store',
            "\$this->post('api/users', [/* valid payload here */])->assertStatus(201);",
            true,
        ),
    ],
];
