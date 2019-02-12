<?php

use Illuminate\Support\Str;

function str_between($subject, $beginning, $end = null)
{
    return Str::between($subject, $beginning, $end);
}
