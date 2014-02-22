<?php

require __DIR__ . '/../vendor/autoload.php';

function calculate() {
    sleep(1);
    return 1;
}

bench\invoke('calculate');
bench\invoke('calculate');

list($first, $second) = bench\collector();

echo sprintf('%01.2f secs', $first), PHP_EOL;
echo sprintf('%01.2f secs', $second), PHP_EOL;