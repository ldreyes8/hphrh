  $(document).ready(function() {

                $('#bt_add1').click(function() {
                    agregar1();
                });

                $('#bt_add2').click(function() {
                    agregar2();
                });

                $('#bt_add3').click(function() {
                    agregar3();
                });

                $('#bt_add4').click(function() {
                    agregar4();
                });
                $('#bt_add5').click(function() {
                    agregar5();
                });
                $('#bt_add6').click(function() {
                    agregar6();
                });
                $('#bt_add7').click(function() {
                    agregar7();
                });
                $('#bt_add8').click(function() {
                    agregar8();
                });
                $('#bt_next').click(function() {
                    identificacion=$("#identificacion").val();
                    nombre1=$("#nombre1").val();
                    apellido1=$("#apellido1").val();
                    celular=$("#celular").val();
                    nit=$("#nit").val();
                    pretension=$("#pretension").val();
                    if (identificacion!="" )
                        {                     
                        }
                    else
                        {
                            alert('Revise los campos obligatorios *');
                            return false;
                        }
                    if (nombre1!="" )
                        {                     
                        }
                    else
                        {
                            alert('Revise los campos obligatorios *');
                            return false;
                        }
                    if (apellido1!="")
                        {                     
                        }
                    else
                        {
                            alert('Revise los campos obligatorios *');
                            return false;
                        }
                    if (celular!="")
                        {                     
                        }
                    else
                        {
                            alert('Revise los campos obligatorios *');
                            return false;
                        }
                    if (nit!="")
                        {                     
                        }
                    else
                        {
                            alert('Revise los campos obligatorios *');
                            return false;
                        }
                    if (pretension!="")
                        {                     
                        }
                    else
                        {
                            alert('Revise los campos obligatorios *');
                            return false;
                        }
                });

                $('#basicwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted'});

                $('#progressbarwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;
                    var $percent = ($current/$total) * 100;
                    $('#progressbarwizard').find('.bar').css({width:$percent+'%'});
                },
                'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted'});

                $('#btnwizard').bootstrapWizard({'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted','nextSelector': '.button-next', 'previousSelector': '.button-previous', 'firstSelector': '.button-first', 'lastSelector': '.button-last'});
                
                
                var $validator = $("#form").validate({
                    rules: {
                        identificacion: {
                            required: true,
                            maxlength: 13
                        },
                        nombre1: {
                            required: true
                        },
                        apellido1: {
                            required: true
                        }
                    }
                });
                $('#rootwizard').bootstrapWizard({
                    'tabClass': 'nav nav-tabs navtab-custom nav-justified bg-muted',
                    'onNext': function (tab, navigation, index) {
                        var $valid = $("#form").valid();
                        if (!$valid) {
                            $validator.focusInvalid();
                            return false;
                        }
                    }
                });
               
            });
        //variables 
            var cont=0;
            var conts=0;
            var contss=0;
            var contsss=0;
            var contEx=0;
            var contAc=0;
            var contId=0;
            var contL=0;
            $("#gdr").hide();
        //confirmacion de formulario
            function showContent() {
                check = document.getElementById("confirma");
                if (check.checked) {
                    $("#gdr").show();
                }
                else {
                    $("#gdr").hide();
                }
            }
            function Finiquito(elemento) {
                element = document.getElementById("Dfini");
                if (elemento.value=="Si") {
                    element.style.display='block';
                }
                else 
                { if (elemento.value=="No") {
                    element.style.display='none';
                }
                }
            }
            function FPariente(elemento) {
                element = document.getElementById("Dpariente");
                if (elemento.value=="Si") {
                    element.style.display='block';
                }
                else 
                { if (elemento.value=="No") {
                    element.style.display='none';
                }
                }
            }
        //Departamento combo
            $("#iddepartamento").change(event => {
                $.get(`towns/${event.target.value}`, function(res, sta){
                    $("#idmunicipio").empty();
                    res.forEach(element => {
                        $("#idmunicipio").append(`<option value=${element.idmunicipio}> ${element.nombre} </option>`);
                            });
                        });
                    });

            $("#iddepartamento1").change(event => {
                $.get(`towns/${event.target.value}`, function(res, sta){
                    $("#pidmunicipio").empty();
                    res.forEach(element => {
                        $("#pidmunicipio").append(`<option value=${element.idmunicipio}> ${element.nombre} </option>`);
                            });
                        });
                    });
        //Validaciones Letras y numeros
            function valida(e){
                tecla = e.keyCode || e.which;
                tecla_final = String.fromCharCode(tecla);
                //Tecla de retroceso para borrar, siempre la permite
                if (tecla==8 || tecla==37 || tecla==39 ||tecla==46 ||tecla==9)
                    {
                        return true;
                    } 
                // Patron de entrada, en este caso solo acepta numeros
                patron =/[0-9]/;
                //patron =/^\d{9}$/;
                return patron.test(tecla_final);

            }
            //Se utiliza para que el campo de texto solo acepte letras
            function validaL(e) {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toString();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ63";//Se define todo el abecedario que se quiere que se muestre.
                especiales = [8, 37, 39, 46, 9]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.
                tecla_especial = false
                for(var i in especiales) {
                    if(key == especiales[i]) {
                        tecla_especial = true;
                        break;
                    }
                }
                if(letras.indexOf(tecla) == -1 && !tecla_especial){
                    //alert('Tecla no aceptada');
                    return false;
                  }
            }
        //Funciones Limpiar -->
            function limpiar1()
            {
                $("#nombre").val("");
            }

            function limpiar2()
            {
                $("#acreedor").val("");
                $("#amortizacionmensual").val("");
                $("#montodeuda").val("");
            }

            function limpiar3()
            {
                $("#nombrer").val("");
                $("#telefonor").val("");
                $("#profesion").val("");
            }
            function limpiar4()
            {
                $("#nombref").val("");
                $("#apellidof").val("");
                $("#edad").val("");
                $("#telefonof").val("");
                $("#ocupacion").val("");
                $("#emergencia").attr('checked', false);
            }

            function limpiar5()
            {
                $("#empresa").val("");
                $("#puesto").val("");
                $("#jefeinmediato").val("");
                $("#motivoretiro").val("");
                $("#ultimosalario").val("");
                $("#fingresoex").val("");
                $("#fsalidaex").val("");
            }

            function limpiar6()
            {
                $("#titulo").val("");
                $("#establecimiento").val("");
                $("#duracion").val("");
                //$("#nivel").val("");
                $("#dato2").val("");
                $("#dato3").val("");
            }
            function limpiar7()
            {
                $("#vigencia").val("");
            }
        //Funciones agregar
            function agregar1()
            {

                nombre=$("#nombre").val();

                if (nombre!="")
                {
                    var fila='<tr class="selected" id="fila'+cont+'"><td><input type="hidden" name="nombre[]" value="'+nombre+'">'+nombre+'</td>  </tr>';
                    cont++;
                    limpiar1();
                    //evaluar();
                    $('#detalle').append(fila);
                }
                else
                {
                    alert('Ingrese un padecimiento')
                }   
            }

            function agregar2()
            {
                acreedor=$("#acreedor").val();
                amortizacionmensual=$("#amortizacionmensual").val();
                montodeuda=$("#montodeuda").val();
                if (acreedor!="")
                {
                    var fila='<tr class="selected" id="fila'+conts+'"> <td><input type="hidden" name="acreedor[]" value="'+acreedor+'">'+acreedor+'</td> <td><input type="hidden" name="amortizacionmensual[]" value="'+amortizacionmensual+'">'+amortizacionmensual+'</td> <td><input type="hidden" name="montodeuda[]" value="'+montodeuda+'">'+montodeuda+'</td> </tr>';
                    conts++;
                    limpiar2();
                    $('#detalles').append(fila);
                }
                else
                {
                    alert('Campo acreedor requerido')
                }   
            }

            function agregar3()
            {

                nombrer=$("#nombrer").val();
                telefonor=$("#telefonor").val();
                profesion=$("#profesion").val();
                tiporeferencia=$("#tiporeferencia").val();
                //alert(tiporeferencia);

                if (nombrer!="")
                {
                    var fila='<tr class="selected" id="fila'+contss+'"> <td><input type="hidden" name="nombrer[]" value="'+nombrer+'">'+nombrer+'</td> <td><input type="hidden" name="telefonor[]" value="'+telefonor+'">'+telefonor+'</td> <td><input type="hidden" name="profesion[]" value="'+profesion+'">'+profesion+'</td> <td><input type="hidden" name="tiporeferencia[]" value="'+tiporeferencia+'">'+tiporeferencia+'</td> </tr>';
                    contss++;
                    limpiar3();
                    $('#detalle3').append(fila);
                }
                else
                {
                    alert('Existen campos obligatorios')
                }   
            }

            function agregar4()
            {
                nombref=$("#nombref").val();
                apellidof=$("#apellidof").val();
                edad=$("#edad").val();
                telefonof=$("#telefonof").val();
                parentezco=$("#parentezco").val();
                ocupacion=$("#ocupacion").val();
                emergencia=$("#emergencia").val();
                emr=("No");
                emrg=("Si");
                //alert(emergencia);

                

                if (nombref!="")
                {
                    if ( $('#emergencia').is(':checked'))
                    {
                        var fila='<tr class="selected" id="fila'+contsss+'"> <td><input type="hidden" name="nombref[]" value="'+nombref+'">'+nombref+'</td> <td><input type="hidden" name="apellidof[]" value="'+apellidof+'">'+apellidof+'</td> <td><input type="hidden" name="edad[]" value="'+edad+'">'+edad+'</td> <td><input type="hidden" name="telefonof[]" value="'+telefonof+'">'+telefonof+'</td> <td><input type="hidden" name="parentezco[]" value="'+parentezco+'">'+parentezco+'</td> <td><input type="hidden" name="ocupacion[]" value="'+ocupacion+'">'+ocupacion+'</td> <td><input type="hidden" name="emergencia[]" value="'+emergencia+'">'+emrg+'</td> </tr>';
                    contsss++;
                    limpiar4();
                    $('#detalle4').append(fila);
                    }
                    else 
                    {
                        var fila='<tr class="selected" id="fila'+contsss+'"> <td><input type="hidden" name="nombref[]" value="'+nombref+'">'+nombref+'</td> <td><input type="hidden" name="apellidof[]" value="'+apellidof+'">'+apellidof+'</td> <td><input type="hidden" name="edad[]" value="'+edad+'">'+edad+'</td> <td><input type="hidden" name="telefonof[]" value="'+telefonof+'">'+telefonof+'</td> <td><input type="hidden" name="parentezco[]" value="'+parentezco+'">'+parentezco+'</td> <td><input type="hidden" name="ocupacion[]" value="'+ocupacion+'">'+ocupacion+'</td> <td><input type="hidden" name="emergencia[]" value="no">'+emr+'</td> </tr>';
                    contsss++;
                    limpiar4();
                    $('#detalle4').append(fila);
                    }
                }
                else
                {
                    alert('Existen campos obligatorios')
                }   
            }

            function agregar5()
            {
                empresa=$("#empresa").val();
                puesto=$("#puesto").val();
                jefeinmediato=$("#jefeinmediato").val();
                motivoretiro=$("#motivoretiro").val();
                ultimosalario=$("#ultimosalario").val();
                fingresoex=$("#fingresoex").val();
                fsalidaex=$("#fsalidaex").val();
                //alert(tiporeferencia);

                if (empresa!="")
                {
                    var fila='<tr class="selected" id="fila'+contEx+'"> <td><input type="hidden" name="empresa[]" value="'+empresa+'">'+empresa+'</td> <td><input type="hidden" name="puesto[]" value="'+puesto+'">'+puesto+'</td> <td><input type="hidden" name="jefeinmediato[]" value="'+jefeinmediato+'">'+jefeinmediato+'</td> <td><input type="hidden" name="motivoretiro[]" value="'+motivoretiro+'">'+motivoretiro+'</td> <td><input type="hidden" name="ultimosalario[]" value="'+ultimosalario+'">'+ultimosalario+'</td> <td><input type="hidden" name="fingresoex[]" value="'+fingresoex+'">'+fingresoex+'</td> <td><input type="hidden" name="fsalidaex[]" value="'+fsalidaex+'">'+fsalidaex+'</td> </tr>';
                    contEx++;
                    limpiar5();
                    $('#detalle5').append(fila);
                }
                else
                {
                    alert('Campos requerido')
                }   
            }

            function agregar6()
            {
                titulo=$("#titulo").val();
                establecimiento=$("#establecimiento").val();
                duracion=$("#duracion").val();

                idnivels=$("#idnivel").val();
                idniveltx=$("#idnivel option:selected").text();

                fingreso=$("#dato2").val();
                fsalida=$("#dato3").val();
                pidmunicipio=$("#pidmunicipio").val();
                municipio=$("#pidmunicipio option:selected").text();
                //pidmunicipio=$("#pidmunicipio option:selected").text();

                if (titulo!="")
                {
                    var fila='<tr class="selected" id="fila'+contAc+'"> <td><input type="hidden" name="titulo[]" value="'+titulo+'">'+titulo+'</td> <td><input type="hidden" name="establecimiento[]" value="'+establecimiento+'">'+establecimiento+'</td> <td><input type="hidden" name="duracion[]" value="'+duracion+'">'+duracion+'</td> <td><input type="hidden" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td><input type="hidden" name="fingreso[]" value="'+fingreso+'">'+fingreso+'</td> <td><input type="hidden" name="fsalida[]" value="'+fsalida+'">'+fsalida+'</td> <td><input type="hidden" name="pidmunicipio[]" value="'+pidmunicipio+'">'+municipio+'</td> </tr>';
                    contAc++;
                    limpiar6();
                    $('#detalle6').append(fila);
                }
                else
                {
                    alert('Ingrese un titulo')
                }   
            }
            function agregar7()
            {

                idioma=$("#ididioma").val();
                idiomaTex=$("#ididioma option:selected").text();
                niveli=$("#niveli").val();
                if(!$('#niveli').val())
                {
                    alert('seleccione un nivel')
                }
                else
                {
                    var fila='<tr class="selected" id="fila'+contId+'"><td><input type="hidden" name="eidioma[]" value="'+idioma+'">'+idiomaTex+'</td> <td><input type="hidden" name="niveli[]" value="'+niveli+'">'+niveli+'</td> </tr>';
                    contId++;
                    $('#detalle7').append(fila);
                    //alert('valor seleccionado')
                }

            }
            function agregar8()
            {

                licencia=$("#licencia").val();
                licenciatex=$("#licencia option:selected").text();
                vigencia=$("#vigencia").val();
                if(vigencia!="")
                {
                    var fila='<tr class="selected" id="fila'+contL+'"><td><input type="hidden" name="licenciaid[]" value="'+licencia+'">'+licenciatex+'</td> <td><input type="hidden" name="vigencia[]" value="'+vigencia+'">'+vigencia+'</td> </tr>';
                    contL++;
                    limpiar7();
                    $('#detalle8').append(fila);
                }
                else
                {
                    alert('Campo vigencia obligatorio')
                }

            }
            function evaluar()
            {
                if (cont>0){
                    $("#guardar").show();
                }
                else{
                    $("#guardar").hide();
                }
            }