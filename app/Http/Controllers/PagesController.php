<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\View;

class PagesController
{
    public function root(): View
    {
        return view('pages.root');
    }
}
