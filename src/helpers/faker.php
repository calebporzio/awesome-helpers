<?php

use Faker\Factory;

function faker($property = null)
{
    $faker = Factory::create();

    return $property ? $faker->{$property} : $faker;
}
