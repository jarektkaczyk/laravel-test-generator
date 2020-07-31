<?php

namespace Sofa\LaravelTestGenerator;

use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RouteParser
{
    private Route $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function getControllerClassname(): string
    {
        return get_class($this->route->getController());
    }

    public function getControllerMethod(): string
    {
        return $this->route->getActionMethod();
    }

    public function getHttpMethod(): string
    {
        return strtoupper(Arr::first($this->route->methods()));
    }

    public function getUri(): string
    {
        return $this->route->uri();
    }

    public function getSuccessHttpCode(): int
    {
        return $this->getHttpMethod() === 'POST'
            ? Response::HTTP_CREATED
            : Response::HTTP_OK;
    }

    public function getErrorHttpCode(): int
    {
        return in_array($this->getHttpMethod(), ['POST', 'PUT', 'PATCH'])
            ? Response::HTTP_UNPROCESSABLE_ENTITY
            : Response::HTTP_NOT_FOUND;
    }

    public function needsFailingPath(): bool
    {
        return $this->getErrorHttpCode() === Response::HTTP_UNPROCESSABLE_ENTITY
            || Str::contains($this->getUri(), '{');
    }
}
