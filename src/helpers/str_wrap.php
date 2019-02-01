<?php

function str_wrap($value, $cap)
{
    return str_start(str_finish($value, $cap), $cap);
}
