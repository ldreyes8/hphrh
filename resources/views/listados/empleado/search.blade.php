{!! Form::open(array('url'=>'listados/empleado','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
    <div class="form-group">
    	<select name="idcaso" class="form-control" data-live-search="true">
            <option value="idcaso" hidden>General</option>
            @foreach($caso as $p)
                <option value="{{$p->idcaso}}">{{$p->nombre}}</option>
            @endforeach
        </select>

        <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>

{{Form::close()}}
