<?php

echo "main start\n";
go(function () {
    echo "coro ".co::getcid()." start\n";
    co::sleep(.1); //switch at this point
    echo "coro ".co::getcid()." end\n";
});
echo "end\n";

// output

// main start
// coro 1 start
// end
// coro 1 end