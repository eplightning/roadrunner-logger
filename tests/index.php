<?php

use Spiral\Goridge;
use Spiral\RoadRunner;

ini_set('display_errors', 'stderr');

require 'vendor/autoload.php';

$rpc = new Goridge\RPC(new Goridge\SocketRelay('localhost', 9001));

$date = new DateTime;

$rpc->call('logger.Line', [
    'level' => 'error',
    'message' => 'Message',
    'timestamp' => $date->format(DateTime::RFC3339_EXTENDED),
    'fields' => [
        'context' => [
            'x' => 'a',
            'y' => 2,
            'z' => 2.5
        ]
    ]
]);

$rpc->call('logger.Line', [
    'level' => 'info',
    'message' => 'Message 2',
    'timestamp' => $date->format(DateTime::RFC3339_EXTENDED)
]);
