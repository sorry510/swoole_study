<?php

use Swoole\Process;

$process = new process(function(process $process) {
    $process->write('Hello');
}, true);

$process->start();
sleep(2);

echo $process->read(); // 输出 Hello