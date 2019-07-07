<?php

function dump_sql($builder)
{
    $sql = $builder->toSql();
    $bindings = $builder->getBindings();

    array_walk($bindings, function ($value) use (&$sql) {
        $value = is_string($value) ? var_export($value, true) : $value;
        $sql = preg_replace("/\?/", $value, $sql, 1);
    });
    return $sql;
}
