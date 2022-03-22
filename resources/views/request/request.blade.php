@extends('adminlte::page')
@section('title', 'Solicitudes')
@section('plugins.Datatables', true)
@section('plugins.leaflet', true)

@section('content_header') 
<h1>SOLICITUDES CERTIFICACION DERECHO PROPIETARIO GAMC</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <button type="button" id="new-request" class="btn btn-info"><i class='fas fa-file-export'></i> Registrar Nueva Solicitud</button>
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

<!-- Modal complementacion de entrega de producto -->
<div class="modal fade fullscreen-modal animated bounceIn" id="modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="text-align: center">REGISTRO NUEVA SOLICITUD</h3>
                <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" >&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nro Gral:</label>
                                    <input type="text" class="form-control" id="gral">
                                  </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha:</label>
                                    <input type="date" class="form-control" id="date">
                                  </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nro. Cite:</label>
                                    <input type="text" class="form-control" id="cite">
                                  </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción:</label>
                            <textarea rows="4" cols="50" type="text" class="form-control" id="descrition"></textarea>
                          </div>
                    </div>
                  </div>


                  <hr>
                  <div class="card">
                    <div class="card-header" style="text-align: center">
                      <h4>PROYECTO UBICACIÓN</h4>
                    </div>
                    <div class="card-body">
                        <div id="proyectos-map" class="col-sm-12" style="height: 402px; margin-top: 20px;"></div>
                    </div>
                  </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-complementacion-producto">Guardar</button>
            </div>
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

function getFeatureInfoUrl(map, layer, latlng, params) {
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
            L.latLng(-17.38773552953728, -66.14212691576225)
        ],
        language: 'es',
        show: false
        }).addTo(mymap);

        let marker; 
        mymap.on('click', function(e) {

            mymap.removeControl(routingControl);

            if (marker) { 
            mymap.removeLayer(marker); 
        } 

                marker = new L.Marker(e.latlng, {
                        draggable: true
                    });
                    mymap.addLayer(marker);
                    marker.bindPopup("<b>Ubicación Seleccionada</b>").openPopup();

                var url = getFeatureInfoUrl(
                mymap,
                //'https://busquedasgamc.cochabamba.bo/web/index.php?r=services/get-feature-info-url',
                'https://busquedasgamc.cochabamba.bo/web/index.php?r=services/get-feature-info-url-calles',
                e.latlng, {
                'INFO_FORMAT': 'application/json',
                'FEATURE_COUNT': 50
                }
                );

                $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                async: false,
                success: function(data) {
                console.log(data);
                }
                });

                console.log(e.latlng);

});



        
   

        $('#new-request').on('click', function(){
            $('#modal').modal('show');
            setTimeout(function() { 
            mymap.invalidateSize(); 
        }, 1000);
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