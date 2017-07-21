    <div class="row">
   		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   			<h3>Listado de empleados activos </h3>
		 	<div class="navbar-form navbar-left pull-left">
	            <div class="form-group">
	            	<input type="text" class="form-control" id="searchText" name="searchText" placeholder="Buscar..."> 
	            </div>
	            <button type="button" class="btn btn-default" onclick="buscarempleadoActivo();">Buscar</button>
	        </div>

	 		<div class="navbar-form navbar-left pull-right">
		 		<div class="col-lg-12 col-md-12 col-sm-1 col-xs-12">
		 			<p>Agregar Nombramiento y/o asecenso</p>
		            <button class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></button>
		        </div>
	 		</div>
        </div>
    </div>

<script type="text/javascript"> $(document).ready(function() {


            $('#searchText').keypress(function(e){   
               if(e.which == 13){      
                 buscarempleadoActivo();
               }   
              });    
            
        });</script>