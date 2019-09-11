<?php


function create($class, $attrs = [], $collection = null){

	return factory("App\Models\\{$class}", $collection)->create($attrs);

}

function make($class, $attrs = [], $collection = null){

	return factory("App\Models\\{$class}", $collection)->create($attrs);

}

