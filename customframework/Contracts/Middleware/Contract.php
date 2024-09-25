<?php

namespace Contracts\Middleware;


interface Contract
{
        
    /**
     * handle
     *
     * @param  mixed $request
     * @param  mixed $next
     * @param  mixed $role
     * @return mixed
     */
    public function handle($request, $next, ...$role);
}

