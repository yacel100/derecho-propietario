@extends('adminlte::page')
@section('title', 'Registro')
@section('plugins.Datatables', true)
@section('plugins.leaflet', true)
@section('plugins.Animation', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)



@section('content_header') 
<h1>SOLICITUDES CERTIFICACION DERECHO PROPIETARIO GAMC</h1>
@stop


@section('content')

<div class="card" >
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Nro Gral:</label>
                    <input type="text" class="form-control" id="gral">
                  </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Fecha:</label>
                    <input type="date" class="form-control" id="date">
                  </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Nro. Cite:</label>
                    <input type="text" class="form-control" id="cite">
                  </div>
            </div>
        </div>

        <div class="form-group">
            <label>Descripción:</label>
            <textarea rows="4" cols="50" type="text" class="form-control" id="descrition"></textarea>
          </div>
    </div>
  </div>
  <div class="col-12" style="text-align: center">
    <button type="button" id="save-request" class="btn btn-info col-4"><i class='fas fa-book'></i> Guardar Registro</button>
  </div>

  <hr>



  <div id="save-proyect" style="">

    <div class="row">
<div class="col-sm-6">
    <h4>PROYECTO UBICACIÓN</h4>
</div>
<div class="col-sm-6">
    <button type="button" id="save-proyects" class="btn btn-info col-4"><i class='fas fa-chart-line'></i> Registrar Proyecto</button>
</div>
    </div>
   
  <table id="proyects" class="table table-striped table-bordered responsive" style="width:100%">
    <thead>
        <tr>
            <th>Nro.</th>
            <th>Cod. Catastral</th>
            <th>Proyecto</th>
            <th>opciones</th>
        </tr>
    </thead>
    <tbody>
        {{-- <tr>
            <td>1</td>
            <td>Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
        </tr> --}}
    </tbody>
</table>
<div id="proyectos-map" class="col-sm-12" style="height: 402px; margin-top: 20px;"></div>
  </div>

  
  
<!-- Modal complementacion de entrega de producto -->
<div class="modal fade fullscreen-modal animated bounceIn" id="modal-proyects" data-backdrop="static" tabindex="-1" role="dialog"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" style="text-align: center">PROYECTO UBICACIÓN</h3>
            <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="card">
                <div class="card-body">
            
                    <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombre del Proyecto:</label>
                                    <input type="text" class="form-control" id="name-proyect">
                                </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Codigo Catastral:</label>
                                <input type="text" class="form-control" id="cod-catastro">
                            </div>
                        </div>
                       
                    </div>
            


                    <div class="row" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Coordenada X:</label>
                                <input type="text" class="form-control" id="coor-x">
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Coordenada Y:</label>
                                <input type="text" class="form-control" id="coor-y">
                            </div> 
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Distrito:</label>
                                <input type="text" class="form-control" id="distrito">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Sub Distrito:</label>
                                <input type="text" class="form-control" id="sub-distrito">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Zona:</label>
                                <input type="text" class="form-control" id="zona">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Manzano:</label>
                                <input type="text" class="form-control" id="manzano">
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" id="btn-ubicacion" class="btn btn-success">Registrar Ubicación</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div> 
            
                </div>
              </div>
            

        </div>
        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btn-complementacion-producto">Guardar</button>
        </div> --}}
    </div>
</div>
</div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .modal {
        padding: 2% !important;
        }
        .modal .modal-dialog {
        width: 100%;
        max-width: none;
        
        margin: 0;
        }
        .modal .modal-content {
        height: 95%;
        border: 0;
        border-radius: 0;
        }
        .modal .modal-body {
        overflow-y: auto;
        }
    </style>
@stop


@section('js')
    <script> 
    
    var crs = new L.Proj.CRS(
    "EPSG:32719", "+proj=utm +zone=19 +south +datum=WGS84 +units=m +no_defs", {
        resolutions: [1600, 800, 400, 200, 100, 50, 25, 10, 5, 2.5, 1, 0.5, 0.25, 0.125, 0.0625]
    }
);



function getFeatureInfoUrl(map, latlng) {
    //'https://busquedasgamc.cochabamba.bo/web/index.php?r=services/get-feature-info-url',
    var layer = 'https://busquedasgamc.cochabamba.bo/web/index.php?r=services/get-feature-info-url-calles';
    var params = {
        INFO_FORMAT: "application/json",
        FEATURE_COUNT: 50
         };

    var point = map.latLngToContainerPoint(latlng, map.getZoom()),
        size = map.getSize(),
        bounds = map.getBounds(),
        sw = bounds.getSouthWest(),
        ne = bounds.getNorthEast(),
        sw = crs.projection._proj.forward([sw.lng, sw.lat]),
        ne = crs.projection._proj.forward([ne.lng, ne.lat]);
    var defaultParams = {
        TRANSPARENT: true,
        request: 'GetFeatureInfo',
        service: 'WMS',
        srs: 'EPSG:32719',
        styles: '',
        version: '1.1.1',
        format: 'image/png',
        bbox: [sw.join(','), ne.join(',')].join(','),
        height: size.y,
        width: size.x,
        layers: 0,
        query_layers: 0
    };
    params = L.Util.extend(defaultParams, params || {});
    params[params.version === '1.3.0' ? 'i' : 'x'] = point.x;
    params[params.version === '1.3.0' ? 'j' : 'y'] = point.y;

    return layer + L.Util.getParamString(params, layer, true);
}


    $(document).ready(function() {

       //cod oin click register new request
        $('#save-request').on('click', function(){
            Swal.fire({  
                title: '¿Quieres guardar los cambios?', 
                showCancelButton: true,
                confirmButtonColor: '#25571d',  
                confirmButtonText: 'Guardar',  
                cancelButtonText: 'Cancelar',
                }).then((result) => {  
                    if (result.isConfirmed) {    

                        $.ajax({
                        type: "POST",
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: "{{ route('request.register') }}",
                        data: JSON.stringify({
                            num_gral: $('#gral').val(),
                            fecha: $('#date').val(),
                            num_cite: $('#cite').val(),
                            descripcion: $('#descrition').val()
                        }),
                        success: function(data) {
                            $('#save-proyect').show(1000);
                            $('#gral').prop( "disabled", true );
                            $('#date').prop( "disabled", true );
                            $('#cite').prop( "disabled", true );
                            $('#descrition').prop( "disabled", true );
                            $('#save-request').remove();
                            Swal.fire('Guardado!', '', 'success')  ;
                        },
                        error: function (error) {
                            if(error.status == 422){
                                Object.keys(error.responseJSON.errors).forEach(function(k){
                                toastr["error"](error.responseJSON.errors[k]);
                                //console.log(k + ' - ' + error.responseJSON.errors[k]);
                                });
                            }else if(error.status == 419){
                                location.reload();
                            }
                        }
                    });

                    }
                })
        });


       //save location project
       $(document).on('click', '#btn-ubicacion', function(){
        $.ajax({
                        type: "POST",
                        headers: {
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':'{{ csrf_token() }}',
                        },
                        url: "{{ route('project.save') }}",
                        data: JSON.stringify({
                            nombre_del_proyecto: $('#name-proyect').val(),
                            codigo_catastral: $('#cod-catastro').val(),
                            coordenada_x: $('#coor-x').val(),
                            coordenada_y: $('#coor-y').val(),
                            distrito: $('#distrito').val(),
                            sub_distrito: $('#sub-distrito').val(),
                            zona: $('#zona').val(),
                            manzano: $('#manzano').val()
                        }),
                        success: function(data) {
                            Swal.fire('Guardado!', '', 'success')  ;
                        },
                        error: function (error) {
                            
                            if(error.status == 422){
                                Object.keys(error.responseJSON.errors).forEach(function(k){
                                toastr["error"](error.responseJSON.errors[k]);
                                //console.log(k + ' - ' + error.responseJSON.errors[k]);
                                });
                            }else if(error.status == 419){
                                location.reload();
                            }

                        }
                    });
        
       });





        // register new proyects
        $(document).on('click', '#save-proyects', function(){
            $('#modal-proyects').modal('show');
        });




        $('#proyects').DataTable({
        "paging": false,
        "searching": false,
        "language": {

            "sProcessing": '<p style="color: #012d02;">Cargando. Por favor espere...</p>',
            //"sProcessing": '<img src="https://media.giphy.com/media/3o7bu3XilJ5BOiSGic/giphy.gif" alt="Funny image">',
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ninguna ubicación registrada aún",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": 'Buscar Datos Por CI:',
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": 'Primero',
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
    });



        // cod map
        setTimeout(
        function() {
            $('.leaflet-control-attribution').text('innova.cochabamba.bo');
            $('.leaflet-routing-container').css("color", "black");
        }, 200);

        let mymap = new L.Map('proyectos-map', { 
            //crs: crs, 
            continuousWorld: true, 
            worldCopyJump: false, 
            minZoom: 13, 
            maxZoom: 19, 
            layers: [ 
               // L.tileLayer.wms('https://busquedasgamc.cochabamba.bo/web/index.php?r=services/get-imagenes', {
                L.tileLayer.wms('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {  
                    layers: '0', 
                    format: 'image/png', 
                    opacity: 0.9, 
                    version: '1.1.1',
                    maxZoom: 25,
                    crs: crs
                }) 
            ] 
        });

  

        var districtLayer = L.tileLayer.wms(
        'https://busquedasgamc.cochabamba.bo/web/index.php?r=services/get-info-catastro', {
            layers: '0',
            format: 'image/png',
            version: '1.1.1',
            opacity: 1,
            maxZoom: 22,
            transparent: true,
            continuousWorld: true
        }).addTo(mymap);

        mymap.setView([-17.39382474713952, -66.15696143763128], 18);

        routingControl = L.Routing.control({
        waypoints: [
            L.latLng(-17.393446725261732, -66.1558131909952),
            L.latLng(-17.39417363991792, -66.15765926522245),
            //L.latLng(-17.38773552953728, -66.14212691576225)
        ],
        language: 'es',
        }).addTo(mymap);

        let marker; 
        mymap.on('click', function(e) {
            //console.log(e.latlng);
            mymap.removeControl(routingControl);

            if (marker) { 
            mymap.removeLayer(marker); 
        } 

                marker = new L.Marker(e.latlng, {
                        draggable: true
                    });
                    
                    mymap.addLayer(marker);
                    marker.bindPopup("<b>Ubicación Seleccionada</b>").openPopup();

    
                $.ajax({
                url: getFeatureInfoUrl(mymap, e.latlng ),
                type: 'GET',
                dataType: 'json',
                async: false,
                success: function(data) {
                console.log(data);
                }
                });

                marker.on('dragend', function (getValue) {
                        $.ajax({
                        url: getFeatureInfoUrl(mymap, marker.getLatLng()),
                        type: 'GET',
                        dataType: 'json',
                        async: false,
                        success: function(data) {
                        console.log(data);
                        }
                        });
                }); 

});





  $('#solicitudes').DataTable({
    "language": {
            "sProcessing": '<p style="color: #012d02;">Cargando. Por favor espere...</p>',
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": 'Buscar:',
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": 'Primero',
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
  });
    } ); 
    </script>
@stop