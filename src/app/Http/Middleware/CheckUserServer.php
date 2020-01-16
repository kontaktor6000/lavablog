<?php

namespace App\Http\Middleware;

use App\Server;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserServer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        echo 'This is CheckUserServer';

        $user = Auth::user();
        $hostName = $user->server->host_name;


        //DB:purge('mysql');

        \Illuminate\Support\Facades\Config::set('database.connections.zoom.host', $hostName);
        $hostName = \Illuminate\Support\Facades\Config::get('database.connections.zoom.host');
        //dd($hostName);

        return $next($request);
    }
}
