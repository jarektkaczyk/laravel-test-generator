<?php

namespace Sofa\LaravelTestGenerator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Sofa\LaravelTestGenerator\RouteParser;
use Sofa\LaravelTestGenerator\Tests\LoadsFixtures;

/**
 * @see RouteParser
 */
class RouteParserTest extends TestCase
{
    use LoadsFixtures;

    public function testParseCrudRoutes()
    {
        $routes = $this->loadRoutes('crud');

        $parser = new RouteParser($routes->first());
        $this->assertSame('App\Http\Controllers\UserController', $parser->getControllerClassname());
        $this->assertSame('index', $parser->getControllerMethod());
        $this->assertSame('GET', $parser->getHttpMethod());
    }
}
