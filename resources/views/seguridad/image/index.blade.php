@extends ('layouts.index')
@section ('contenido')

<div class="col-lg-3 col-md-4">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Agregar fotografia</h3>
            </div>             
            <div id="notificacion_resul_fci"></div>
            <form  id="f_subir_imagen" name="f_subir_imagen" method="post"  action="agregarimage" class="formarchivo" enctype="multipart/form-data" >
                <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
                <div class="text-center card-box">
                    <div class="member-card">
                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" name="fotoperfil" class="archivo form-control" id="imagen" required><br /><br />
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm w-sm waves-effect m-t-10 waves-light">Guardar</button>
                        </div>
                    </div>

                </div> <!-- end card-box -->
            </form>
        </div>

        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title">Cambiar password</h4>
           

            <div class="p-b-10">
                <div class="form-group">
                      <label for="exampleInputEmail1">Email </label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Entrar email" value="{{Auth::user()->email}}" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-2">
                        <button type="button" class="btn btn-primary" id="btnchangepassword">
                            Cambiar datos
                        </button>
                    </div>
                </div>
                  </form>
            </div>
        </div>

    </div> <!-- end col -->

@endsection

@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script type="text/javascript">
         $(document).on("submit",".formarchivo",function(e){
           
            e.preventDefault();
            var formu=$(this);
            var nombreform=$(this).attr("id");
            
            var rs=false;
          
            if(nombreform=="f_subir_imagen" ){ var miurl="agregarimage";  var divresul="notificacion_resul_fci";   }

            var formData = new FormData($("#"+nombreform+"")[0]);       

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });            
            
            $.ajax({
                url: miurl,
                type: 'POST',
                //dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend: function(){
                  $("#"+divresul+"").html($("#cargador_empresa").html());                
                },
                //una vez finalizado correctamente
                success: function(data){  
                  $("#"+divresul+"").html(data);
                  //$('#fotografia_usuario').removeAttr('src');
                  //$('#fotografia_usuario').attr('src',"{{asset('fotografias/'.Auth::user()->fotoperfil)}}");
                 // {{asset('fotografias/'.Auth::user()->fotoperfil)}}
             
                  //
                
                },
                //si ha ocurrido un error
                error: function(data){
                   alert("ha ocurrido un error") ;
                    
                }
            });
            irarriba();
        });
    </script>
@endsection