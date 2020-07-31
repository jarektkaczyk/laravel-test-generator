<?php

namespace Sofa\LaravelTestGenerator\Tests;

use Illuminate\Container\Container;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

trait LoadsFixtures
{
    /**
     * @param string $filename
     * @return Collection|Route[]
     */
    public function loadRoutes(string $filename): Collection
    {
        /** @see RouteCollectionInterface::getRoutes() */
        $routes = require(__DIR__ . '/__fixtures__/routes/' . $filename . '.php');

        return collect($routes)
            ->each(fn (Route $route) => $route->setContainer(new Container));
    }

    public function loadDataProvider(string $filename): array
    {
        return require(__DIR__ . '/__fixtures__/data_providers/' . $filename . '.php');
    }
}
