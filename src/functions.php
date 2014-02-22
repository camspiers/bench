<?php

namespace bench;

/**
 * This is a basic implementation of a collector
 *
 * The collector stores times when a time is given
 * and when a time is not given it clears the current times
 * and then return the times so far collected
 *
 * @param float|void $time
 * @return array
 */
function collector($time = null) {
    static $times = [];
    if ($time === null) {
        $return = $times;
        $times = []; // reset times
        return count($return) === 1 ? $return[0] : $return;
    } else {
        $times[] = $time;
    }
}

/**
 * @param $key
 * @return float|void
 */
function mark($key) {
    static $marks = [];
    if (empty($marks[$key])) {
        $marks[$key] = microtime(true);
    } else {
        $result = microtime(true) - $marks[$key];
        unset($result[$key]);
        return $result;
    }
}

/**
 * This function will return a Closure that when executed will
 * time the original function and add the results to the collector
 * 
 * @param callable $fn
 * @param array|void $args
 * @param callable|void $collector
 * @return \Closure
 */
function wrap(callable $fn, $args = [], callable $collector = null) {
    return function () use ($fn, $args, $collector) {
        return invoke($fn, $args, $collector);
    };
}

/**
 * @param callable $fn
 * @param array|void $args
 * @param callable|void $collector
 * @return mixed
 */
function invoke(callable $fn, $args = [], callable $collector = null) {
    mark($key = uniqid());
    $result = $fn(...$args);
    call_user_func($collector ?: __NAMESPACE__.'\\collector', mark($key));
    return $result;
}

/**
 * @param float $time
 * @param int $dp
 * @return string
 */
function format($time, $dp = 2) {
    return sprintf("%01.{$dp}fs", $time);
}

/**
 * @param array $times
 * @return array
 */
function formatTimes(array $times) {
    return array_map('bench\\format', $times);
}
