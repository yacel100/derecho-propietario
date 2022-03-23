<?php

namespace App\Http\Controllers\Projects;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller {
    
    public function saveProyects(Request $request){

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
        

           // $cordinates = Project::


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
