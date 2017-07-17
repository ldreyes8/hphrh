   <div class="row">                                                
<h3>Listado de empleados activos, interinos y periodo de prueba </h3>
            <div class="navbar-form navbar-left pull-right">

                    <div class="form-group">

                <select  id="select"  class="form-control selectpicker" data-live-search="true" onchange="buscarempleado();" >
                                <?php  if(isset($casosel)){ 
                                    $listadocaso=$casosel->nombre; 
                                    $optsel= '<option value="'.$casosel->idcaso.'">'.$casosel->nombre.' </option>';
                                }else{  
                                    $listadocaso="General";
                                    $optsel="";
                                 } ?>

                                <?=  $optsel;  ?>
                                <option value="0">General </option>
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
        </div>

