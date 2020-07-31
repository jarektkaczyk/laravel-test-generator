<?php

namespace Sofa\LaravelTestGenerator;

use Illuminate\Support\ServiceProvider;
use Sofa\LaravelTestGenerator\Commands\GeneratorCommand;

class LaravelTestGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/test_generator.php' => config_path('test_generator.php'),
            ], 'config');

            $this->commands([
                GeneratorCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-test-generator');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/test_generator.php', 'laravel-test-generator');

        $this->app->bind(Generator::class, fn (): Generator => app(TestGeneratorManager::class)->driver());
    }
}
