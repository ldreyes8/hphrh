@extends ('layouts.index')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Empledo detalle </h3>
	</div>
	 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="form-group">
      <label >Identificacion</label>
      <p>{{$empleado->identificacion}}</p>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="form-group">
    <label >Nit</label>
      <p>{{$empleado->nit}}</p>
    </div>
  </div>
</div>
@endsection