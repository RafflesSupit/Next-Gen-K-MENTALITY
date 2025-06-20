<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMenus = Menu::take(3)->get();
        return view('home', compact('featuredMenus'));
    }
}