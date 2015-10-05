<?php

namespace GErcoli\CDN;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;

abstract class CDNServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;

    /**
     * Stores a list of the commands to be used.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Adds an artisan command.
     * @param string $commandName  The command used to trigger the class
     * @param string $commandClass The fully qualified class to trigger when the command is used.
     * @throws InvalidArgumentException
     * @return CDNServiceProvider
     */
    public function addCommand($commandName, $commandClass)
    {
        if(!is_string($commandName)) {
            throw new InvalidArgumentException('Expected string for $commandName but receieved ' . gettype($commandName));
        }

        if(!is_string($commandClass)) {
            throw new InvalidArgumentException('Expected string for $commandClass but receieved ' . gettype($commandClass));
        }

        $this->commands[$commandName] = $commandClass;

        return $this;
    }

    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    abstract public function register();
}
