<?php

use Illuminate\Database\Query\Builder;
if (!function_exists('dumpSql')) {
    /**
     * Print SQL query with bindings.
     *
     * @param Builder $builder
     * @return string
     */
    function dumpSql(Builder $builder)
    {
        $sql = $builder->toSql();
        $bindings = $builder->getBindings();

        array_walk($bindings, function ($value) use (&$sql) {
            $value = is_string($value) ? var_export($value, true) : $value;
            $sql = preg_replace("/\?/", $value, $sql, 1);
        });
        return $sql;
    }
}

