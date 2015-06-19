---
layout: default
title: Milestones
slug: milestones
---

~~~php
<?php
// Get all milestones in Teamwork.
$teamwork->milestones()->all();

// Get all milestones and get progress of each milestone.
$teamwork->milestones()->all(['getProgress' => 'true']);

// Find a specific milestone by id
$teamwork->milestones($id)->find();

// Find milestone by ID with tasks, task lists and progress.
$teamwork->milestones($id)->find([
   'getProgress' => 'true',
   'showTaskLists' => 'true',
   'showTasks' => 'true'
]);
~~~
