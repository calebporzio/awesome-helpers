<?php

/**
 * Loop through multiple arrays in parallel
 *
 * @param Closure $callback
 * @param iterable ...$arrays
 * @return array
 */
if (!function_exists('map')) {
    function map(\Closure $callback, ...$arrays)
    {
        $result = [];

        foreach (array_map(null, ...$arrays) as $values) {
            $result[] = call_user_func_array($callback, $values);
        }

        return $result;
    }
}
