<?php

namespace App\Http\Controllers;

use stdClass;

class TestController extends Controller {
    public function index()
    {
        $name = "Akash";
        $age = 25;
        $users = [
            'Akash',
            'Jahangir',
            'Rony'
        ];

        $user1 = new stdClass();
        $user1->name = "Akash";
        $user1->age = 26;

        $user2 = new stdClass();
        $user2->name = "Jahangir";
        $user2->age = 20;

        $user3 = new stdClass();
        $user3->name = "Rony";
        $user3->age = 35;

        $users_obj = [
           $user1,
           $user2,
           $user3
        ];

        // $data = [
        //     'name' => $name,
        //     'age' => $age,
        // ];

        return view('index', compact('name', 'age', 'users', 'users_obj'));
        // return view('index', $data);
        // return view('index')->with('name', $name);
        // return view('index')->with('name', $name)->with('age', $age);
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