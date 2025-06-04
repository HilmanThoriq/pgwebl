<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Table '

        ];
        return view('home', $data);
    }


}
