<?php

var_dump($req->get);
$res->end("<h1>Hello swoole. #".rand(1000, 9999)."</h1>");