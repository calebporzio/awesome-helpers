<?php

function str_extract($string, $pattern)
{
    if (@preg_match($pattern, $string) === false) {
        $pattern = '#'.preg_quote($pattern, '#').'#';
    }

    preg_match($pattern, $string, $matches);

    return $matches[1] ?? null;
}
