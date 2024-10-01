<?php
namespace App\Http\Controllers\Api\Trait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait cacheRequestTrait
{
    function getCacheGetRequest(Request $request)
    {
        $uri = $request->getRequestUri();

        if (Cache::store('file')->has('api_' . $uri)) {
            return Cache::store('file')->get('api_' . $uri);
        }

        return false;
    }

    function setCacheGetRequest(Request $request, $data,  $time = 60)
    {

        $uri = $request->getRequestUri();

        if ($time = 'forever') {
            return Cache::store('file')->rememberForever('api_' . $uri, function () use ($data) {
                return $data;
            });
        }

        return Cache::store('file')->remember('api_' . $uri, $time, function () use ($data) {
            return $data;
        });
    }
}
