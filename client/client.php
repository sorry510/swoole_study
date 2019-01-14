<?php

use Swoole\Client;

#同步阻塞
$client = new Client(SWOOLE_SOCK_TCP);
if(!$client->connect('127.0.0.1', 9501, -1)) {
    exit('connect faild');
}
$client->send("hello world\n");
$recv = $client->recv();
echo $recv;
$client->close();