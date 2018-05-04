<?php namespace App\Providers;

use Enstart\Container\ContainerInterface;
use Enstart\ServiceProvider\ServiceProviderInterface;

class AppProvider implements ServiceProviderInterface
{
    /**
     * Register the service provider
     *
     * @param  ContainerInterface $c
     */
    public function register(ContainerInterface $c)
    {
        $c->singleton('Maer\Auth\SecurityInterface', 'Maer\Auth\Security');
        $c->singleton('Maer\Auth\AuthInterface', 'App\Services\Auth');

        $c->singleton('Maer\FileDB\FileDB', function ($c) {
            $path = $c->config->get('data.db');
            $driver = new \Maer\FileDB\Storage\FileSystem($path);
            return new \Maer\FileDB\FileDB($driver);
        });

        $c->singleton('App\Services\Resources', function ($c) {
            return new \App\Services\Resources(
                $c->make('Maer\FileDB\FileDB'),
                $c->config->get('data.content')
            );
        });
    }
}
