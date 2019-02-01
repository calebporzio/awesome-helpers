<?php

function str_between($subject, $beginning, $end)
{
    return str_before(str_after($subject, $beginning), $end);
}
