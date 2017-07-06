{!! Form::open(array('url'=>'seguridad/usuario','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
    <div class="input-group">
    {!! Form::text('name', null,['class'=>'form-control','placeholder'=>'Buscar usuario']) !!} 
        <span class="input-group-btn">
           <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
    </div>
</div>

{{Form::close()}}