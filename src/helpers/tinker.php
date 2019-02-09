<?php

function tinker(...$args)
{
    if (empty($args)) {
        goto sorrynotsorryforusingagoto;
    }

    // Because there is no way of knowing what variable names
    // the caller of this function used with the php run-time,
    // we have to get clever. My solution is to peek at the
    // stack trace, open up the file that called "tinker()"
    // and parse out any variable names, so I can load
    // them in the tinker shell and preserve their names.

    $namedParams = collect(debug_backtrace())
        ->where('function', 'tinker')->take(1)
        ->map(function ($slice) {
            return array_values($slice);
        })
        ->mapSpread(function ($filePath, $lineNumber, $function, $args) {
            return file($filePath)[$lineNumber - 1];
            // "    tinker($post, new User);"
        })->map(function ($carry) {
            return str_before(str_after($carry, 'tinker('), ');');
            // "$post, new User"
        })->flatMap(function ($carry) {
            return array_map('trim', explode(',', $carry));
            // ["post", "new User"]
        })->map(function ($carry, $index) {
            return strpos($carry, '$') === 0
                ? str_after($carry, '$')
                : 'temp' . $index;
            // ["post", "temp1"]
        })
        ->combine($args)->all();
    // ["post" => $args[0], "temp1" => $args[1]]

    sorrynotsorryforusingagoto:

    echo PHP_EOL;
    $sh = new \Psy\Shell();
    $sh->setScopeVariables($namedParams ?? []);
    if ($sh->has('ls')) {
        $sh->addInput('ls', true);
    }
    $sh->run();
}