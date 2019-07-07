<?php

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

function dump_sql($builder)
{
    if(!(($builder instanceof Builder) || ($builder instanceof EloquentBuilder))) {
        throw new TypeError('Argument passed to '.__METHOD__.'() should be instance of '.Builder::class.' or '.EloquentBuilder::class.'. '.get_class($builder).' given.');
    }

    $sql = $builder->toSql();
    $bindings = $builder->getBindings();

    array_walk($bindings, function ($value) use (&$sql) {
        $value = is_string($value) ? var_export($value, true) : $value;
        $sql = preg_replace("/\?/", $value, $sql, 1);
    });
    return $sql;
}

