<?php

namespace Laravel\Vapor\Runtime;

use Laravel\Vapor\Runtime\Handlers\CliHandler;
use Laravel\Vapor\Runtime\Handlers\QueueHandler;
use Laravel\Vapor\Runtime\Handlers\WarmerHandler;
use Laravel\Vapor\Runtime\Handlers\WarmerPingHandler;

class CliHandlerFactory
{
    /**
     * Create a new handler for the given CLI event.
     *
     * @param  array  $event
     * @return mixed
     */
    public static function make(array $event)
    {
        if (isset($event['vaporWarmer'])) {
            return new WarmerHandler;
        } elseif (isset($event['vaporWarmerPing'])) {
            return new WarmerPingHandler;
        }

        return isset($event['Records'][0]['messageId'])
                    ? new QueueHandler
                    : new CliHandler;
    }
}
