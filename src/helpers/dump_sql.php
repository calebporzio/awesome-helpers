<?php

use Illuminate\Database\Query\Builder;

function dump_sql(Builder $builder)
{
    $sql = $builder->toSql();
    $bindings = $builder->getBindings();

    array_walk($bindings, function ($value) use (&$sql) {
        $value = is_string($value) ? var_export($value, true) : $value;
        $sql = preg_replace("/\?/", $value, $sql, 1);
    });
    return $sql;
}

