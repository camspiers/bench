<?php

require __DIR__ . '/../vendor/autoload.php';

function calculate() {
    sleep(1);
    return 1;
}

bench\invoke('calculate');
bench\invoke('calculate');

foreach (bench\formatTimes(bench\collector()) as $time) {
    echo $time, PHP_EOL;
}