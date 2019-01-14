<?php

use Swoole\Client;

$client = new Client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);

$client->on('connect', function($cli) {
    $cli->send("GET / HTTP/1.1\r\n\r\n");
});

$client->on("receive", function($cli, $data) {
    echo "Receive: $data";
    $cli->send(str_repeat('A', 10) . "\n");
    sleep(1);
});

$client->on("error", function($cli) {
    echo "error\n";
});

$client->on("close", function($cli) {
    echo "Connection close\n";
});

$client->connect('127.0.0.1', 9501);