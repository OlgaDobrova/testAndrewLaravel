<?php
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $addHttpCookie = true;

    /**
     * Список маршрутов, исключённых из CSRF защиты.
     *
     * @var array
     */
    protected $except = [
         '/storage/app/public/uploads', // добавьте сюда маршрут загрузки
    ];
}