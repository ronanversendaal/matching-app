<?php namespace App\Http\Controllers;

use App\User;

class IndexController extends Controller{


    public function getIndex()
    {

        //@todo replace this with repo and only get client type users.
        $clients = User::all()->toJson();

        return view('welcome', ['clients' => $clients]);        
    }
}