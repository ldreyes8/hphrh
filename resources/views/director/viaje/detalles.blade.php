<div class="card-box" id="VPJF">
    <h4 class="box-title" align="center">Detalles de gastos</h4>
    <h4 class="text-center">Nombre: {{$empleado->nombre}}</h4>
    <h4 class="text-center">Caso: {{$empleado->tipogasto}}</h4>
    <a onclick="cargar_formularioviaje(21);"><button class="btn btn-md btn-success waves-effect waves-light" title="Regresar"><i class="ion-arrow-left-a"></i></button></a>
    <hr style="border-color:black;" />

    <div><p><br></p></div>
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Descripción</th> 
                    <th>#Factura</th>
                    <th>Empleado L4</th>
                    <th>LOB L10</th>
                    <th>Donador L8</th>                               
                    <th>Proyecto L9</th>
                    <th>Función L2</th>
                    <th>Monto </th>                               
                    <th>Saldo </th>
                </thead>
                <tbody>
                @foreach($liquida as $liq)
                <tr>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $liq->fechafactura)->format('d-m-Y')}}</td>
                    <td>{{$liq->descripcion}}</td>
                    <td>{{$liq->factura}}</td>
                    <td>{{$liq->nombre}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$liq->nombreproyecto}}</td>
                    <td></td>
                    <td>{{$liq->montofactura}}</td>
                    <td></td>
                </tr>
                @endforeach
                </tbody>    
            </table>
        </div>
    </div>
    @if (isset($vehiculo))
    @if (count($vehiculo) > 0)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4 class="text-center">Vehiculo utilizados</h4>
        <div class="table-responsive">
            <table id="tablavh" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Marca</th> 
                    <th>Placa</th>
                    <th>Color</th>
                    <th>Kilometraje inicio</th>
                    <th>kilometraje fin</th>
                    <th>Kilometraje total</th>                               
                    <th>Status vehiculo</th>
                </thead>
                <tbody>
                    @for ($i=0;$i<count($vehiculo);$i++)
                    <tr class="even gradeA" id="vc{{$vehiculo[$i]->idviajevehiculo}}">
                        <td>{{$vehiculo[$i]->marca}}<input type="hidden" class="idvehiculo" value="{{$vehiculo[$i]->idvehiculo}}"></td>
                        <td>{{$vehiculo[$i]->placa}}</td>
                        <td>{{$vehiculo[$i]->color}}</td>
                        <td>{{$vehiculo[$i]->kilometrajeini}}</td>
                        <td>{{$vehiculo[$i]->kilometrajefin}}</td>
                        <td>{{$vehiculo[$i]->kilacumulado}}</td>
                        <td>{{$vehiculo[$i]->statusvehiculo}}</td>
                    </tr>
                    @endfor
                </tbody>  
            </table>
        </div>
    </div>
    @endif
    @endif
    </div>
</div>
