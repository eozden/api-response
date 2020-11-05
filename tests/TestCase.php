<?php

namespace Eozden\ApiResponse\Tests;

use Eozden\ApiResponse\ApiResponseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ApiResponseServiceProvider::class,
        ];
    }    
}