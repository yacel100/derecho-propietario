<?php

namespace App\Http\Controllers\Projects;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller {
    
    public function saveProjects(Request $request){

        if($request->isJson()){
            
            $this->validate($request, [
                'nombre_del_proyecto' => 'required',
                'codigo_catastral' => 'required',
                'coordenada_x' => 'required|numeric|min:6|max:6',
                'coordenada_y' => 'required|numeric|min:6|max:6',
                'distrito' => 'required',
                'sub_distrito' => 'required',
                'zona' => 'required',
                'manzano' => 'required'
            ], [
                'required'  => 'El campo :attribute es obligatorio!',
                'numeric' => 'La :attribute debe ser un número!',
                'min' => 'La :attribute debe ser al menos 6 caracteres númericos!',
                'max' => 'La :attribute no debe tener más de 6 caracteres númericos!',
            ]);
        
            $project = new Project(); //798223,8071262,19,false
            $cordinates = $project->utm2ll(trim($request->coordenada_x),trim($request->coordenada_x),19,false);
            

            return response([
                'status'=> true,
                'response'=> $cordinates
             ],201);
        }else{

            return response([
                'status'=> false,
                'message'=> 'Error 401 (Unauthorized)'
             ],401);
        }
        

    }
}
