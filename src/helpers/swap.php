<?php

function swap(&$a, &$b)
{
    $temp = $a;
    $a = $b;
    $b = $temp;
}
