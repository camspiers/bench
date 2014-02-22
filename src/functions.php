<?php

namespace bench;

/**
 * This is a basic implementation of a collector
 *
 * The collector stores times when a time is given
 * and when a time is not given it clears the current times
 * and then return the times so far collected
 *
 * @param string|void $key
 * @param float|void $time
 * @return array
 */
function collector($key = null, $time = null) {
    static $times = [];
    if ($time === null) {
        $return = $times;
        $times = []; // reset times
        return count($return) === 1 ? current($return) : $return;
    } else {
        $times[$key] = $time;
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
    $result = call_user_func_array($fn, $args);
    call_user_func($collector ?: __NAMESPACE__.'\\collector', $key, mark($key));
    return $result;
}
