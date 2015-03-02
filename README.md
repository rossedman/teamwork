# Teamwork API PHP Wrapper

## Installation

Just add this to your `composer.json` and then run `composer update`.

```
"rossedman/teamwork": "~1.0"
```

## Laravel Setup

This wrapper comes with support for `Laravel 5`. This includes a service provider as well as a facade for easy access.
Once this package is pulled into your project just add this to your `config/app.php` file.
```php
'providers' => [
    ...
    'Rossedman\Teamwork\TeamworkServiceProvider',
],
```

and then add the facade to your `aliases` array

```php
'aliases' => [
    ...
    'Teamwork' => 'Rossedman\Teamwork\Facades\Teamwork',
],
```

### Configuration

If you are using Laravel then add `teamwork` to your `app/services.php` file

```php
...
'teamwork' => [
    'key' => 'YourSecretKey',
    'url  => 'YourTeamworkUrl'
],
```

## Basic Usage

If you are not using Laravel you can instantiate the class like this

```php
require "vendor/autoload.php";

use GuzzleHttp\Client as Guzzle;
use Rossedman\Teamwork\Client;
use Rossedman\Teamwork\Factory as Teamwork;

$client     = new Client(new Guzzle, 'YourSecretKey', 'YourTeamworkUrl');
$teamwork   = new Teamwork($client);
```

You are ready to go now!
