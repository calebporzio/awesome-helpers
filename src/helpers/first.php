<?php

function first($var)
{
    if(is_scalar($var) || $var === null) {
        return $var;
    }

    if(is_array($var)) {
        return isset(array_keys($var)[0]) ? ($var[array_keys($var)[0]]) : null;
    }

    if($var instanceof \Illuminate\Support\Collection) {
        return isset($var[0]) ? $var[0] : $var;
    }

    if(is_object($var)) {
        foreach($var as $v) {
            if(is_array($v)) {
                return $v;
            }

            return $var;
        }
    }
}