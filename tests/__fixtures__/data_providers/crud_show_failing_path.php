<?php

use Sofa\LaravelTestGenerator\TestMethod;

return [
    'defaults' => [
        [],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'test_show_failing',
            "\$this->get('api/users/0')->assertStatus(404);",
            false
        ),
    ],

    'camel_case_prefix' => [
        [
            'method_case' => 'camel',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'testShowFailing',
            "\$this->get('api/users/0')->assertStatus(404);",
            false,
        ),
    ],

    'snake_case_prefix' => [
        [
            'method_case' => 'snake',
        ],
        new TestMethod(
            'Tests\Feature\Http\Controllers\UserControllerTest',
            'test_show_failing',
            "\$this->get('api/users/0')->assertStatus(404);",
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
            'showFailing',
            "\$this->get('api/users/0')->assertStatus(404);",
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
            'show_failing',
            "\$this->get('api/users/0')->assertStatus(404);",
            true,
        ),
    ],
];
