<?php

use Illuminate\Support\Str;

function str_match($string, $pattern)
{
    return Str::match($string, $pattern);
}
