<?php

function money($input, $showCents = true)
{
    setlocale(LC_MONETARY, locale_get_default());

    $numberOfDecimalPlaces = $showCents ? 2 : 0;

    return money_format('%.'.$numberOfDecimalPlaces.'n', $input);
}
