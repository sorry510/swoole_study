<?php

use Swoole\WebSocket\Server;

// echo SWOOLE_VERSION;die;

$server = new Server("0.0.0.0", 9501);

$server->set([
    'document_root' => '/home/simple/Desktop/php/swoole/client',
    'enable_static_handler' => true,
]);

$server->on('open', function ($server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
    $server->push($request->fd, 'server ws is readly');
});

$server->on('message', function ($server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    if($frame->opcode === WEBSOCKET_OPCODE_TEXT) {
        // 文本数据
        $server->push($frame->fd, "this is server data = " . rand(1000, 9999));
        if($frame->data > 5000) $server->disconnect($frame->id, 4444, 'number is too big');
    }
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();