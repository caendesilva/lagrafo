<?php

namespace DeSilva\Lagrafo\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \DeSilva\Lagrafo\LagrafoServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // $app['config']->set('lagrafo.foo', 'bar');
    }
}
