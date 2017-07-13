@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nuevo Empleado</h3>
		@if (count($errors)>0)
			<div class="alert alert-danger">
            <ul>
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
			</div>
			@endif
       </div>
    </div>
        
  {!!Form::open(array('url'=>'empleado/empleado','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
  {{Form::token()}}

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="form-group">
                <label for="identificacion">Codigo Identificacion</label>
                @foreach($personas as $cat)

                <input type="text" name="identificacion" class="form-control" placeholder="{{$cat->identificacion}}" value="{{$cat->identificacion}}">
                @endforeach
            </div>
        </div>      
  </div>
         
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
           <div class="form-group">
                <label for="nit">Nit</label>
                <input type="text" name="nit" required value="{{old('nit')}}" class="form-control" placeholder="nit empleado">
            </div>
        </div>
    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    	   <div class="form-group">
            	<label for="afiliacionigss">Afiliacion igss</label>
            	<input type="text" name="afiliacionigss" class="form-control" placeholder="afilacion igss">
            </div>
    	</div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Tipo Licencia</label>
                <select name="tipolicencia" class="form-control">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="M">M</option>
                <option value="T">T</option>
                </select>
            </div>
        </div>

    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    		<div class="form-group">
            	<label for="numerodependientes">Numero dependientes</label>
            	<input type="text" name="numerodependientes" required value="{{old('numerodependientes')}}" class="form-control" placeholder="dependientes...">
            </div>
    	</div>
    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    	    <div class="form-group">
            	<label for="aportemensual">Aporte Mensual</label>
            	<input type="text" name="aportemensual" class="form-control" placeholder="aporte mensual...">
            </div>
    	</div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Vivienda</label>
                <select name="vivienda" class="form-control">
                <option value="vive con familiares">vive con familiares</option>
                <option value="casa propia">casa propia</option>
                <option value="Alquila">Alquila</option>
                </select>
            </div>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    	    <div class="form-group">
            	<label for="alquilermensual">Alquiler Mensual</label>
            	<input type="text" name="alquilermensual" class="form-control" placeholder="Alquiler mensual...">
            </div>
    	</div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="otrosingresos">Otros ingresos</label>
                <input type="text" name="otrosingresos" class="form-control" placeholder="Otros ingresos...">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="pretension">Pretension</label>
                <input type="text" name="pretension" value="{{old('pretension')}}" class="form-control" placeholder="pretension salarial mensual quetzales...">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Estado Civil</label>
                <select name="idcivil" class="form-control selectpicker" data-live-search="true">
                    @foreach($estadocivil as $cat)
                        <option value="{{$cat->idcivil}}">{{$cat->estado}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Puesto</label>
                <select name="idpuesto" class="form-control selectpicker" data-live-search="true">
                    @foreach($puestos as $cat)
                        <option value="{{$cat->idpuesto}}">{{$cat->nombre}}</option>
                    @endforeach
                </select>

            </div>
        </div>

          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Afiliado</label>
                <select name="idafiliado" class="form-control selectpicker" data-live-search="true">
                    @foreach($afiliados as $cat)
                        <option value="{{$cat->idafiliado}}">{{$cat->nombre}}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>
        </div>
     
     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Idioma</label>
                <select name="ididioma" class="form-control selectpicker" data-live-search="true" >
                    @foreach($idiomas as $cat)
                        <option value="{{$cat->ididioma}}">{{$cat->ididioma}}</option>
                    @endforeach
                </select>
                 <label class="radio-inline"><input type="radio" name="optradio">Avanzado</label>
                 <label class="radio-inline"><input type="radio" name="optradio">Intermedio</label>
                 <label class="radio-inline"><input type="radio" name="optradio">Principiante</label> 
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-info" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>




    </div>      
           
     {!!Form::close()!!}		
            

@endsection
