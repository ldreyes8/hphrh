
<div class="box-header" id="capa">


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="navbar-form navbar-left pull-left">
                    <h4 class="box-title">Buscar Usuarios</h4>
                    
                        <div class="input-group">     
                            <input type="text" class="form-control" autofocus id="dato_buscado">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="button"   onclick="buscarusuario();" >Buscar!</button>
                            </span>
                        </div>
                    
                        <div class="input-group">
                            <select  id="select_filtro_rol" class="form-control select2" data-live-search="true"  onchange="buscarusuario();" >
                                <?php  if(isset($rolsel)){ 
                                    $listadopais=$rolsel->name; 
                                    $optsel= '<option value="'.$rolsel->id.'">'.$rolsel->name.' </option>';
                                }else{  
                                    $listadopais="General";
                                    $optsel="";
                                 } ?>

                                <?=  $optsel;  ?>
                                <option value="0">General </option>
                                @if(isset($roles))
                                <?php foreach($roles as $rol){   ?>
                                <option value="<?= $rol->id; ?>" > <?= $rol->name; ?></option>
                                <?php }  ?>
                                @endif
                            </select>
                        </div>
                    </div>           
                </div>
            </div>
        <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();

            $('#dato_buscado').keypress(function(e){   
                if(e.which == 13){      
                    buscarusuario();
                }   
            });
        });
    </script>




