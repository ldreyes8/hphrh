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
                $('#bt_addTE').click(function() {
                    agregarTE();
                });
                $('#prs2').click(function() {
                    prs();
                });
                $('#bt_next').click(function() {
                    identificacion=$("#identificacion").val();
                    var miurl="verificacion/"+identificacion;
                    nombre1=$("#nombre1").val();
                    apellido1=$("#apellido1").val();
                    celular=$("#celular").val();
                    nit=$("#nit").val();
                    pretension=$("#pretension").val();
                    dato1=$("#dato1").val();   
                    idpaisPS=$("#idpaisPS").val();    
                    iddepartamento=$("#iddepartamento").val();
                    barriocolonia=$("#barriocolonia").val();       
                    puesto=$("#puesto").val();
                    afiliado=$("#afiliado").val();
                    correo=$("#correo").val();

                    if (identificacion!="" )
                        {  
                            $.ajax({
                                url: miurl
                            }).done( function(resul) 
                            {
                                swal({ 
                                        title:"Usuario Existente",
                                        text: "Este DPI ya se encuentra en nuestros registros, si usted es empleado y desea aplicar a un puesto interno por favor realicelo en su perfil de usuario",
                                        type: "error"
                                    },
                                    function(){
                                        window.location.href="https://www.habitatguate.org/"; 
                                    });

                            }).fail( function() 
                            {
                                
                            });
                                      
                        }
                    else
                        {
                            swal("Su Identicación es requerida *");
                            
                            //alert('Su Identicación es requerida *');
                            return false;
                        }
                    
                    if (nombre1!="" )
                        {                     
                        }
                    else
                        {
                            swal('Almenos el primer nombre debe ser ingresado *');
                            return false;
                        }
                    if (apellido1!="")
                        {                     
                        }
                    else
                        {
                            swal('Almenos el primer apellido debe ser ingresado *');
                            return false;
                        }
                    if (celular!="")
                        {                     
                        }
                    else
                        {
                            swal('Celular, campo requerido *');
                            return false;
                        }
                    if (barriocolonia!="")
                        {                     
                        }
                    else
                        {
                            swal('Direción, campo obligatorio *');
                            return false;
                        }
                    if (dato1!="")
                        {                     
                        }
                    else
                        {
                            swal('Su fecha de nacimiento es requerida *');
                            return false;
                        }
                    if (pretension!="")
                        {                     
                        }
                    else
                        {
                            swal('Su pretensión salarial es importante para nosostros *');
                            return false;
                        }
                    if(puesto!="")
                    {
                        
                    }
                    else
                    {
                        swal('Debe seleccionar un puesto a aplicar');
                        return false;
                    }
                    if(afiliado!="")
                    {
                        
                    }
                    else
                    {
                        swal('Debe seleccionar un afiliado a aplicar');
                        return false;
                    }
                    if(correo!="")
                    {
                        
                    }
                    else
                    {
                        swal('Debe ingresar su correo electronico');
                        return false;
                    }
                    if(idpaisPS!="")
                        {
                            if (idpaisPS == "73" ) 
                            {
                                if(iddepartamento!="1")
                                {
                                }
                                else
                                {
                                    swal('Departamento es un campo obligatorio *');
                                    return false;
                                }
                                if (nit!="")
                                    {                     
                                    }
                                else
                                    {
                                        swal('Nit es un campo obligatorio *');
                                        return false;
                                    }
                            }
                            else
                            {

                            }
                        }
                    else
                        {
                            swal('El pais es un compo obligatorio');
                            return false;
                        }
                });
                $('#btnnextf').click(function(){
                    var valores =[];
                    var tablaPF=$("#detalle4 tr");
                    tablaPF.each(function(){
                        var nombref = $(this).find('td').eq(1).html();
                        valor = new Array(nombref);
                        valores.push(valor);
                    });
                    if (valores != ""){}
                    else
                    {
                        swal("Error", "Ingrese un famíliar para poder continuar.", "error");
                        return false;
                    }
                });
                $('#btnextacad').click(function(){
                    var valores =[];
                    var tablaPF=$("#detalle6 tr");
                    tablaPF.each(function(){
                        var nombref = $(this).find('td').eq(1).html();
                        valor = new Array(nombref);
                        valores.push(valor);
                    });
                    if (valores !=""){}
                    else
                    {
                        swal("Error", "Agregue sus datos académicos para poder continuar.", "error");
                        return false;
                    }
                });
                $('#btnextref').click(function(){
                    var valores =[];
                    var tablaPF=$("#detalle3 tr");
                    tablaPF.each(function(){
                        var nombref = $(this).find('td').eq(1).html();
                        valor = new Array(nombref);
                        valores.push(valor);
                    });
                    if (valores !=""){}
                    else
                    {
                        swal("Error", "Debe inresar datos de refenicas para poder continuar.", "error");
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
            var contTE=0;
            $("#gdr").hide();
        //confirmacion de formulario
            function showContent() {
                check = document.getElementById("confirma");
                nom=$("#g-recaptcha-response").val();
                if (check.checked) {
                    $("#gdr").show();
                }
                else {
                    $("#gdr").hide();
                }
            }

            function Fextra(elemento) {
                element = document.getElementById("Dextranjero");
                if (elemento.value=="Si") {
                    element.style.display='block';
                }
                else 
                { if (elemento.value=="No") {
                    element.style.display='none';
                }
                }
            }

            function anular(e) {
                  tecla = (document.all) ? e.keyCode : e.which;
                  return (tecla != 13);
             }

             function anularEspacios(e) {
                  tecla = (document.all) ? e.keyCode : e.which;
                  return (tecla == 8);
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
                $("#mdeuda").val("");
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
                $("#puesto5").val("");
                $("#jefeinmediato").val("");
                $("#teljefeinmediato").val("");
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
            function limpiarTE()
            {
                $("#format").val("");
                $("#idpaist").val("");
                $("#motivofint").val("");
            }
        //Funciones agregar
            function prs()
            {

                nombre=$("#g-recaptcha-response").val();
                alert(nombre);/*
                if (nombre == true)
                {
                    alert('correcto');
                }*/
                if (nombre == false)
                {
                    alert('incorrecto');
                }//dd(nombre);
                else
                {
                    alert('bus');  
                    $("#gdr").show();

                }             
            }

            function Empleadoypersona()
            {
                identificacion=$("#identificacion").val();
                nombre1=$("#nombre1").val();
                nombre2=$("#nombre2").val();
                nombre3=$("#nombre3").val();
            }
            function agregar1()
            {

                nombre=$("#nombre").val();

                if (nombre!="")
                {
                    var filaP='<tr class="selected" id="filaP'+cont+'"><td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarP('+cont+');">X</button></td><td>'+nombre+'</td>  </tr>';
                    cont++;
                    limpiar1();
                    //evaluar();
                    $('#detalle').append(filaP);
                }
                else
                {
                    alert('Ingrese un padecimiento')
                }   
            }

            function eliminarP(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaP" + index).remove();
                }
            }

            function agregar2()
            {
                acreedor=$("#acreedor").val();
                amortizacionmensual=$("#amortizacionmensual").val();
                montodeuda=$("#montodeuda").val();
                mdeuda=$("#mdeuda").val();
                if ((acreedor!="") && (amortizacionmensual!="") && (montodeuda!=""))
                {
                    var filaC='<tr class="selected" id="filaC'+conts+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarC('+conts+');">X</button></td> <td>'+acreedor+'</td> <td>'+amortizacionmensual+'</td> <td>'+montodeuda+'</td> <td>'+mdeuda+'</td> </tr>';
                    conts++;
                    limpiar2();
                    $('#detalles').append(filaC);
                }
                else
                {
                    alert('Si usted esta ingresando un Crédito, todos los campos son obligatorios')
                }   
            }

            function eliminarC(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaC" + index).remove();
                }
            }

            function agregar3()
            {

                nombrer=$("#nombrer").val();
                telefonor=$("#telefonor").val();
                profesion=$("#profesion").val();
                tiporeferencia=$("#tiporeferencia").val();
                //alert(tiporeferencia);

                if ((nombrer!="") && (telefonor!="") && (profesion!="") )
                {
                    var filaR='<tr class="selected" id="filaR'+contss+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarR('+contss+');">X</button></td> <td>'+nombrer+'</td> <td>'+telefonor+'</td> <td>'+profesion+'</td> <td>'+tiporeferencia+'</td> </tr>';
                    contss++;
                    limpiar3();
                    $('#detalle3').append(filaR);
                }
                else
                {
                    alert('Si esta ingresando una referencia, todos los campos son obligatorios')
                }   
            }

            function eliminarR(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaR" + index).remove();
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
                

                if ((nombref!="") && (apellidof!="") && (edad!=""))
                {
                    if ( ($('#emergencia').is(':checked')) && (telefonof!=""))
                    {
                        var filaF='<tr class="selected" id="filaF'+contsss+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarF('+contsss+');">X</button></td> <td>'+nombref+'</td> <td>'+apellidof+'</td> <td>'+edad+'</td> <td>'+telefonof+'</td> <td>'+parentezco+'</td> <td>'+ocupacion+'</td> <td><input type="hidden" id="emergencia" name="emergencia[]" value="'+emergencia+'">'+emrg+'</td> </tr>';
                    contsss++;
                    limpiar4();
                    $('#detalle4').append(filaF);
                    }
                    else 
                    {
                        var filaF='<tr class="selected" id="filaF'+contsss+'"><td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarF('+contsss+');">X</button></td> <td>'+nombref+'</td> <td>'+apellidof+'</td> <td>'+edad+'</td> <td>'+telefonof+'</td> <td>'+parentezco+'</td> <td>'+ocupacion+'</td> <td><input type="hidden" id="emergencia" name="emergencia[]" value="No">'+emr+'</td> </tr>';
                    contsss++;
                    limpiar4();
                    $('#detalle4').append(filaF);
                    }
                }
                else
                {
                    alert('Existen campos obligatorios');
                }   
            }
            function eliminarF(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaF" + index).remove();
                }
            }

            function agregar5()
            {
                empresa=$("#empresa").val();
                puesto=$("#puesto5").val();
                jefeinmediato=$("#jefeinmediato").val();
                teljefeinmediato=$("#teljefeinmediato").val();
                motivoretiro=$("#motivoretiro").val();
                ultimosalario=$("#ultimosalario").val();
                fingresoex=$("#fingresoex").val();
                fsalidaex=$("#fsalidaex").val();

                if (empresa!="")
                {
                    var filaEl='<tr class="selected" id="filaEl'+contEx+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarEl('+contEx+');">X</button></td> <td>'+empresa+'</td> <td>'+puesto+'</td> <td>'+jefeinmediato+'</td> <td>'+teljefeinmediato+'</td> <td>'+motivoretiro+'</td> <td>'+ultimosalario+'</td> <td>'+fingresoex+'</td> <td>'+fsalidaex+'</td> </tr>';
                    contEx++;
                    limpiar5();
                    $('#detalle5').append(filaEl);
                }
                else
                {
                    alert('Si esta agregando un Experiencia Laboral, todos los campos son obligatorios');
                }   
            }
            function eliminarEl(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaEl" + index).remove();
                }
            }

            function agregar6()
            {
                titulo=$("#titulo").val();
                establecimiento=$("#establecimiento").val();
                duracion=$("#duracion").val();
                periodo=$("#priodo").val();
                idnivels=$("#idnivel").val();
                idniveltx=$("#idnivel option:selected").text();

                fingreso=$("#dato2").val();
                fsalida=$("#dato3").val();

                fingresoDT=("00/00/0000");
                fsalidaDT=("00/00/0000");

                idpaisPA=$("#idpaisPA").val();
                iddepartamento1=$("#iddepartamento1").val();
                pidmunicipio=$("#pidmunicipio").val();
                municipio=$("#pidmunicipio option:selected").text();
                munid=("");
                if ((titulo!="") && (establecimiento!="") && (duracion!=""))
                {
                    if (fingreso!="" && fsalida!="") 
                    {
                        if (idpaisPA !="73") 
                        {
                                var filaA='<tr class="selected" id="filaA'+contAc+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarA('+contAc+');">X</button></td> <td>'+titulo+'</td> <td>'+establecimiento+'</td> <td>'+duracion+'</td> <td>'+periodo+'</td> <td><input type="hidden" id="nivelid" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td>'+fingreso+'</td> <td>'+fsalida+'</td> <td><input type="hidden" id="pidmunicipio" name="pidmunicipio[]" value="'+munid+'"></td> <td><input type="hidden" id="idpaisPAAT" name="idpaisPAAT[]" value="'+idpaisPA+'"></td> </tr>';
                                contAc++;
                                limpiar6();
                                $('#detalle6').append(filaA);
                        }
                        else
                        {
                            if(iddepartamento1!="1")
                            {
                                var fila='<tr class="selected" id="filaA'+contAc+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarA('+contAc+');">X</button></td> <td>'+titulo+'</td> <td>'+establecimiento+'</td> <td>'+duracion+'</td> <td>'+periodo+'</td> <td><input type="hidden" id="nivelid" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td>'+fingreso+'</td> <td>'+fsalida+'</td> <td><input type="hidden" id="pidmunicipio" name="pidmunicipio[]" value="'+pidmunicipio+'">'+municipio+'</td> <td><input type="hidden" id="idpaisPAAT" name="idpaisPAAT[]" value="'+idpaisPA+'"></td> </tr>';
                                contAc++;
                                limpiar6();
                                $('#detalle6').append(fila);
                            }
                            else
                            {
                                alert('Debe seleccionar almenos un departamento')
                            }
                        }
                    }
                    else
                    {
                        if (idpaisPA !="73") 
                        {
                                var filaA='<tr class="selected" id="filaA'+contAc+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarA('+contAc+');">X</button></td> <td>'+titulo+'</td> <td>'+establecimiento+'</td> <td>'+duracion+'</td> <td>'+periodo+'</td> <td><input type="hidden" id="nivelid" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td>'+fingresoDT+'</td> <td>'+fsalidaDT+'</td> <td><input type="hidden" id="pidmunicipio" name="pidmunicipio[]" value="'+munid+'"></td> <td><input type="hidden" id="idpaisPAAT" name="idpaisPAAT[]" value="'+idpaisPA+'"></td> </tr>';
                                contAc++;
                                limpiar6();
                                $('#detalle6').append(filaA);
                        }
                        else
                        {
                            if(iddepartamento1!="1")
                            {
                                var filaA='<tr class="selected" id="filaA'+contAc+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarA('+contAc+');">X</button></td> <td>'+titulo+'</td> <td>'+establecimiento+'</td> <td>'+duracion+'</td> <td>'+periodo+'</td> <td><input type="hidden" id="nivelid" name="nivelid[]" value="'+idnivels+'">'+idniveltx+'</td> <td>'+fingresoDT+'</td> <td>'+fsalidaDT+'</td> <td><input type="hidden" id="pidmunicipio" name="pidmunicipio[]" value="'+pidmunicipio+'">'+municipio+'</td> <td><input type="hidden" id="idpaisPAAT" name="idpaisPAAT[]" value="'+idpaisPA+'"></td> </tr>';
                                contAc++;
                                limpiar6();
                                $('#detalle6').append(filaA);
                            }
                            else
                            {
                                alert('Debe seleccionar almenos un departamento')
                            }
                        }
                    }
                }
                else
                {
                    alert('Revise los datos obligatorios')
                }   
            }
            function eliminarA(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaA" + index).remove();
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
                    var filaI='<tr class="selected" id="filaI'+contId+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarI('+contId+');">X</button></td> <td><input type="hidden" id="eidioma" name="eidioma[]" value="'+idioma+'">'+idiomaTex+'</td> <td>'+niveli+'</td> </tr>';
                    contId++;
                    $('#detalle7').append(filaI);
                }

            }
            function eliminarI(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaI" + index).remove();
                }
            }
            function agregar8()
            {

                licencia=$("#licenciaid").val();
                licenciatex=$("#licenciaid option:selected").text();
                vigencia=$("#vigencia").val();
                if(vigencia!="")
                {
                    var filaL='<tr class="selected" id="filaL'+contL+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarL('+contL+');">X</button></td> <td><input type="hidden" id="licenciape" name="licenciape[]" value="'+licencia+'">'+licenciatex+'</td> <td>'+vigencia+'</td> </tr>';
                    contL++;
                    limpiar7();
                    $('#detalle8').append(filaL);
                }
                else
                {
                    alert('Campo vigencia obligatorio')
                }
            }
            function eliminarL(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaL" + index).remove();
                }
            }

            function agregarTE()
            {
                formate=$("#format").val();
                paisid=$("#idpaist").val();
                finmotivo=$("#motivofint").val();
                paistext=$("#idpaist option:selected").text();
                
                if ((formate!="") && (finmotivo!="") && (paisid!=""))
                {
                    
                                var filaTE ='<tr class="selected" id="filaTE'+contTE+'"> <td><button type="button" style="background-color:#E6E6E6"  class="btn" onclick="eliminarTE('+contTE+');">X</button></td>';
                                    filaTE +='<td>'+formate+'</td>'; 
                                    filaTE +='<td><input type="hidden" id="paisTe" name="paisTe[]" value="'+paisid+'">'+paistext+'</td>';
                                    filaTE +='<td>'+finmotivo+'</td> </tr>';
                                contTE++;
                                limpiarTE();
                                $('#detalleTE').append(filaTE);   
                }
                else
                {
                    alert('Revise los datos obligatorios')
                }   
            }
            function eliminarTE(index)
            {
                if (!confirm("ADVERTENCIA!! va a proceder a eliminar este registro, si desea eliminarlo de click en ACEPTAR\n de lo contrario de click en CANCELAR.")) 
                {
                    return false;
                }
                else 
                {
                    $("#filaTE" + index).remove();
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
