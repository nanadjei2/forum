<?php 
// Create a factory
function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}
// Make a factory in memory
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}