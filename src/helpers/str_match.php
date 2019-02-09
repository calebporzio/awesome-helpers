<?php

function str_match($string, $pattern)
{
    preg_match($pattern, $string, $matches);

    return $matches[1] ?? false;
}
