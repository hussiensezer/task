<?php

namespace App\Abstracts;

use Closure;
use Illuminate\Support\Str;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
        if(!request()->has($this->filterName()))
        {
            return $next($request);
        }

        $builder = $next($request);
        return $this->applyFilter($builder);
    }// Handle

    protected function filterName(): string
    {

        $snakeCase = Str::snake(class_basename($this));
        $fileName = explode( '_',$snakeCase); // Explode To Array
        $removeFirstPrefix = array_shift($fileName);
        $removeLastPrefix =  array_pop($fileName);
        return implode('_', $fileName);
    }// End FilterName
    protected abstract function applyFilter($builder);






}
