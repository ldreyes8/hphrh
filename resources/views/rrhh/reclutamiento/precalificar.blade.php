@extends ('layouts.index')
@section('estilos')
    @parent
        <link href="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" />
        <style >
input[type=text] {

    background: transparent;
    width: 1000px; /*ancho*/
    border: 0px;outline:none;
    text-align: justify;
    text-justify:inter-word;
}
    </style>
@endsection
@section ('contenido')
<div class="col-md-10 col-md-12 col-sm-12 col-xs-12">
    <h3 class="text-center">Informe entrevista de profundidad</h3>  
    <h3 class="text-center">Información General</h3>    
</div>              
<form role="form" method="POST">
    <div class="row">
    <input type="hidden" id="idempleado" value="{{$persona->idempleado}}">
    <input type="hidden" id="identificacion" value="{{$persona->identificacion}}">
    <input type="hidden" id="idcivl" value="{{$persona->idcivil}}">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000">
                    <thead>
                        <tr>
                            <th style="width: 20%">Nombre Completo:</th><td>&nbsp;&nbsp;<input type="text" name="" value="{{$persona->nombre1.' '.$persona->nombre2.' '.$persona->nombre3.' '.$persona->apellido1.' '.$persona->apellido2}}"></td>
                        </tr>
                        <tr>
                            <th>Fecha de la Entrevista: </th><td>&nbsp;&nbsp;<input type="text" id="fechaentre" name="lugar" maxlength="50" value="{{$date}}" disabled="disabled"></td>
                        </tr>
                        <tr>
                            <th>Dirección:</th><td>&nbsp;&nbsp;<input type="text" id="lugar" name="lugar" maxlength="50"></td>
                        </tr>
                        <tr>
                            <th>Edad:</th><td>&nbsp;&nbsp;{{$fnac}}</td>
                        </tr>
                        <tr>
                            <th>Estado civil:</th><td>&nbsp;&nbsp;{{$persona->ecivil}}</td>
                        </tr>
                        <tr>
                            <th>Teléfono:</th><td>&nbsp;&nbsp;<input type="text" name="" maxlength="8" value="{{$persona->telefono}}"></td>
                        </tr>
                        <tr>
                            <th>Celular:</th><td>&nbsp;&nbsp;<input type="text" name="" maxlength="8" value="{{$persona->celular}}"></td>
                        </tr>
                        <tr>
                            <th>Profesión:</th><td>&nbsp;&nbsp;{{$academico->titulo}}</td>
                        </tr>
                        <tr>
                            <th>Tiene Licencia de Conducir:</th>
                            <td>&nbsp;&nbsp;
                                @foreach($licencias as $lic)
                                    <input type="text" name="" maxlength="1" value="{{$lic->tipolicencia}},">
                                @endforeach
                            </td>
                        </tr>              
                        <tr>
                            <th>Puesto al que aplica:</th><td>&nbsp;&nbsp;{{$persona->puesto}}</td>                   
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>I. Antecedentes personales y familiares</h5>
                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" >
                    <thead>
                        @if($persona->idcivil==1)
                            <tr>
                                <th style="width: 20%">¿Con quien vive?</th><td>&nbsp;&nbsp;<input type="text" id="vivecompania" maxlength="100"></td>
                            </tr>
                            <tr>
                                <th>Tipo de residencia</th><td>&nbsp;&nbsp;{{$persona->vivienda}}</td>
                            </tr>
                            <tr>
                                <th>¿A que se dedica sus padres?</th><td>Soltero tbody</td>
                            </tr>
                            <tr>
                                <th>Cantidad de hermanos</th><td>Soltero tbody</td>
                            </tr>
                            <tr>
                                <th>¿Quienes aportan para el sustento económico de la familia?</th><td>Soltero tbody</td>
                            </tr>
                        @else
                            <tr>
                                <th>Casado</th>
                            </tr>
                            <tr>
                                <th style="width: 20%">Tipo de residencia</th><td>Casado tbody</td>
                            </tr>
                            <tr>
                                <th>¿A qué se dedica su esposa?</th><td>Casado tbody</td>
                            </tr>
                            <tr>
                                <th>¿Cuántos hijos tiene?</th><td>Casado tbody</td>
                            </tr>
                        @endif
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>II. Antecedentes Académicos</h5>
                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" >
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>III. Antecedentes laborales</h5>
                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" >
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>IV. Metas (académicas, personales, laborales, entre otras)</h5>
                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" >
                    <thead>
                        <tr>
                            <th style="width: 20%">Meta a corto plazo:</th><td>&nbsp;&nbsp;<input type="text" id="mcorto" maxlength="100"></td>
                        </tr>
                        <tr>
                            <th>Meta a mediano plazo:</th><td>&nbsp;&nbsp;<input type="text" id="mmediano" maxlength="100"></td>
                        </tr>
                        <tr>
                            <th>Meta a largo plazo:</th><td>&nbsp;&nbsp;<input type="text" id="mlargo" maxlength="100"></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>V. Preguntas importantes</h5>
                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" >
                    <thead>
                        <tr>
                            <th style="width: 20%">¿Cómo se describe así mismo?</th><td>&nbsp;&nbsp;<input type="text" id="descpersonal" maxlength="300"></td>
                        </tr>
                        <tr>
                            <th>¿Le gusta trabajar en equipo?</th><td>&nbsp;&nbsp;<input type="text" id="trabajoequipo" maxlength="150"></td>
                        </tr>
                        <tr>
                            <th>¿Mantiene un equilibrio bajo la presión del trabajo?</th><td>&nbsp;&nbsp;<input type="text" id="bajopresion" maxlength="150"></td>
                        </tr>
                        <tr>
                            <th>¿Le gusta la atención al público?</th><td>&nbsp;&nbsp;<input type="text" id="atencionpublico" maxlength="100"></td>
                        </tr>
                        <tr>
                            <th>Es ordenado.</th><td>&nbsp;&nbsp;<input type="text" id="ordenado" maxlength="2"></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>VI. Comentarios, observaciones y recomendaciones</h5>
                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" >
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h5>Nombres de las personas que entrevistaron</h5>
                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" >
                    <tbody>
                        <tr>
                            <th style="width: 5%">&nbsp;&nbsp;&nbsp;&nbsp;-</th><td>&nbsp;&nbsp;<input type="text" id="entrevistadores" maxlength="200"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <button type="button" id="btnprecalguardar" class="btn btn-primary">Guardar</button>
        <button type="button" id="btndescargar" class="btn btn-primary">Descargar</button>
    </div>
</form>
@endsection
@section('fin')
    @parent
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- Sweet Alert js -->
        <script src="{{asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
        <script src="{{asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>
        <script src="{{asset('assets/js/RHjs/precalifica.js')}}"></script>
@endsection