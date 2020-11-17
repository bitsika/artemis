# Artemis 🦅

## Introduction

Artemis, in Greek religion, the goddess of wild animals, the hunt, and vegetation and of chastity and childbirth; she was identified by the Romans with Diana. 
Artemis was the daughter of Zeus and Leto and the twin sister of Apollo. Among the rural populace, Artemis was the favourite goddess. Her character and function 
varied greatly from place to place, but, apparently, behind all forms lay the goddess of wild nature, who danced, usually accompanied by nymphs, in mountains, forests, 
and marshes. Artemis embodied the sportsman’s ideal, so besides killing game she also protected it, especially the young; this was the Homeric significance of the title Mistress of Animals.

### In this context

Artemis is Bitsika's Auth Middleware for all microseervices, in order to avoid managing the auth service certificates across other service, [I](https://twitter.com/ichtrojan), [IBK](https://twitter.com/ajimotea), Thomas and Edwin 
came up with the solution to use a middleware to authenticate tokens via the auth service at runtime.

## Installation

* Add Auth server URL to `.env`

```
AUTH_SERVER=https://apple.com
```

>**NOTE**
> Ask team members to confirm the domain

* Add this to your `composer.json`:

```json
...
"repositories": {
    "dev-package": {
        "type": "vcs",
        "url": "git@github.com:bitsika/artemis.git"
    }
},
...
```

>**NOTE**
> `...` means other things may exist above or below

and this too:

```json
...
"require": {
    ...
    "bitsika/artemis": "dev-master",
    ...
},
...
```

* Run `composer update`, while this is executing, you will be asked to put a GitHub token, you can get that by following the url provided at this stage.

* Register middleware in `kernel.php`

```php
<?php
...

/**
 * The application's route middleware.
 *
 * These middleware may be assigned to groups or used individually.
 *
 * @var array
 */
protected $routeMiddleware = [
    ...
    'artemis' => \Bitsika\Artemis\Http\Middleware\Artemis::class,
    ...
];
```

* Add artemis to your protected routes in `api.php`

```php
<?php
...
Route::group(['middleware' => 'artemis'], function () {
    ...
});
```

Viola, you have succefully set up Artemis. If you have any questions, contact any of the names mentioned in Introduction.