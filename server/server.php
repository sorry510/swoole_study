<?php

use Swoole\Server;

$serv = new Server('0.0.0.0', 9501, SWOOLE_BASE, SWOOLE_SOCK_TCP);

$serv->set([
    'worker_num'=> 4,
]);

$serv->on('connect', function($serv, $fd, $reactorId) {
    echo "Client:Connect.\n";
});

$serv->on('receive', function ($serv, $fd, $reactorId, $data) {
    // $serv->tick(1000, function() use ($serv, $fd, $data) {
        $serv->send($fd, "server-{$fd}:{$data}");
    // });
    // $serv->close($fd);
});

$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

$serv->start();