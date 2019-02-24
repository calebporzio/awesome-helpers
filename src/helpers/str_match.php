<?php

function str_match($string, $pattern)
{
    $quotedDelimiter = preg_quote(substr($pattern, 0, 1), '#');

    if (1 !== preg_match("#^($quotedDelimiter).*\\1[imsxeADSUXJu]*$#", $pattern)) {
        $pattern = '#'.preg_quote($pattern, '#').'#';
    }

    return 1 === preg_match($pattern, $string);
}
