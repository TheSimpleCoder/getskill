<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{

    private $mainLanguage = 'ru';
    private $name = 'lang';
    private $minutes = 24 * 60 * 30;

    public static $languages = ['ru', 'uk'];

    public function handle(Request $request, Closure $next)
    {
//        $localeCookie = $request->cookie($this->name);
//        if (!$localeCookie && !in_array($localeCookie, self::$languages)){
//            $localeCookie = $this->mainLanguage;
//            $response->withCookie(cookie($this->name, $this->mainLanguage, $this->minutes));
//        }
//
//
//        $localeRequest = $request->segment(1);
//        if (!in_array($localeRequest, self::$languages)){
//            $localeRequest = $this->mainLanguage;
//        }
//
//
//        if ($localeCookie !== $localeRequest){
//            $locale = $localeRequest;
//            $response->withCookie(cookie($this->name, $localeRequest, $this->minutes));
//        } else {
//            $locale = $localeCookie;
//        }

        $locale = $request->segment(1);
        app()->setLocale($locale);
        return $next($request);

    }
}
