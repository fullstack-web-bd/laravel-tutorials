<?php

namespace App\Http\Controllers;

class TestController extends Controller {
    public function index()
    {
        return view('index');
    }

    public function hello()
    {
        return "Hello New";
    }

    public function show($id = null)
    {
        return $id;
    }


}