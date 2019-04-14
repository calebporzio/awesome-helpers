<?php

namespace Calebporzio\AwesomeHelpers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class StrMacros
{
    public function between()
    {
        return function ($subject, $beginning, $end = null) {
            if (is_null($end)) {
                $end = $beginning;
            }

            return Str::before(Str::after($subject, $beginning), $end);
        };
    }

    public function extract()
    {
        return function ($string, $pattern) {
            if (@preg_match($pattern, $string) === false) {
                $pattern = '#'.preg_quote($pattern, '#').'#';
            }

            preg_match($pattern, $string, $matches);

            return $matches[1] ?? null;
        };
    }

    public function match()
    {
        return function($string, $pattern) {
            if (@preg_match($pattern, $string) === false) {
                $pattern = '#'.preg_quote($pattern, '#').'#';
            }

            return preg_match($pattern, $string) === 1;
        };
    }

    public function validate()
    {
        return function($data, $rules) {
            return Collection::make(
                Validator::make(['{placeholder}' => $data], ['{placeholder}' => $rules])
                    ->errors()
                    ->get('{placeholder}')
            )->map(function ($message) {
                return ucfirst(
                    trim(
                        str_replace('The {placeholder}', '',
                            str_replace('The selected {placeholder}', 'This selection',
                                $message)
                        )
                    )
                );
            });
        };
    }

    public function wrap()
    {
        return function($value, $cap) {
            return Str::start(Str::finish($value, $cap), $cap);
        };
    }
}
