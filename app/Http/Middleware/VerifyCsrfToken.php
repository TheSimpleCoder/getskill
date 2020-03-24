<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use App;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/ru/cabinet-organization/up/photo/albom',
        '/uk/cabinet-organization/up/photo/albom',
        'https://getskill.com.ua/ru/cabinet-organization/payment/callback/user',
        'https://getskill.com.ua/uk/cabinet-organization/payment/callback/user',
        'https://getskill.com.ua/ru/cabinet-organization/payment/callback',
        'https://getskill.com.ua/uk/cabinet-organization/payment/callback',
    ];
}
