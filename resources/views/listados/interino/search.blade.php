{!! Form::open(array('url'=>'listados/interino','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
    <div class="input-group">
        <input type="text" class"form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</div>

{{Form::close()}}