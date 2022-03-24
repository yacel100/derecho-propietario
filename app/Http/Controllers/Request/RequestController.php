<?php

namespace App\Http\Controllers\Request;

use App\Models\Request as Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RequestController extends Controller {


    public function getAllRequest(){

        
        return view('request.request');
    }

    public function newRegisterRequest(){

        return view('request.register', ['today' => date('Y-m-d')]);
    }

    public function saveRequest(Request $request){

        if($request->isJson()){
            
            $this->validate($request, [
                'num_gral' => 'required',
                'fecha' => 'required',
                'num_cite' => 'required|unique:requests|max:100',
                'descripcion' => 'required'
            ], [
                'required'  => 'El campo :attribute es obligatorio.',
                'unique'    => ':attribute Nro: '.$request->num_cite.' ya se encuentra en uso!',
                'max' => ':attribute no debe tener más de 100 caracteres.'
            ]);
            

           $new_request =  Requests::create([
            'id_user' => auth()->id(),
            'num_gral' => trim($request->num_gral),
            'num_cite' => trim($request->num_cite),
            'description' => trim($request->descripcion),
            'date_register_request' => $request->fecha,
           ]);


            return response([
                'status'=> true,
                'response'=> $new_request
             ],201);
        }else{

            return response([
                'status'=> false,
                'message'=> 'Error 401 (Unauthorized)'
             ],401);
        }
    }

}