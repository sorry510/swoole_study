<?php

use Swoole\Process;

$process = new Process(function (Process $worker) {
    // $r = new ReflectionClass($worker);
    // var_dump($r->getProperties());return 0;
    // var_dump($r->__toString());return 0;
    $res = $worker->exec('/bin/echo', ['hello']);
    echo $res;
    // $worker->write('hello');
}, true); // 需要启用标准输入输出重定向

$process->start();

echo "from exec: ". $process->read(). "\n";