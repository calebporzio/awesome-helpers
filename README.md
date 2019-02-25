# A collection of awesome helpful functions for Laravel

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


**user**

A shortcut for `auth()->user()`
```php
user()->posts()->create([...]);
```


**money**

```php
echo money(12); // echoes "$12.00"
echo money(12.75); // echoes "$12.75"
echo money(12.75, false) // echos "$12"
echo money(12.75, true, 'en_GB') // echos "£12"
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

```php
str_between('--thing--', '--'); // returns "thing"
str_between('[thing]', '[', ']'); // returns "thing"
```


**str_match**

Because `preg_match` is annoying.
```php

str_match('Jan-1-2019', '/Jan-(.*)-2019/'); // returns true

```


**str_validate**

A simple way to use validate a string using Laravel's built-in validation system.
```php
str_validate('calebporzio@aol.com', 'regex:/\.net$/|email|max:10');
// returns: ["Format is invalid.", "May not be greater than 10 characters."]
```


**str_wrap**

```php
str_wrap('thing', '--'); // returns "--thing--"
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
