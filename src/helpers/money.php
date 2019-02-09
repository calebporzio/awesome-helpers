<?php

function money($input, $showCents = true, $locale = null)
{
    setlocale(LC_MONETARY, $locale ?? locale_get_default());

    $numberOfDecimalPlaces = $showCents ? 2 : 0;

    return money_format('%.' . $numberOfDecimalPlaces . 'n', $input);
}
