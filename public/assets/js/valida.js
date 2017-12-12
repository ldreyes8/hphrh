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
            function anular(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                return (tecla != 13);
            }
            
            function anularEspacios(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                return (tecla == 8);
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

            function validadecimal(e,field) {
                // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
                
                key = e.keyCode ? e.keyCode : e.which;
 
                if (key == 8) return true;
                if (key > 47 && key < 58) {
                    if (field.value === "") return true;
                    var existePto = (/[.]/).test(field.value);
                    if (existePto === false){
                        regexp = /.[0-9]{10}$/;
                    }
                    else {
                        regexp = /.[0-9]{2}$/;
                    }
                    return !(regexp.test(field.value));
                }
                if (key == 46) {
                    if (field.value === "") return false;
                    regexp = /^[0-9]+$/;
                    return regexp.test(field.value);
                }
                return false;
            };



