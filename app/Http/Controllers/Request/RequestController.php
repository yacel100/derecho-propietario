<?php

namespace App\Http\Controllers\Request;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RequestController extends Controller {


    public function getAllRequest(){

        

        return view('request.request');
    }

}