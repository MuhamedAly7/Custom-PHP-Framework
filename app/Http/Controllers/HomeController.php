<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        $title = 'title';
        $content = 'content data';
        return view('index', compact('title', 'content'));
    }

    public function about(){
        echo "Welcome to about page";
    }

    public function article($id)
    {
        echo "Welcome to article page id = ".$id;
    }
}
