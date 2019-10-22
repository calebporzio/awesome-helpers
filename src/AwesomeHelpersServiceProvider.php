<?php

namespace Calebporzio\AwesomeHelpers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AwesomeHelpersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Str::mixin(new StrMacros);

        foreach (glob(__DIR__ . '/helpers/*.php') as $helperFile) {

            $function = Str::before(basename($helperFile), '.php');

            if (function_exists($function)) {
                continue;
            }

            require_once $helperFile;
        }
    }
}
