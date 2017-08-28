<form role="form" id="formAgregarVacante">
    <div class="modal-header">
        <label>Afiliado</label>
        <select name="idafiliado" id="idafiliado" class="form-control select2" data-live-search="true">
        @if (isset($afiliado))
        @foreach($afiliado as $tau)
            <option value="{{$tau->idafiliado}}">{{$tau->nombre}}</option>
        @endforeach
        @endif
        </select>
    </div>

    <div class="modal-header">
        <label>Puesto</label>
        <select name="idpuesto" id="idpuesto" class="form-control select2" data-live-search="true">
        @if (isset($puesto))
        @foreach($puesto as $pue)
            <option value="{{$pue->idpuesto}}">{{$pue->nombre}}</option>
        @endforeach
        @endif
        </select>
    </div>
</form>

<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript">

$(document).ready(function() {
  $(".select2").select2();        
});
</script>