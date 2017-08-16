@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/css/minimalista.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css')}}" rel="stylesheet" type="text/css" media="screen">

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
    <!--
    <div id="renuncia"></div>

            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">


                  <div class="table-rep-plugin">
                    <div class="table-responsive" data-pattern="priority-columns">
                      <table id="tech-companies-1" class="table table-striped">
                        <thead>
                          <tr>
                            <th>Company</th>
                            <th data-priority="1">Last Trade LA PERLA NEGRA 45</th>
                            <th data-priority="3">Trade Time NOMBRE FT</th>
                            <th data-priority="1">Change</th>
                            <th data-priority="3">Prev Close</th>
                            <th data-priority="3">Open</th>
                            <th data-priority="6">Bid</th>
                            <th data-priority="6">Ask</th>
                            <th data-priority="6">1y Target Est</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>GUATEMALA CITY 14 CALLE DIAGONAL 22 <span class="co-name">Quetzaltenangno, Quetzaltenango Colonia los tulipanes.</span></th>
                            <td>597.74</td>
                            <td>12:12PM</td>
                            <td>14.81 (2.54%)</td>
                            <td>582.93</td>
                            <td>597.95</td>
                            <td>597.73 x 1000000</td>
                            <td>597.91 x 300000</td>
                            <td>731.10</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            -->
@endsection

@section('fin')
    @parent

    <script src="{{asset('assets/js/PanelControl/Usuario.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')}}" type="text/javascript"></script>

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