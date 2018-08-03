<?php 
// Create a factory
function create($class, $attributes = [])
{
    return factory($class)->create($attributes);
}
// Make a factory in memory
function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}