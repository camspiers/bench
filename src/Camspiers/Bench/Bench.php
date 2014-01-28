<?php

namespace Camspiers\Bench;

/**
 * Class Bench
 * @package Camspiers\Bench
 */
class Bench
{
    /**
     * @param $fn
     * @param array $args
     * @return callable
     */
    public function wrapClosure($fn, $args = array())
    {
        return function () use ($fn, $args) {
            $startTime = microtime(true);
            call_user_func_array($fn, $args);
            return microtime(true) - $startTime;
        };
    }
    /**
     * @param $object
     * @param $method
     * @param $args
     * @return int
     */
    public function wrapMethod($object, $method, $args = array())
    {
        return $this->wrapClosure(function () use ($object, $method, $args) {
            call_user_func_array(array($object, $method), $args);
        });
    }
}