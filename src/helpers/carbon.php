<?php

use Illuminate\Support\Carbon;

function carbon(...$args)
{
    return new Carbon(...$args);
}
