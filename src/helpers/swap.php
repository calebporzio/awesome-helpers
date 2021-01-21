<?php

function swap(&$a, &$b)
{
    [$b, $a] = [$a, $b];
}
