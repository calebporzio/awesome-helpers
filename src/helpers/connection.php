<?php

function connection(string $connection, $callback)
{
    $default = config('database.default');
    config()->set('database.default', $connection);

    return tap($callback(), function () use ($default) {
        config()->set('database.default', $default);
    });
}
