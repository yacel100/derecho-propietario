@extends('adminlte::page')
@section('title', 'Solicitudes')
@section('plugins.Datatables', true)


@section('content_header') 
<h1>SOLICITUDES CERTIFICACION DERECHO PROPIETARIO GAMC</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <a href="{{ route('new-request') }}" class="btn btn-info"><i class='fas fa-file-export'></i> Registrar Nueva Solicitud</a>
    </div>
  </div>

  <table id="solicitudes" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Nº</th>
            <th>Fecha</th>
            <th>Cite</th>
            <th>Hoja de Ruta</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
        </tr>
        <tr>
            <td>Garrett Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>63</td>
            <td>2011/07/25</td>
            <td>$170,750</td>
        </tr>
        <tr>
            <td>Ashton Cox</td>
            <td>Junior Technical Author</td>
            <td>San Francisco</td>
            <td>66</td>
            <td>2009/01/12</td>
            <td>$86,000</td>
        </tr>
       
    </tbody>
   
</table>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  
@stop