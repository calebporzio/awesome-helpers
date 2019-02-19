<?php

function user($guard = null)
{
    return is_null($guard) ? auth()->user() : auth($guard)->user();
}
