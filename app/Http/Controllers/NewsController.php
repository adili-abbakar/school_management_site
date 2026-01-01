<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $data = range(0, 15);
        return view("news.index", ['news' => $data]);
    }
}
