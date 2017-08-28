    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de empleados activos, interinos y periodo de prueba </h3>
            <div class="navbar-form navbar-left pull-left">

            
           
              <div class="form-group">

                    <select  id="select"  class="form-control select2" data-style="btn-info" data-live-search="true" onchange="buscarempleado();" >
                        <?php  if(isset($casosel)){ 
                            $listadocaso=$casosel->nombre; 
                            $optsel= '<option value="'.$casosel->idcaso.'">'.$casosel->nombre.' </option>';
                            }else{  
                                $listadocaso="Todos";
                                $optsel="";
                            } ?>

                            <?=  $optsel;  ?>
                                <option value="0">Todos... </option>
                                @if(isset($casos))
                                <?php foreach($casos as $cas){   ?>
                                <option value="<?= $cas->idcaso; ?>" > <?= $cas->nombre; ?></option>
                             <?php }  ?>
                        @endif
                    </select>

                    <input type="text" class="form-control" id="searchText" name="searchText" placeholder="Buscar..."> 
                </div>
                <button type="button" class="btn btn-default" onclick="buscarempleado();">Buscar</button>
            </div>

            <div class="navbar-form navbar-left pull-right">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="col-lg-3 col-md-6 col-sm-3 col-xs-12">

                        <p>Detalles</p>
                        <button class="btn btn-primary" title="Detalles"><i class="glyphicon glyphicon-zoom-in"></i></button>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-3 col-xs-12">

                        <p>Historial</P>
                        <button class="btn btn-primary" title="Historial laboral"><i class="fa fa-stack-overflow"></i></button>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-3 col-xs-12">
                        <p>Vacaciones</p>
                        <button class="btn btn-primary" title="Vacaciones"><i class="fa fa-camera-retro fa-lg"></i></button>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-3 col-xs-12">
                        <p>Despedir</p>
                        <button class="btn btn-danger" id="FWEF" value="" title="Despedir" ><i class="fa fa-remove"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <script type="text/javascript">
                $(".select2").select2();
                
                $('#searchText').keypress(function(e){   
                if(e.which == 13){      
                     buscarempleado();
                }   
            });         
            
        </script>