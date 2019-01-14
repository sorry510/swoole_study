<?php
$fileName = __DIR__ . '/fread.php';
go(function() use($fileName) {
    $r = Co::readFile($fileName);
    var_dump($r);
});