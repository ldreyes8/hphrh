<div class="box-header">
                    <h4 class="box-title">Buscar Usuarios</h4>
                    
                    <div class="col-lg-9">
                        <div class="input-group">     
                            <input type="text" class="form-control" id="dato_buscado">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="button" onclick="buscarusuario();" >Buscar!</button>
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="input-group">
                            <select  id="select_filtro_rol"  onchange="buscarusuario();" >
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
                            <span >  Resultados en  listado <b><?= $listadopais; ?></b></span>
                        </div>
                    </div>           
                </div>