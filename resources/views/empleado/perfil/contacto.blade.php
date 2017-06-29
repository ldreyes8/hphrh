@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet" />        
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section ('contenido')

<div class="row"> 
    
  

    <div class="col-md-12 col-lg-12">
        <div class="">
            <div class="">
                <ul class="nav nav-tabs navtab-custom">
                <!--
                    <li class="">
                        <a href="#home" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">Sobre Mi</span>
                        </a>
                    </li>
                    -->
                    <li class=""> <a href="javascript:void(0);" onclick="cargarlistado(1,1);">
                    
                        <a href="#profile" data-toggle="tab" aria-expanded="false" >
                            <span class="visible-xs"><i class="md md-perm-contact-cal"></i></span>
                            <span class="hidden-xs">Contactos</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    
                    @include('hr.galeria')
                  
                   

                    <div class="modal fade" id="erroresModalPassword" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Errores</h4>
                          </div>

                          <div class="modal-body">
                            <ul style="list-style-type:circle" id="erroresContentPassword"></ul>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection

@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{asset('assets/js/foto.js')}}"></script>

    <script src="{{asset('assets/js/changepassword.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>

    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js')}}"></script>
    
    <script>cargarlistado(1);   </script>

@endsection