<?php

function str_between($subject, $beginning, $end = null)
{
    if (is_null($end)) {
        $end = $beginning;
    }

    return str_before(str_after($subject, $beginning), $end);
}
