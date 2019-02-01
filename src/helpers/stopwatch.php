<?php

function stopwatch($callback, $times = 1)
{
    $totalTime = 0;

    foreach (range(1, $times) as $time) {
        $start = microtime(true);

        $callback();

        $totalTime += microtime(true) - $start;
    }

    return $totalTime / $times;
}
