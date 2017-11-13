<div class="card-box" id="VPJF">

    @if($liquidar == 1)

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="navbar-form navbar-left pull-left">
            <button class="btn btn-success btn-md"onclick="cargar_formularioviaje(2);"><i class="fa fa-reply-all"></i></button>
        </div>
        <h4 class="box-title" align="center">Detalle avance</h4>
        <hr style="border-color:black;" />
    </div>

    <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>" />
    <div class="panel">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="navbar-form navbar-left pull-right">
                <div class="form-group col-lg-6">
                    <label>Monto solicitado</label>
                    <label>{{$proyecto->monto}}</label>
                </div>
                <div class="form-group col-lg-6">
                    <label>Tipo Proyecto</label>
                    <label>{{$proyecto->nombreproyecto}}</label>
                </div>
                <div class="form-group col-lg-6">
                    <label>Fecha inicio</label>
                    <label>{{\Carbon\Carbon::createFromFormat('Y-m-d',$proyecto->fechainicio)->format('d/m/Y')}}</label>
                </div>
                <div class="form-group col-lg-6">
                    <label>Fecha final</label>
                    <label>{{\Carbon\Carbon::createFromFormat('Y-m-d',$proyecto->fechafin)->format('d/m/Y')}}</label>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
            </div>

            @if(isset($vehiculo))
            @if(count($vehiculo) > 0)
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 2%">id</th>
                                <th style="width: 50%">vehiculo</th>
                                <th style="width: 24%">kilometraje inicial</th>
                                <th style="width: 24%">kilometraje final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehiculo as $veh)
                            <tr id="vehiculos{{$veh->idviajevehiculo}}">
                                <td>{{$veh->idviajevehiculo}}</td>
                                <td>{{$veh->marca.' '.$veh->color.' '.$veh->modelo}}</td>
                                <td>{{$veh->kilometrajeini}}</td>
                                <td>{{$veh->kilometrajefin}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @endif

            <div class="pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-hover">
                        <tr>
                            <th><p style="color:green;" align="center">Fondo Efectivo</p></th><td id="montot">{{$proyecto->monto}}</td>
                        </tr>
                        <tr>
                            <th bgcolor="#BCF5A9"><p style="color:green;" align="center">Liquidación</p></th><td bgcolor="#BCF5A9" id="liquidacion"><strong>0.00</strong></td>
                        </tr>
                        <tr>
                            <th><p style="color:green;" align="center">Disponible</p></th><td id="disponible">{{$proyecto->monto}}</td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        <br/><div class='rechazado' align="center"><label style='color:#FA206A'>...No se ha encontrado ningun detalle...</label>  </div> 
    @endif
</div>