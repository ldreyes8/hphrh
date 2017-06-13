
  <div class="row" >
    <div class="col-md-12">
      <div class="box box-primary box-gris">
        <div class="box-header with-border my-box-header">
          <h3 class="box-title"><strong>Asignar rol al usuario: {{$usuario->name}}</strong></h3>
        </div><!-- /.box-header -->
   
        <div id="zona_etiquetas_roles" style="background-color:white;" >
          Roles asignados:
          @foreach($usuario->getRoles() as $rl)
            <span class="label label-warning" style="margin-left:10px;">{{ $rl }} </span> 
          @endforeach
        </div>
        
        <div class="box-body">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-sm-2" for="tipo">Rol a asignar*</label>
              <div class="col-sm-6" >         
                <select id="rol1" name="rol1" class="form-control">
                  @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                  @endforeach
                </select>    
              </div>

              <div class="col-sm-4" >
                <button type="button" class="btn btn-xs btn-primary" onclick="asignar_rol({{$usuario->id }});" >Asignar rol</button>    
              </div>
            </div>
          </div>
          <hr>

          <div class="col-md-12">
            <div class="form-group">
              <label class="col-sm-2" for="tipo">Rol a quitar*</label>
              <div class="col-sm-6" >         
                <select id="rol2" name="rol2" class="form-control">
                  @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                  @endforeach
                </select>    
              </div>
              <div class="col-sm-4" >         
                <button type="button" class="btn btn-xs btn-primary" onclick="quitar_rol({{$usuario->id}});" >Quitar rol</button>    
              </div>
            </div>
          </div>
        </div>
      </div> <!--box -->
    </div>
  </div>
