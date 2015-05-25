---
layout: default
title: Milestones
slug: milestones
---

~~~php
<?php
// Get all milestones in Teamwork.
$teamwork->milestone()->all();

// Get all milestones and get progress of each milestone.
$teamwork->milestone()->all(['getProgress' => 'true']);

// Find a specific milestone by id
$teamwork->milestone($id)->find();

// Find milestone by ID with tasks, task lists and progress.
$teamwork->milestone($id)->find([
   'getProgress' => 'true',
   'showTaskLists' => 'true',
   'showTasks' => 'true'
]);
~~~
