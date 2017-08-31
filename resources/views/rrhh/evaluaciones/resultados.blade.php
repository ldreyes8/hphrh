@extends ('layouts.index')
@section('estilos')
    @parent
    
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
@endsection
@section ('contenido')
        
    @include('rrhh.evaluaciones.contresultado')
@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        <script type="text/javascript">
            function valida(e){
                tecla = e.keyCode || e.which;
                tecla_final = String.fromCharCode(tecla);
                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8 || tecla==37 || tecla==39 ||tecla==46 ||tecla==9)
                    {
                        return true;
                    } 
                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9]/;
                //patron =/^\d{9}$/;
                return patron.test(tecla_final);

            }
            $(document).ready(function(){
                $('.btnresult').click(function(){
                    var idref=$(this).val();
                    var miurl="nombrelist";
                    $.get(miurl+'/'+ idref, function(data){
                        $('#nombre').val(data.nombre1+' '+data.nombre2+' '+data.apellido1+' '+data.apellido2);
                        //$('#nombre').val(data.nombre2);
                        //$('#nombre3').val(data.nombre3);
                    });
                    $('#inputTitle').html("Agregar nota de evaluación");
                    $('#formAgregar').trigger("reset");
                    $('#formModal').modal('show');
                    $('#idempleado').val(idref);
                });


                $("#btnGuardar").click(function(e){
                    var miurl="agregarnota";
                    
                    var formData = {
                        observacion: $("#observacione").val(),
                        idempleado: $("#idempleado").val(),
                        nota: $("#nota").val(),

                    };
                    console.log(formData);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: miurl,
                        data: formData,
                        dataType: 'json',

                        success: function (data) {

                            swal({ 
                                title:"Envio correcto",
                                text: "Se ha agregado una nota a este empleado",
                                type: "success"
                            },
                            function(){
                                window.location.href="/empleado/resultados"
                            });
                
                            //$('#formModal').modal('hide');
                            
                        },
                        error: function (data) {
                            $('#loading').modal('hide');
                            var errHTML="";
                            if((typeof data.responseJSON != 'undefined')){
                                for( var er in data.responseJSON){
                                    errHTML+="<li>"+data.responseJSON[er]+"</li>";
                                }
                            }else{
                                errHTML+='<li>Error, en este momento no se puede ingresar la nota intente mas tarde.</li>';
                            }
                            $("#erroresContent").html(errHTML); 
                            $('#erroresModal').modal('show');
                        }
                    });
                });
              
            });
        </script>

@endsection