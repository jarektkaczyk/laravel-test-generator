<?php

use Sofa\LaravelTestGenerator\TestMethod;

return [
    'defaults' => [
        [],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'test_store_failing',
            "\$this->post('api/users', [/* invalid payload here */])->assertStatus(422);",
            false
        ),
    ],

    'camel_case_prefix' => [
        [
            'method_case' => 'camel',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'testStoreFailing',
            "\$this->post('api/users', [/* invalid payload here */])->assertStatus(422);",
            false,
        ),
    ],

    'snake_case_prefix' => [
        [
            'method_case' => 'snake',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'test_store_failing',
            "\$this->post('api/users', [/* invalid payload here */])->assertStatus(422);",
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
            'storeFailing',
            "\$this->post('api/users', [/* invalid payload here */])->assertStatus(422);",
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
            'store_failing',
            "\$this->post('api/users', [/* invalid payload here */])->assertStatus(422);",
            true,
        ),
    ],
];
