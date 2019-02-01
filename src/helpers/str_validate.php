<?php

use Illuminate\Support\Facades\Validator;

function str_validate($data, $rules, $default = null)
{
    return collect(
        Validator::make(['placeholder' => $data], ['placeholder' => $rules])
            ->errors()
            ->get('placeholder')
    )->map(function ($message) {
        return str_replace('The placeholder', 'This', $message);
    });
}
