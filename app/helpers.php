<?php

use Illuminate\Support\Facades\Route;

function route_class(): array|string
{
    return str_replace('.', '-', Route::currentRouteName());
}
