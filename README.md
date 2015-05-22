# Teamwork API PHP Wrapper

![teamwork-graphic](https://cloud.githubusercontent.com/assets/2628905/7765016/853f462c-001e-11e5-90ac-389bf1a6c2fe.jpg)


[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rossedman/teamwork/badges/quality-score.png?b=master&s=997768a5d702b571dac7d50ae4f85af7236bcf5d)](https://scrutinizer-ci.com/g/rossedman/teamwork/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/rossedman/teamwork/badges/coverage.png?b=master&s=c042749710f918bf24803ebe4f86491b53562fa8)](https://scrutinizer-ci.com/g/rossedman/teamwork/?branch=master)
[![Build Status](https://travis-ci.org/rossedman/teamwork.svg?branch=master)](https://travis-ci.org/rossedman/teamwork)
![Release](https://img.shields.io/github/release/rossedman/teamwork.svg?style=flat)
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
    * [Milestone](https://github.com/rossedman/teamwork#milestone)
    * [Task](https://github.com/rossedman/teamwork#task)
    * [Project](https://github.com/rossedman/teamwork#project)
3. [Roadmap](https://github.com/rossedman/teamwork#roadmap)
4. [Contributing](https://github.com/rossedman/teamwork#contributing)

## Installation

Just add this to your `composer.json` and then run `composer update`.

```
"rossedman/teamwork": "dev-master"
```

You can also simply add it like this

```
composer require "rossedman/teamwork:dev-master"
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

### Use

If you are using the Facade with Laravel youc an easily access Teamwork like this

```php
Teamwork::people()->all();
```

If you want to use dependency injection to make your application easy to test the Service Provider binds `Rossedman\Teamwork\Factory`. Here is an example of how to use it with dependency injection

```php
Route::get('/test', function(Rossedman\Teamwork\Factory $teamwork) {
   $activity = $teamwork->activity()->latest();
});
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

Get details of the account.

```php
$teamwork->account()->details();
```

Authenticate the account.

```php
$teamwork->account()->authenticate();
```

#### Activity

Get the latest activity for all of Teamwork
```php
$teamwork->activity()->latest(['maxItems' => 10]);
```

Get only starred activity by the account your are using.

```php
$teamwork->activity()->latest(['onlyStarred' => 1]);
```

Delete a specific activity by ID

```php
$teamwork->activity($id)->delete();
```

#### Company

Retrieve all companies.

```php
$teamwork->company()->all();
```

Retrieve company by ID.

```php
$teamwork->company($id)->find();
```

Create a company! Aha! Business! :briefcase:

```php
$teamwork->company()->create([
    "name" => "Satan Inc.",
    "address_one" => "666 Deathzone Rd.",
    "zip" => "66666",
    "city" => "Lake Of Fire",
    "state" => "Hellworld",
    "countrycode" => "US"
]);
```

Update a company

```php
$teamwork->company($id)->update([
    "name" => "Clients From Hell"
]);
```

Delete a company

```php
$teamwork->company($id)->delete();
```

Get people associated with company

```php
$teamwork->company($id)->people();
```

#### People

Gather all the peoples.

```php
$teamwork->people()->all();
```

Paginate people.

```php
$teamwork->people()->all(['page' => "3", "pageSize" => "10"]);
```

Get a person by email address

```php
$teamwork->people()->all(['emailaddress' => 'test@awesome.com']);
```

Create a person.

```php
$teamwork->people()->create([
    "first-name" => "Warlock",
    "last-name" => "Mastermind",
    "email-address" => "witchery@thedevil.com",
    "user-type" => "account",
    "user-name" => "Deathlok"
    ...
]);
```

Update a person

```php
$teamwork->people($id)->update([
    "first-name" => "Nero"
]);
```

Delete a person

```php
$teamwork->people($id)->delete();
```

Find out who you are. Search yourself. :gem:

```php
$teamwork->people()->me();
```

Get all API Keys **For site admin only** :key:

```php
$teamwork->people()->apiKeys();
```

#### Task

Get all tasks.

```php
$teamwork->task()->all();
```

You can also filter tasks by many different parameters that are listed [here](http://developer.teamwork.com/todolistitems#retrieve_all_task) in the Teamwork developers docs. This example shows how to filter by tasks that are overdue and then order them by date.

```php
$teamwork->task()->all(['filter' => 'overdue', 'sort' => 'duedate']);
```

Retrieve a task by `id`.

```php
$teamwork->task($id)->find();
```

Retrieve a task by `id` and exclude files and subtasks.

```php
$teamwork->task($id)->find(['getFiles' => 'false', 'nestSubTasks' => 'true]);
```

Complete and uncomplete a task.

```php
$teamwork->task($id)->complete();
$teamwork->task($id)->uncomplete();
```

#### Tasklists

Find a specific tasklist

```php
$teamwork->tasklist($id)->find();
```

Update a tasklist

```php
$teamwork->tasklist($id)->update([
    'name' => 'Change The Name'
]);
```

Delete a tasklist

```php
$teamwork->tasklist($id)->delete()
```

Get time totals for a tasklist

```php
$teamwork->tasklist($id)->timeTotal();
```

#### Milestone

Get all milestones in Teamwork.

```php
$teamwork->milestone()->all();
```

Get all milestones and get progress of each milestone.

```php
$teamwork->milestone()->all(['getProgress' => 'true']);
```

Find a specific milestone by `id`;

```php
$teamwork->milestone($id)->find();
```

Find milestone by ID with tasks, task lists and progress.

```php
$teamwork->milestone($id)->find([
   'getProgress' => 'true',
   'showTaskLists' => 'true',
   'showTasks' => 'true'
]);
```

#### Projects

Projects have the most associated with them and are the most complicated to use. Below are all the methods associated with the `Projects` class.

Get all projects in Teamwork.

```php
$teamwork->project()->all();
```

Find a specific project by ID.

```php
$teamwork->project($projectID)->find();
```

Create a project.

```php
$teamwork->project()->create([
    "name" => "My New Amazing Project",
    "description" => "This is a project that I will dedicate my whole life too",
    "companyId" => "999"
]);
```

Update a project.

```php
$teamwork->project($projectID)->update([
    "name" => "Satan, The Project"
]);
```

Delete a project.

```php
$teamwork->project($projectID)->delete();
```

Get the latest activity on a project.

```php
$teamwork->project($projectID)->activity();
$teamwork->project($projectID)->activity(['maxItems' => 5]);
```

Get all companies involved in a project.

```php
$teamwork->project($projectID)->companies();
```

Get all people associated with a project.

```php
$teamwork->project($projectID)->people();
```

Get starred projects :star2:

```php
$teamwork->project()->starred();
```

Star or unstar a project :star2:

```php
$teamwork->project($projectID)->star();
$teamwork->project($projectID)->unstar();
```

Get all links on project

```php
$teamwork->project($projectID)->links();
```

Get the time totals for a project.

```php
$teamwork->project($projectID)->timeTotal();
```

Retrieve latest messages and archived messages

```php
$teamwork->project($projectID)->latestMessages();
$teamwork->project($projectID)->archivedMessages();
```

Get all the milestones

```php
$teamwork->project($projectID)->milestones();
```

Create a milestone associated with a project

```php
$teamwork->project($projectId)->createMilestone([
    "title" => "Save The World",
    "description" => "You must save the world in the next few days",
    "deadline" => "20150402",
    "notify" => true,
    "reminder" => true
]);
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
- [x] Add Support For `Tasks` Endpoint
- [ ] Add Support For `Tasks Lists` Endpoint
- [ ] Add Support For `Time` Endpoint
- [x] Create Testing Suite

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
