<?php

use Swoole\Server;

$serv = new Server('0.0.0.0', 9501, SWOOLE_BASE, SWOOLE_SOCK_UDP);

$serv->set([
    'worker_num'=> 4,
]);

$serv->on('connect', function($serv, $fd, $reactorId) {
    echo "Client:Connect.\n";
});

// $serv->on('receive', function ($serv, $fd, $reactorId, $data) {
//     $serv->send($fd, "udp-server-{$fd}:{$data}");
// });

$serv->on('packet', function($serv, $data, $addr) {
    var_dump($addr);
    $serv->sendto($addr['address'], $addr['port'], "udp-server:{$data}");
});

$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

$serv->start();