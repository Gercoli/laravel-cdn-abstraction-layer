<?php

namespace GErcoli\CDN\ServiceProviders;


use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

/**
 * The CDNServiceProvider class is designed to allow other packages to extend it
 * and gives them a set of methods to easily implement a CDN class which can be
 * used identically to others.
 *
 * @author Garry Ercoli <Garry@GErcoli.com>
 */
abstract class CDNServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;


    /**
     * Adds an artisan command.
     * @param string $commandName  The command used to trigger the class
     * @param string $commandClass The fully qualified class to trigger when the command is used.
     * @throws InvalidArgumentException
     * @return CDNServiceProvider
     */
    protected function addCommand($commandName, $commandClass)
    {
        if(!is_string($commandName)) {
            throw new InvalidArgumentException('Expected string for $commandName but received ' . gettype($commandName));
        }

        if(!is_string($commandClass)) {
            throw new InvalidArgumentException('Expected string for $commandClass but received ' . gettype($commandClass));
        }

        $this->app[$commandName] = $this->app->share(function() use ($commandClass) {
            return $this->app->make($commandClass);
        });

        $this->commands($commandName);

        return $this;
    }
}
