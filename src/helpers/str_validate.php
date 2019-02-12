<?php

use Illuminate\Support\Str;

function str_validate($data, $rules)
{
    return Str::validate($data, $rules);
}
