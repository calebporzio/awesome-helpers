<?php

function user($guard = null)
{
    return auth($guard)->user();
}
