<?php

$fp = fopen(__DIR__ . "/redis.php", "r");

go(function() use($fp) {
    // fseek($fp, 256);
    $r =  co::fread($fp);
    var_dump($r);
});