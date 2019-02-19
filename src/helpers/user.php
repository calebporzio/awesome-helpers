<?php

function user($guard = null)
{
    if($guard) {
        return auth($guard)->user();
    }

    return auth()->user();
}
