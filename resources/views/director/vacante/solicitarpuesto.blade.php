
<link href="{{asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css" />

<div class="col-lg-12" id="listadoVacante">
    <div class="modal fade" id="formModalVacante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <input type="hidden" name="tdias" id="tdias">
            <input type="hidden" name="thoras" id="thoras">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="inputTitleVacante"></h4>
                </div>
                <div>              
                 @include('director.vacante.vacantecreate')
                 </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-guardar-vacante" id="btnguardarvacante">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="erroresModalVacante" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="inputError"></h4>
      </div>

      <div class="modal-body">
        <ul style="list-style-type:circle" id="erroresContentVacante"></ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<meta name="_token" content="{!! csrf_token() !!}" />
<script type="text/javascript">

 $("#btnguardarvacante").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var formData = {
            idpuesto: $("#idpuesto").val(),
            idafiliado: $("#idafiliado").val(),
        };

        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl=urlraiz+"/empleado/addplazavacante";

        $.ajax({
            type: "POST",
            url: miurl,
            data: formData,
            dataType: 'json',

            success: function (data) {
                swal({
                  title:"Envio correcto",
                  text: "La solicitud ha sido enviada correctamente",
                  type: "success",
                });

                $('#formAgregarVacante').trigger("reset");
                $('#formModalVacante').modal('hide');
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
                $("#erroresContentVacante").html(errHTML); 
                $('#erroresModalVacante').modal('show');
            }
        });
    });
</script>
<script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
