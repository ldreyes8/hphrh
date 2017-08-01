<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="navbar-form navbar-left pull-left">
            <div class="form-group">
                <select  id="select"  class="form-control select2" data-style="btn-info" data-live-search="true" onchange="buscarindexrechazadoJI();" >
                    <?php  if(isset($tiposel)){ 
                        $listadocaso=$tiposel->ausencia; 
                        $optsel= '<option value="'.$tiposel->idtipoausencia.'">'.$tiposel->ausencia.' </option>';
                        }else{  
                            $listadocaso="Todos";
                            $optsel="";
                        } ?>

                    <?=  $optsel;  ?>
                    <option value="0">Todos... </option>
                    @if(isset($tipoausencias))
                        <?php foreach($tipoausencias as $tip){   ?>
                            <option value="<?= $tip->idtipoausencia; ?>" > <?= $tip->ausencia; ?></option>
                        <?php }  ?>
                    @endif
                </select>
                <input type="text" class="form-control" id="searchText" name="searchText" placeholder="Buscar..."> 
            </div>
            <button type="button" class="btn btn-default" onclick="buscarindexrechazadoJI();">Buscar</button>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/RHjs/ListadoVP.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();

        $('#searchText').keypress(function(e){   
            if(e.which == 13){      
                buscarindexrechazadoJI();      
            }   
        });
    });
</script>