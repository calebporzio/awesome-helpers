<?php

use Illuminate\Support\Facades\Validator;

function str_validate($data, $rules) {
    return collect(
        Validator::make(['{placeholder}' => $data], ['{placeholder}' => $rules])
            ->errors()
            ->get('{placeholder}')
    )->map(function ($message) {
        return ucfirst(
            trim(
                str_replace('The {placeholder}', '',
                    str_replace('The selected {placeholder}', 'This selection', $message)
                )
            )
        );
    });
}
