@extends ('layouts.index')
@section('estilos')
    @parent
    <style >
        input[type=text] {

            background: transparent;
            width: 100%;
            border: 0px;outline:none;
            text-align: justify;
            text-justify:inter-word;
        }
    </style>
@endsection
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de solicitantes </h3>
		@include('empleado.solicitante.search')
	</div>
    <!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="{{URL::action('SController@pdf')}}"><button class="btn btn-primary">Descargar</button></a>
    </div-->
</div>
<div class="row">
   <div class=class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="table-responsive">
             <table id="tblsolicitud" class="table table-striped table-bordered table-condensed table-hover">
                 <thead>
                     <th>Id</th>
                     <th>Identificación</th>
                     <th>Nit</th>
                     <th>Nombre</th>
                     <th>Afiliado </th>
                     <th>Puesto aplicar</th>
                     <th>Status</th>
                     <th>Opciones</th>
                 </thead>
                 @foreach ($empleados as $em)
                 <tr class="filaTable">
                     <td>{{$em->idempleado}}
                        <input type="hidden" class="idempleado" value="{{$em->idempleado}}">
                     </td>
                     <td>{{$em->identificacion}}</td>
                     <td>{{$em->nit}}</td>
                     <td>{{$em->nombre1.' '.$em->nombre2.' '.$em->apellido1.' '.$em->apellido2}}</td>
                     <td>{{$em->afnombre}}</td>
                     <td>{{$em->puesto}}</td>
                     <td>{{$em->status}}
                        <input type="hidden" class="idstatus" value="{{$em->idstatus}}">
                     </td>
                     <td>
                     
                     <a href="{{URL::action('SController@show',$em->identificacion)}}"><button class="btn btn-primary">Detalles</button></a>
                     <a href="{{URL::action('Pprueba@update',$em->idempleado)}}"><button class="btn btn-primary">Aceptar</button></a>
                

                      <a href="{{url('empleado/rechazo',array('id'=>$em->idempleado,'ids'=>$em->idstatus))}}" > <button id="btnrechazo" class="btn btn-primary btnrechazo">Rechazar</button></a>


                     <a href="{{URL::action('SController@Spdf',$em->identificacion)}}"><button class="btn btn-primary">Descargar</button></a>
                     </td>
                 </tr>
                 @endforeach
             </table>
         </div>
         {{$empleados->render()}}
   </div>
</div>
@endsection
@section('fin')
    @parent

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script>
    $(document).ready(function()
    {
 /*       $('.btnrechazo').click(function(){
            var idempleado=$('.idempleado').val();
            alert(idempleado);

        });
        /*$("#btnrechazo").click(function(){
            alert('Hola mundo');
            /*var miurl="SolicitanteI";
href="{{URL::action('SController@rechazo',$em->idempleado)}}"
            var formData = {
                afiliado : $("#idafiliado").val(),
                puesto : $("#idpuesto").val(),
                idempleado: $("#idempleadoPAF").val(),
                identificacion : $("#identificacionPAF").val(),
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: miurl,
                data: formData,
                dataType: 'json',

                success: function (data) {
                    swal({ 
                        title:"Gracias, Envio correcto.",
                        text: "Usted ahora es aspirante al puesto",
                        type: "success"
                    },
                    function(){
                        //window.location.href="/empleado/solicitante"
                    });
                    $('#formAgregarPAF').trigger("reset");
                    $('#formModalPAF').modal('hide');
                    
                },
                error: function (data) {
                    $('#loading').modal('hide');
                    var errHTML="";
                    if((typeof data.responseJSON != 'undefined')){
                        for( var er in data.responseJSON){
                            errHTML+="<li>"+data.responseJSON[er]+"</li>";
                        }
                    }else{
                        errHTML+='<li>Error</li>';
                    }
                    $("#erroresContentO").html(errHTML); 
                    $('#erroresModalO').modal('show');
                }
            });
        });*/
    });
    </script>
@endsection