<?php

namespace App\Http\Controllers\Projects;

use App\Models\Project;
use App\Models\Coordinate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller {
    
    public function saveProjects(Request $request){

        if($request->isJson()){
            
            $this->validate($request, [
                'id_request' => 'required',
                'nombre_del_proyecto' => 'required',
                'codigo_catastral' => 'required',
                'coordenada_x' => 'required|min:5|max:10',
                'coordenada_y' => 'required|min:5|max:10',
                'distrito' => 'required',
                'sub_distrito' => 'required',
                'zona' => 'required',
                'manzano' => 'required'
            ], [
                'required'  => 'El campo :attribute es obligatorio!',
                'numeric' => 'La :attribute debe ser un número!',
                'min' => 'La :attribute debe ser al menos 5 caracteres númericos!',
                'max' => 'La :attribute no debe tener más de 10 caracteres númericos!',
            ]);
        
            $coordenada_x = trim(str_replace(',', '.', $request->coordenada_x));
            $coordenada_y = trim(str_replace(',', '.', $request->coordenada_y));
            $project = new Project();
            $cordinates = $project->utm2ll($coordenada_x,$coordenada_y, 19, false);
            
            if($cordinates['success'] == true){
          
                //check register  project
                $check_project = Project::select()->where(['id_request' => $request->id_request])->first();
                
                if($check_project){

                    $check_coordinates = Coordinate::select()->where([
                        'id_project' => $check_project->id,
                        'location_utm' => $coordenada_x.','.$coordenada_y
                        ])->first();

                    if($check_coordinates){
                        return response([
                            'errors' => ['message' => 'Los datos UTM '. $request->coordenada_x. ' y '. $request->coordenada_y. ' ya se encuentra registrado en el proyecto']
                         ],422);
                    }

                    $coordinates_table = Coordinate::create([
                        'id_project' => $check_project->id,
                        'location_utm' => $coordenada_x.','.$coordenada_y,
                        'location' => $cordinates['lat'].','.$cordinates['lon']
                    ]);

                    return response([
                        'status'=> true,
                        'response'=> $check_project,
                        'coordinates' => $coordinates_table
                     ],201);

                }else{

                    $project->id_request = $request->id_request;
                    $project->name = trim($request->nombre_del_proyecto);
                    $project->cod_catastro = trim($request->codigo_catastral);
                    $project->distrito = trim($request->distrito);
                    $project->sub_distrito = trim($request->sub_distrito);
                    $project->zona = trim($request->zona);
                    $project->manzano = trim($request->manzano);
                    if($project->save()){
    
                    $coordinates_table = Coordinate::create([
                            'id_project' => $project->id,
                            'location_utm' => $coordenada_x.','.$coordenada_y,
                            'location' => $cordinates['lat'].','.$cordinates['lon']
                        ]);
    
                        return response([
                            'status'=> true,
                            'response'=> $project,
                            'coordinates' => $coordinates_table
                         ],201);
    
                    }else{
                        return response([
                            'errors' => ['message' => 'Ocurrio un error en la peticion por favor recargar la pagina e intente nuevamente!']
                         ],500);
                    }
                }

            }else{

            return response([
                'errors' => ['message' => $cordinates['msg']]
             ],422);
                
            }
            
            
            //$cordinates = $project->ll2utm(-17.484444859301007,-66.12555530673689); 
            

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


    public function convertUtmToLl(Request $request){

        if($request->isJson()){

            $this->validate($request, [
                'coordenada_x' => 'required|min:5|max:10',
                'coordenada_y' => 'required|min:5|max:10',
            ], [
                'required'  => 'El campo :attribute es obligatorio!',
                'min' => 'La :attribute debe ser al menos 5 caracteres númericos!',
                'max' => 'La :attribute no debe tener más de 10 caracteres númericos!',
            ]);

            $coordenada_x = trim(str_replace(',', '.', $request->coordenada_x));
            $coordenada_y = trim(str_replace(',', '.', $request->coordenada_y));

            $project = new Project();
            $cordinates = $project->utm2ll($coordenada_x,$coordenada_y, 19, false);

            if($cordinates['success'] == true){

                return response([
                    'status'=> true,
                    'response'=> [$cordinates['lat'], $cordinates['lon']]
                 ],202);
            }else{
                return response([
                    'errors' => ['message' => $cordinates['msg']]
                 ],422);
            }

        }else{
            return response([
                'status'=> false,
                'message'=> 'Error 401 (Unauthorized)'
             ],401);
        }

    }
}
