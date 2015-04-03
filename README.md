# Teamwork API PHP Wrapper

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rossedman/teamwork/badges/quality-score.png?b=master&s=997768a5d702b571dac7d50ae4f85af7236bcf5d)](https://scrutinizer-ci.com/g/rossedman/teamwork/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/rossedman/teamwork/badges/coverage.png?b=master&s=c042749710f918bf24803ebe4f86491b53562fa8)](https://scrutinizer-ci.com/g/rossedman/teamwork/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/rossedman/teamwork/badges/build.png?b=master&s=22b2a99a72437be3ead6cc77c9bad8d38864221a)](https://scrutinizer-ci.com/g/rossedman/teamwork/build-status/master)
![Release](https://img.shields.io/github/release/rossedman/teamwork.svg?style=flat)
![Download](https://img.shields.io/packagist/dt/rossedman/teamwork.svg?style=flat)
![License](https://img.shields.io/packagist/l/rossedman/teamwork.svg?style=flat)

This is a simple PHP Client that can connect to the [Teamwork](http://www.teamwork.com) API. This package was developed to be used with [Laravel 5](http://www.laravel.com) but can also be used stand alone as well. I hope this helps you automate and extend Teamwork to integrate even more into your business! Have fun and good luck. :metal:

## Table Of Contents

1. [Installation](https://github.com/rossedman/teamwork#installation)
    * [Laravel Setup](https://github.com/rossedman/teamwork#laravel-setup)
    * [Without Laravel](https://github.com/rossedman/teamwork#configuration-without-laravel)
2. [Examples](https://github.com/rossedman/teamwork#examples)
    * [Account](https://github.com/rossedman/teamwork#account)
    * [Activity](https://github.com/rossedman/teamwork#activity)
    * [Company](https://github.com/rossedman/teamwork#company)
    * [People](https://github.com/rossedman/teamwork#people)
    * [Project](https://github.com/rossedman/teamwork#project)
3. [Roadmap](https://github.com/rossedman/teamwork#roadmap)
4. [Contributing](https://github.com/rossedman/teamwork#contributing)

## Installation

Just add this to your `composer.json` and then run `composer update`.

```
"rossedman/teamwork": "dev-master"
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

If you are using Laravel then add a `teamwork` array to your `config/services.php` file

```php
...
'teamwork' => [
    'key'  => 'YourSecretKey',
    'url'  => 'YourTeamworkUrl'
],
```

## Configuration Without Laravel

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

* * *

## Examples

Not all of the Teamwork API is supported yet but there is still a lot you can do! Below are some examples of how you can access Projects, Companies, and more. To work with a specific Object pass in the ID to perform actions on it. Data can be passed through for creating and editing.

#### Account

```php
// get account details
$teamwork->account()->details();

// authenticate
$teamwork->account()->authenticate();
```

#### Activity

```php
// get latest activity
$teamwork->activity()->latest([maxItems]);

// only get starred activity
$teamwork->activity()->latest([onlyStarred]);

// delete activity
$teamwork->activity($id)->delete();
```

#### Company

```php
// view all companies
$teamwork->company()->all();

// find a company
$teamwork->company($id)->find();

// create a company
$teamwork->company()->create([
    "name" => "Satan Inc.",
    "address_one" => "666 Deathzone Rd.",
    "zip" => "66666",
    "city" => "Lake Of Fire",
    "state" => "Hellworld",
    "countrycode" => "US"
]);

// update a company
$teamwork->company($id)->update([
    "name" => "Clients From Hell"
]);

// delete a company
$teamwork->company($id)->delete();

// people associated with comapny
$teamwork->company($id)->people();
```

#### People

```php
// gather all the peoples
$teamwork->people()->all();

// create a person
$teamwork->people()->create([
    "first-name" => "Warlock",
    "last-name" => "Mastermind",
    "email-address" => "witchery@thedevil.com",
    "user-type" => "account",
    ...
]);

// update a person
$teamwork->people($id)->update([
    "first-name" => "Nero"
]);

// delete a person
$teamwork->people($id)->delete();

// me, who am I?
$teamwork->people()->me();

// get all apiKeys, for site administrator only
$teamwork->people()->apiKeys();
```

#### Projects

Projects have the most associated with them and are the most complicated to use. Below are all the methods associated with the `Projects` class.

```php
// get all projects
$teamwork->projects()->all();

// find a project by ID
$teamwork->projects($projectID)->find();

// update a project
$teamwork->projects($projectID)->update([
    "name" => "Satan, The Project",
    "description" => "Updating this project to be most evil",
    "companyID" => "666"
]);

// remove a project
$teamwork->projects($projectID)->delete();

// latest activity on project
$teamwork->projects($projectID)->activity();

// companies involved in project
$teamwork->projects($projectID)->companies();

// people included in project
$teamwork->projects($projectID)->people();

// starred projects
$teamwork->projects()->starred();

// star/unstar a project
$teamwork->projects($projectID)->star();
$teamwork->projects($projectID)->unstar();

// get all projects links
$teamwork->projects($projectID)->links();

// time total
$teamwork->projects($projectID)->timeTotal();

// messages
$teamwork->projects($projectID)->latestMessages();
$teamwork->projects($projectID)->archivedMessages();

// get all milestones
$teamwork->projects($projectID)->milestones();
```

## Roadmap

#### 1.0 Release

- [x] Create Laravel 5 Facade
- [x] Create Laravel 5 Service Provider
- [x] Create Guzzle Client Wrapper
- [x] Add Support For `Account` Endpoint
- [x] Add Support For `Activity` Endpoint
- [x] Add Support For `Company` Endpoint
- [x] Add Support For `Links` Endpoint
- [x] Add Support For `Message` Endpoint
- [x] Add Support For `Milestone` Endpoint
- [x] Add Support For `People` Endpoint
- [x] Add Support For `Project` Endpoint
- [ ] Add Support For `Tasks` Endpoint
- [ ] Add Support For `Tasks Lists` Endpoint
- [ ] Add Support For `Time` Endpoint
- [ ] Create Testing Suite

#### 1.1 Release

- [ ] Add Support For `Comments`
- [ ] Add Support For `Permissions`
- [ ] Add Support For `Notebooks`

#### 1.2 Release

- [ ] Add Support For `Categories`
- [ ] Add Support For `People Status`
- [ ] Add Support For `Files`

## Contributing

If you're having problems, spot a bug, or have a feature suggestion, please log and issue on Github. If you'd like to have a crack yourself, fork the package and make a pull request. Please include tests for any added or changed functionality. If it's a bug, include a regression test.
