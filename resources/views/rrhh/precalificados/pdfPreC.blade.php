<!DOCTYPE html>
<html>
<head>
    <title>Descarga Solicitante</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components1.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="content-page">
        <div class="content">
            <div class="container">
 
			    <div class="row">
			        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			            <div class="form-group">
			                <div class="col-md-10 col-md-12 col-sm-12 col-xs-12">
			                    <h3 class="text-center">Informe Pre Calificado</h3>  
			                    <h3 class="text-center">Información General</h3>    
			                </div>
			            </div>
			        </div>
			    </div>              

			    <div class="row">
			        <input type="hidden" id="idempleado" value="{{$persona->idempleado}}">
			        <input type="hidden" id="identificacion" value="{{$persona->identificacion}}">
			        <input type="hidden" id="idcivl" value="{{$persona->idcivil}}">
			        <input type="hidden" id="identrevista" value="{{$entre->identrevista}}">
			        <div class="col-lg-12" >
			            <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
			                <thead>
			                    <tr>
			                        <th style="width: 20%">Nombre Completo:</th><td>&nbsp;&nbsp;{{$persona->nombre1.' '.$persona->nombre2.' '.$persona->nombre3.' '.$persona->apellido1.' '.$persona->apellido2}}</td>
			                    </tr>
			                    <tr>
			                        <th>Fecha de la Entrevista: </th><td>&nbsp;&nbsp;{{$date}}</td>
			                    </tr>
			                    <tr>
			                        <th>Dirección:</th><td>&nbsp;&nbsp;{{$entre->lugar}}</td>
			                    </tr>
			                    <tr>
			                        <th>Edad:</th><td>&nbsp;&nbsp;{{$fnac}}&nbsp;años</td>
			                    </tr>
			                    <tr>
			                        <th>Estado civil:</th><td>&nbsp;&nbsp;{{$persona->ecivil}}</td>
			                    </tr>
			                    <tr>
			                        <th>Teléfono:</th><td>&nbsp;&nbsp;{{$persona->telefono}}</td>
			                    </tr>
			                    <tr>
			                        <th>Celular:</th><td>&nbsp;&nbsp;{{$persona->celular}}</td>
			                    </tr>
			                    <tr>
			                        @if (!empty($academico->titulo))
			                            <th>Profesión:</th><td>&nbsp;&nbsp;{{$academico->titulo}}</td>
			                        @else
			                            <th>Profesión:</th><td>&nbsp;&nbsp;No ingreso Datos</td>
			                        @endif
			                    </tr>
			                    <tr>
			                        <th>Tiene Licencia de Conducir:</th>
			                        <td>&nbsp;&nbsp;
			                            @foreach($licencias as $lic)
			                                {{$lic->tipolicencia}},
			                            @endforeach
			                        </td>
			                    </tr>              
			                    <tr>
			                         <th>Puesto al que aplica:</th><td>&nbsp;&nbsp;{{$persona->puesto}}</td>                   
			                    </tr>
			                </thead>
			            </table>
			        </div>
			    </div>

			    <div class="row">
			        <div class="col-lg-12">
			            <h5>I. Antecedentes personales y familiares</h5>
			                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
			                    <thead>
			                        @if($persona->idcivil==1)
			                            <tr>
			                                <th style="width: 20%">¿Con quien vive?</th><td>&nbsp;&nbsp;{{$entre->vivecompania}}</td>
			                            </tr>
			                            <tr>
			                                <th>Tipo de residencia</th><td>&nbsp;&nbsp;{{$persona->vivienda}}</td>
			                            </tr>
			                            <tr>
			                                <th>¿A que se dedica sus padres?</th><td>&nbsp;&nbsp;{{$entre->dedicanpadres}}</td>
			                            </tr>
			                            <tr>
			                                <th>Cantidad de hermanos</th>
			                                <td>
			                                @foreach($hermanos as $pers)
			                                    @if($pers->identificacion == $persona->identificacion)
			                                        {{$pers->hermano}}
			                                    @endif
			                                @endforeach
			                                </td>
			                            </tr>
			                            <tr>
			                                <th>¿Quienes aportan para el sustento económico de la familia?</th><td>&nbsp;&nbsp;{{$entre->aportefamilia}}</td>
			                            </tr>
			                        @else
			                            <tr>
			                                <th style="width: 20%">Tipo de residencia</th><td>{{$persona->vivienda}}</td>
			                            </tr>
			                            	@if (!empty($esposa->ocupacion))
                                                <th>¿A qué se dedica su esposa/o?</th><td>{{$esposa->ocupacion}}</td>
                                            @else
                                                <th>¿A qué se dedica su esposa/o?</th><td>&nbsp;&nbsp;No ingreso Datos</td>
                                            @endif
			                            </tr>
			                            <tr>
			                            <th>¿Cuántos hijos tiene?</th>
			                                @foreach($hijo as $pers)
			                                    @if($pers->identificacion == $persona->identificacion)
			                                        <td>{{$pers->hijos}}</td>
			                                    @endif
			                                @endforeach
			                            </tr>
			                        @endif
			                    </thead>
			                </table>
			        </div>
			    </div>

			    <div class="row">
			        <div class="col-lg-12">
			            <h5>II. Antecedentes Académicos </h5>
			                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
			                    <thead>
			                        <tr>
			                            <th>Título</th>
			                            <th>Institución</th>
			                            <th>Duración</th>
			                            <th>Nivel</th>
			                            <th>Ingreso</th>
			                            <th>Salida</th>
			                        </tr>
			                    </thead>
			                    <tbody id="productsA" name="productsA">
			                        @if (isset($academicoIns))
			                        @for ($i=0;$i<count($academicoIns);$i++)
			                            <tr class="even gradeA" id="academicos{{$academicoIns[$i]->idpacademico}}">
			                            <td>{{$academicoIns[$i]->titulo}}</td>
			                            <td>{{$academicoIns[$i]->establecimiento}}</td>
			                            <td>{{$academicoIns[$i]->duracion.': '.$academicoIns[$i]->periodo}}</td>
			                            <td>{{$academicoIns[$i]->nombrena}}</td>
			                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$academicoIns[$i]->fingreso)->format('d/m/Y')}}</td>
			                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d',$academicoIns[$i]->fsalida)->format('d/m/Y')}}</td>
			                            </tr>
			                        @endfor
			                        @endif
			                    </tbody>
			                </table>
			        </div>
			    </div>

			    <div class="row">
			        <div class="col-lg-12">
			            <h5>III. Antecedentes laborales</h5>
			                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
			                    <thead>
			                        <tr>
			                            <th>Empresa</th>
			                            <th>Puesto</th>
			                            <th>Jefe inmediato</th>
			                            <th>Motivo retiro</th>
			                            <th>Salario</th>
			                            <th>Ingreso</th>
			                            <th>Salida</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        @if (isset($experiencia))
			                        @for ($i=0;$i<count($experiencia);$i++)
			                            <tr class="even gradeA" id="experiencia{{$experiencia[$i]->idpexperiencia}}">
			                            <td>{{$experiencia[$i]->empresa}}</td>
			                            <td>{{$experiencia[$i]->puesto}}</td>
			                            <td>{{$experiencia[$i]->jefeinmediato}}</td>
			                            <td>{{$experiencia[$i]->motivoretiro}}</td>
			                            <td>{{$experiencia[$i]->ultimosalario}}</td>
			                            <td>{{$experiencia[$i]->fingresoex}}</td>
			                            <td>{{$experiencia[$i]->fsalidaex}}</td>
			                            </tr>
			                        @endfor
			                        @endif
			                    </tbody>
			                </table>
			        </div>
			    </div>

			    <div class="row">
			        <div class="col-lg-12">
			            <h5>IV. Metas (académicas, personales, laborales, entre otras)</h5>
			                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
			                    <thead>
			                        <tr>
			                            <th style="width: 20%">Meta a corto plazo:</th><td>&nbsp;&nbsp;{{$entre->mcorto}}</td>
			                        </tr>
			                        <tr>
			                            <th>Meta a mediano plazo:</th><td>&nbsp;&nbsp;{{$entre->mmediano}}</td>
			                        </tr>
			                        <tr>
			                            <th>Meta a largo plazo:</th><td>&nbsp;&nbsp;{{$entre->mlargo}}</td>
			                        </tr>
			                    </thead>
			                </table>
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-lg-12">
			            <h5>V. Preguntas importantes</h5>
			                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
			                    <thead>
			                        <tr>
			                            <th style="width: 20%">¿Cómo se describe así mismo?</th><td>&nbsp;&nbsp;{{$entre->descpersonal}}</td>
			                        </tr>
			                        <tr>
			                            <th>¿Le gusta trabajar en equipo?</th><td>&nbsp;&nbsp;{{$entre->trabajoequipo}}</td>
			                        </tr>
			                        <tr>
			                            <th>¿Mantiene un equilibrio bajo la presión del trabajo?</th><td>&nbsp;&nbsp;{{$entre->bajopresion}}</td>
			                        </tr>
			                        <tr>
			                            <th>¿Le gusta la atención al público?</th><td>&nbsp;&nbsp;{{$entre->atencionpublico}}</td>
			                        </tr>
			                        <tr>
			                            <th>Es ordenado.</th>
			                            @if($entre->ordenado == 'Si')
                                            <td>&nbsp;&nbsp;
                                                <input type="checkbox"  name="ordenado" value="Si" checked>Si
                                                <input type="checkbox"  name="ordenado" value="No" >No
                                            </td>
                                        @else
                                            <td>&nbsp;&nbsp;<input type="checkbox"  name="ordenado" value="Si" >Si
                                            <input type="checkbox"  name="ordenado" value="No" checked>No</td>
                                        @endif
			                        </tr>
			                    </thead>
			                </table>
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-lg-12">
			            <h5>VI. Comentarios, observaciones y recomendaciones</h5>
			                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
			                    <thead>
			                        <tr>
			                            <th style="width: 25%">Se presentó en el horario citado:</th><td>&nbsp;&nbsp;{{$entre->puntual}}</td>                            
			                        </tr>
			                        <tr>
			                            <th>Comó es su presentación personal:</th><td>&nbsp;&nbsp;{{$entre->presentacion}}</td>
			                        </tr>
			                        <tr>
			                            <th>Tiene disponibilidad inmediata: </th>
			                            @if($entre->disponibilidad == 'Si')
			                                <td>&nbsp;&nbsp;
			                                    <input type="checkbox"  name="disponibilidad" value="Si" checked>Si
			                                    <input type="checkbox"  name="disponibilidad" value="No" >No
			                                </td>
			                            @else
			                                <td>&nbsp;&nbsp;<input type="checkbox"  name="disponibilidad" value="Si" >Si
			                                <input type="checkbox"  name="disponibilidad" value="No" checked>No</td>
			                            @endif
			                        </tr>
			                        <tr>
			                            <th>Tiene disponibilidad de horario incluso en fines de semana cuando así se requiera:</th>
			                            @if($entre->dispfinsemana == 'Si')
			                                <td>&nbsp;&nbsp;<input type="checkbox" name="dispfinsemana" value="Si" checked>Si
			                                <input type="checkbox" name="dispfinsemana" value="No" >No</td>
			                            @else
			                                <td>&nbsp;&nbsp;<input type="checkbox" name="dispfinsemana" value="Si" >Si
			                                <input type="checkbox" name="dispfinsemana" value="No" checked>No</td>
			                            @endif

			                                        
			                        </tr>
			                        <tr>
			                            <th>Se sabe comunicar:</th><td>&nbsp;&nbsp;{{$entre->comunicar}}</td>
			                        </tr>
			                        <tr>
			                            <th>Tiene disponibilidad para viajar:</th>
			                            @if($entre->dispoviajar == 'Si')
			                                <td>&nbsp;&nbsp;
			                                    <input type="checkbox" name="dispoviajar" value="Si" checked>Si
			                                    <input type="checkbox" name="dispoviajar" value="No">No
			                                </td>
			                            @else
			                                <td>&nbsp;&nbsp;
			                                    <input type="checkbox" name="dispoviajar" value="Si" >Si
			                                    <input type="checkbox" name="dispoviajar" value="No" checked>No
			                                </td>
			                            @endif
			                        </tr>
			                        <tr>
			                            <th>¿Está dispuesto(a) a trabajar bajo presión?</th><td>&nbsp;&nbsp;{{$entre->bajopresion}}</td>
			                        </tr>
			                        <tr>
			                            <th>¿Cuál es su pretensión salarial mínima?</th><td>&nbsp;&nbsp;{{$entre->pretensionminima}}</td>
			                        </tr>
			                        <!--tr>
			                            <th>Recomendaciones o observaciones que se consideren</th><td></td>
			                        </tr-->
			                    </thead>
			                </table>
			        </div>
			    </div>
			    <div class="row">
                    <div class="col-lg-12">
                        <h5>&nbsp;&nbsp;Presenta deudas</h5>
                            <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;" >
                                <thead>
                                    <tr>
                                        <th style="width: 25%">Acreedor</th>
                                        <th style="width: 15%">Amortización mensual</th>
                                        <th style="width: 10%">Monto credito</th>
                                        <th style="width: 50%">Motivo del crédito</th>
                                    </tr>
                                </thead>
                                <tbody id="productsA" name="productsA">
                                    @if (isset($deuda))
                                        @for ($i=0;$i<count($deuda);$i++)
                                            <tr class="even gradeA" id="academicos{{$deuda[$i]->idpdeudas}}">
                                                <td>{{$deuda[$i]->acreedor}}</td>
                                                <td>{{$deuda[$i]->pago}}</td>
                                                <td>{{$deuda[$i]->montodeuda}}</td>
                                                <td>{{$deuda[$i]->motivodeuda}}</td>
                                            </tr>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                    </div>
                </div>
			    <div class="row">
			        <div class="col-lg-12">
			            <h5>Nombres de las personas que entrevistaron</h5>
			                <table width="100%" border="1" cellpadding="0" cellspacing="1" bordercolor="#000000" style="border-collapse:collapse;border-color:#ddd;">
			                    <tbody>
			                        <tr>
			                            <th style="width: 5%">&nbsp;&nbsp;&nbsp;&nbsp;-</th><td>&nbsp;&nbsp;{{$entre->entrevistadores}}</td>
			                        </tr>
			                    </tbody>
			                </table>
			        </div>
			    </div>
			</div>
		</div>
		<footer class="footer text-right">
    		Habitat para la humanidad
        	{{$date}} by:solera
        	<br>
    		<strong>Copyright &copy; <a href="www.solera.com">Solera</a>.</strong> All rights reserved.
    	</footer>
	</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>