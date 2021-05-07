<?php

function money($input, $showCents = true, $locale = null)
{
    setlocale(LC_MONETARY, $locale ?: app()->getLocale());
    
    $numberOfDecimalPlaces = $showCents ? 2 : 0;

    $formatter = numfmt_create('en_US', \NumberFormatter::CURRENCY);
    $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $numberOfDecimalPlaces);

    return numfmt_format_currency($formatter, $input, trim(localeconv()['int_curr_symbol']));
}
