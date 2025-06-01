<?php

use Illuminate\Support\Facades\Route;

function route_class(): array|string
{
    return str_replace('.', '-', Route::currentRouteName());
}




function make_excerpt($value, $length = 200): int|string
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str()->limit($excerpt, $length);
}
