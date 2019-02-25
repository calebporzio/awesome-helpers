<?php

function str_match($string, $pattern)
{
    if (false === @preg_match($pattern, $string)) {
		$pattern = '#'.preg_quote($pattern, '#').'#';
    }

    return 1 === preg_match($pattern, $string);
}
