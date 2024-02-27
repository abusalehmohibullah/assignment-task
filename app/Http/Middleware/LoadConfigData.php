<?php

namespace App\Http\Middleware;

use App\Helpers\MyApp;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class LoadConfigData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Load configuration data from the database
        $googleConfigData = MyApp::getConfig('google_login', true);

        $facebookConfigData = MyApp::getConfig('facebook_login', true);
        // Merge the loaded configuration data into the existing configuration
        Config::set('services.google', $googleConfigData?->config_value);
        Config::set('services.facebook', $facebookConfigData?->config_value);

        // Continue processing the request
        return $next($request);
    }
}
