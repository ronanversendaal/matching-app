<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * [getStories description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getStories(Request $request)
    {
        return view('stories');
    }

    /**
     * [getExecutives description]
     * @return [type] [description]
     */
    public function getExecutives()
    {
        return view('executives');
    }

    /**
     * [contact description]
     * @return [type] [description]
     */
    public function contact()
    {
        return view('contact');
    }
}
