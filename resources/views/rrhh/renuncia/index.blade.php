@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/css/minimalista.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
    @endsection

@section ('contenido')
    <div id="main">
        <ul id="navigationMenu">
            <li>
                <a class="home" onclick="cargar_pagexterna(1);">
                    <span>Renunciar</span>
                    <img src="{{asset('assets/images/renuncia.png')}}" alt="" />
                </a>
            </li>

            <li>
                <a class="about" onclick="cargar_pagexterna(2);">
                    <img src="{{asset('assets/images/danger.png')}}" alt="" /> 
                    <span>Acerca</span>
                </a>
            </li>

            <li>
                <a class="services" href="#">
                    <img src="{{asset('assets/images/designer.png')}}" alt="" />
                    <span>Services</span>
                </a>
            </li>

            <li>
                <a class="portfolio" href="#">
                    <img src="{{asset('assets/images/warning.png')}}" alt="" />
                    <span>Portfolio</span>
                </a>
            </li>

            <li>
                <a class="contact" href="#">
                    <span>Contact us</span>
                </a>
            </li>
        </ul>
    </div>
    <div id="renuncia"></div>
@endsection

@section('fin')
    @parent

    <script src="{{asset('assets/js/PanelControl/Usuario.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>



    <script>cargarusuario(1);</script>
@endsection


<script type="text/javascript">


function cargar_formularioR(arg){
  var urlraiz=$("#url_raiz_proyecto").val();

   $("#capa_modal").show();
   $("#renuncia").show();
   var screenTop = $(document).scrollTop();
   $("#renuncia").css('top', screenTop);
   $("#renuncia").html($("#cargador_empresa").html());
   //if(arg==1){ var miurl=urlraiz+"/form_nuevo_usuario"; }
   if(arg==1){ var miurl="https://learn.jquery.com/ajax/working-with-jsonp/"; }
 
    $.ajax({
    url: miurl
    }).done( function(resul) 
    {
     $("#renuncia").html(resul);
   
    }).fail( function() 
   {
    $("#renuncia").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
   }) ;
}

function cargar_pagexterna(arg){
  var urlraiz=$("#url_raiz_proyecto").val();

   if(arg==1){ var miurl="https://learn.jquery.com/ajax/working-with-jsonp/"; }
   if(arg==2){ var miurl="https://www.office.com/?auth=2&home=1";}
   window.open(miurl,'','width=600,height=600,left=50,top=50,toolbar=yes');
}
</script>