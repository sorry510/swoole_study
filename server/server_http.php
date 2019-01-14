<?php

use Swoole\Http\Server;

$http = new Server('0.0.0.0', 8888);
$http->set([
    'document_root' => '/home/simple/Desktop/php',
    'enable_static_handler' => true,
]);
$http->on('request', function ($req, $res) use($http) {
    $uri = $req->server['request_uri'];
    if ($uri == '/favicon.ico') {
        $res->status(404);
        $res->end();
    }
    // include文件中的代码可以平滑重启,本文件的所有代码不能热重载,但是
    // $http->reload();好像不起作用,不管是否重启,include('request.php');中的内容总是可以热重载
    include('request.php');
    $isReload = isset($req->get['reload']) ? true : false;
    // if($isReload) $http->reload();
});
$http->start();