<?php

use Co\MySQL;

go(function() {
    $mysql = new MySQL();
    $mysql->connect([
        'host' => '192.168.3.144',
        'port' => 3306,
        'user' => 'root',
        'password' => 'root',
        'database' => 'test',
    ]);
    $res = $mysql->query('select * from user');
    var_dump($res);
});

co::create(function() {
    $db = new MySQL();
    $server = array(
        'host' => '192.168.3.144',
        'user' => 'root',
        'password' => 'root',
        'database' => 'test',
        'timeout' => '3',
        'charset' => 'UTF8',
        'strict_type' => false, //开启严格模式，返回的字段将自动转为数字类型
        'fetch_mode' => true, 
    );

    $ret1 = $db->connect($server);
    $stmt = $db->prepare('SELECT * FROM user WHERE id=?');
    if ($stmt == false)
    {
        var_dump($db->errno, $db->error);
    }
    else
    {
        $stmt->execute(array(1));
        // 必须开启fetch_mode
        $ret2 = $stmt->fetchAll();
        var_dump($ret2);
    }
});