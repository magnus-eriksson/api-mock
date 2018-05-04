<?php namespace Tests;

/**
 * This is an example test that gets the app instance, loads routes
 * and mocks a call to the home-controller and 404 page
 */

use PHPUnit\Framework\TestCase;

/**
 * @coversClass App\Controllers\HomeController
 */
class ExampleTest extends TestCase
{
    /**
     * The main app instance
     * @var Enstart\App
     */
    protected $app;


    /**
     * Get and boot the main app instance
     */
    public function setUp()
    {
        // Get the app instance
        $this->app = require_once __DIR__ . '/boot.php';

        // Load routes and route filters
        require_once $this->app->path('app') . '/filters.php';
        require_once $this->app->path('app') . '/routes.php';
    }


    /**
    * @covers ::home
    */
    public function testHome()
    {
        // Dispatch the router as a GET request and the uri '/'
        $response = $this->app->router->dispatch('GET', '/');

        // If we get a string back, it most likely means that we got
        // a rendered view (which is exactly what we want).
        $this->assertInternalType('string', $response);
    }
}
