<td>
    <input type="text" autofocus class="form-control" data-mask="99/99/9999" value="" input-block placeholder="dd/mm/yyyy">
</td>
<td>
    <input type="text" class="form-control" />
</td>
<td>
    <input type="text" class="form-control" name=""></td>
<td>
    <select class="form-control select2" id="emple">
        @foreach($empleado as $emp)
        <option value="{{$emp->idempleado}}">{{$emp->nombre1}}</option>
        @endforeach        
    </select>
</td>
<td>
    <select class="form-control"> 
    @foreach($add as $ad)
        <option value="{{$ad->codigo}}">{{$ad->nombre}}</option>
    @endforeach
    </select>
</td>
<td>
    <select class="form-control"><option>L8</option></select>
</td>
<td>
    <select class="form-control"><option>L9</option></select>
</td>
<td>
    <select class="form-control select2"><option>funcion</option></select>
</td>
<td><input type="text" class="form-control" name=""></td>
<td><input type="text" class="form-control" name="" disabled></td>
<td class="actions">
    <a href="#" class="on-editing save-row"><i class="fa fa-save"></i></a>
    <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>
</td>