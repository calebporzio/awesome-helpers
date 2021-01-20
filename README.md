# A collection of awesome helpful functions for Laravel

![Travis CI status image](https://travis-ci.com/calebporzio/awesome-helpers.svg?branch=master)

## Installation

```bash
composer require calebporzio/awesome-helpers
```

## Helpers

**carbon**

Shortcut for: `new Carbon` or `Carbon::parse()`

``` php
carbon('One year ago');
```

**chain**

Makes an ordinary object chainable.

```php
chain(new SomeClass)
    ->firstMethod()
    ->secondMethod()
    ->thirdMethod();

// You can use the "carry" constant to pass the result of one method into the other:
chain(new Str)->singular('cars')->ucfirst(carry)();
// Returns "Car"
// Also, you can grab the result of the chain by trailing
// a "()" on the end of it. (Thanks to Taylor Otwell for these two additions)
```

**connection**

Run callback under a different database connection.

```php
$tenantPostIds = connection('tenantdb', function () {
    return Post::pluck('id');
});
```

**dump_sql**

Returns sql query with bindings data.

```php
dump_sql(\DB::table('users')->where('email', "blaBla")->where('id', 1));
// returns "select * from `users` where `email` = 'blaBla' and `id` = 1"
```

**faker**

Shortcut for: `$faker = Faker\Factory::create()`

``` php
faker()->address; // returns random, fake address
faker('address'); // alternate syntax
```

**user**

A shortcut for `auth()->user()`

```php
user()->posts()->create([...]);
```

**money**

```php
echo money(12); // echoes "$12.00"
echo money(12.75); // echoes "$12.75"
echo money(12.75, false); // echos "$13"
echo money(12.75, true, 'en_GB'); // echos "£12.75"
// Note: unless specified otherwise, money() will detect the current locale.
```

**ok**

Shortcut for `response('', 204)`. When you don't have anything to return from an endpoint, but you want to return success.

```php
return ok();
```

**stopwatch**

Returns the amount of time (in seconds) the provided callback took to execute. Useful for debugging and profiling.

```php
stopwatch(function () {
    sleep(2);
}); // returns "2.0"
```

**str_between**

Returns string between second argument

```php
str_between('--thing--', '--'); // returns "thing"
str_between('[thing]', '[', ']'); // returns "thing"

Str::between('--thing--', '--'); // returns "thing"
Str::between('[thing]', '[', ']'); // returns "thing"
```

**str_extract**

Returns capture groups contained in the provided regex pattern.

```php
str_extract('Jan-01-2019', '/Jan-(.*)-2019/'); // returns "01"

Str::extract('Jan-01-2019', '/Jan-(.*)-2019/'); // returns "01"

```

**str_match**

Checks the provided string against the provided regex pattern.

```php

str_match('Jan-01-2019', '/Jan-.*-2019/'); // returns true
str_match('foo bar baz', 'bar'); // returns true

Str::match('Jan-1-2019', '/Jan-(.*)-2019/'); // returns true

```

**str_validate**

A simple way to use validate a string using Laravel's built-in validation system.

```php
str_validate('calebporzio@aol.com', 'regex:/\.net$/|email|max:10');
// returns: ["Format is invalid.", "May not be greater than 10 characters."]

Str::validate('calebporzio@aol.com', 'regex:/\.net$/|email|max:10');
// returns: ["Format is invalid.", "May not be greater than 10 characters."]
```

**str_wrap**

```php
str_wrap('thing', '--'); // returns "--thing--"

Str::wrap('thing', '--'); // returns "--thing--"
```

**swap**

This function swaps the values of two variables.

```php
$startDate = '2040-01-01';
$endDate = '2020-01-01';

if ($endDate < $startDate) {
    swap($startDate, $endDate);
}

echo $startDate; // prints "2020-01-01"
echo $endDate; // prints "2040-01-01"
```

**tinker**

Kind of like `dd()`, but will open an `artisan tinker` terminal session with the variables you passed in, so you can play around.

```php
$somethingYouWantToDebug = new StdClass;
tinker($somethingYouWantToDebug);
```

## Am I missing an awesome helper function?

Submit a PR or issue with helper functions you use or ideas you have for others!

TTFN,
Caleb
