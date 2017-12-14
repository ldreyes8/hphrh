<form role="form" id="formAgregarLiquidar">
    <div class="modal-header">
        <div><br></div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label>Fecha</label>
            <div class="input-group">
                <input type="text"  class="form-control" data-mask="99/99/9999" id="fechafactura" input-block placeholder="dd/mm/yyyy" value="{{\Carbon\Carbon::createFromFormat('Y-m-d',$gastoempleado->fechafactura)->format('d/m/Y')}}">
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label"># Factura</label>
            <div class="input-group">
                <input type="text" class="form-control" maxlength="45" id="factura" value="{{$gastoempleado->factura}}" />
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label for="numerodependientes">Monto</label>
            <input id="monto" type="number" min="0" value="{{$gastoempleado->montofactura}}" class="form-control" onkeypress="return validadecimal(event,this)">
        </div>
    </div>
    <div class="modal-header">
        <br>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label">Empleado</label>
            <select class="form-control select2" id="emple">
                @foreach($empleado as $emp)
                @if($gastoempleado->idempleado == $emp->idempleado)
                <option value="{{$emp->idempleado}}" selected="">{{$emp->nombre1.' '.$emp->nombre2.' '.$emp->nombre3.' '.$emp->apellido1.' '.$emp->apellido2.' '.$emp->apellido3}}</option>
                @else
                <option value="{{$emp->idempleado}}">{{$emp->nombre1.' '.$emp->nombre2.' '.$emp->nombre3.' '.$emp->apellido1.' '.$emp->apellido2.' '.$emp->apellido3}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label">Cuenta</label>
            <select class="form-control select2" id="cuenta">
                @foreach($cuenta as $cue)
                @if($gastoempleado->codigocuenta == $cue->codigocuenta)
                <option value="{{$cue->codigocuenta}}" selected="">{{$cue->nombrecuenta}}</option>
                @else
                <option value="{{$cue->codigocuenta}}">{{$cue->nombrecuenta}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <!--
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label">Cliente</label>
            <select class="form-control select2" id="cliente">
                <option>Activos Intangibles</option>
                <option>Aldea Global</option>
                <option>Aguinaldo</option>
                <option>Alimentacion</option>
            </select>
        </div>
        -->

        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label">Eventos</label> 
            <select class="form-control select2" id="evento">
                @foreach($eventos as $eve)
                @if($gastoempleado->evento == $eve->codigo)
                <option value="{{$eve->codigo}}" selected="">{{$eve->nombre}}</option>
                @else
                <option value="{{$eve->codigo}}">{{$eve->nombre}}</option>
                @endif
                @endforeach
            </select>
        </div>


    </div>
    <div class="modal-header">
        <br>
        
        <!--
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label">LOB L10</label>
            <select class="form-control select2" data-live-search="true" id="l10">
                <option>Servicios directo a la Familia</option>
                <option>Casa Nuevas</option>
                <option>Reparadas/Casa mejoradas</option> 
            </select>
        </div>
        -->

        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label">Linea de presupuesto</label>
            <select class="form-control select2" id="donador">
                @foreach($donantes as $eve)
                @if($gastoempleado->donante == $eve->codigo)
                <option value="{{$eve->codigo}}" selected="">{{$eve->nombre}}</option>
                @else
                <option value="{{$eve->codigo}}">{{$eve->nombre}}</option>
                @endif
                @endforeach
            </select>
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label">Proyecto</label>
            <select class="form-control select2" id="proyecto">
            @foreach($proyectos as $pro)
            @if($gastoempleado->idproyecto == $pro->idproyecto)
                <option value="{{$pro->idproyecto}}" selected="">{{$pro->nombreproyecto}}</option>
            @else
                <option value="{{$pro->idproyecto}}" selected="">{{$pro->nombreproyecto}}</option>
            @endif
            @endforeach
            </select>
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <label class="control-label">Departamento</label>
            <select class="form-control select2" id="departamento">
                <option> Admin- Auditoria Interna</option>
                <option> Admin- Compras</option>
            </select>
        </div>
    </div>
    
    <div class="modal-header">
        <br>
        <div class="form-group">
            <label>Descripción</label>
            <textarea class="form-control" placeholder=".........." id="descripcion" rows="1" maxlength="50">{{$gastoempleado->descripcion}}</textarea>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();        
    });
</script>