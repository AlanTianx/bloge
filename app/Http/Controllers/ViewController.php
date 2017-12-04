<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    //
    public function index(){
        $data['name'] = 'tiantian';
        $data['sex'] = 'man';
        $title = 'qweqwe';
        //return view('view')->with('lol','英雄联盟');
        //return view('view' , $data);
        return view('view' , compact('data','title'));
    }
}
