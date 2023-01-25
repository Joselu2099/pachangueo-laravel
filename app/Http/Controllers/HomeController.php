<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Inicio";
        return view('home.index')->with("viewData", $viewData);
    }

    public function contact()
    {
        $viewData = [];
        $viewData["title"] = "Contacto";
        return view('home.contact')->with("viewData", $viewData);
    }
}
