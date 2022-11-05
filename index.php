<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\service\Handler;

$getGame = new Handler();
$getGame->groupId = 'GROUP_OR_USER_ID'; // Group id or user id, to get wall posts.
$getGame->start();
