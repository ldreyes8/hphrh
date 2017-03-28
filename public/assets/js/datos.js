var cont=0;

$( document).ready(function() {
	$('#bt_add').click(function() {
		agregar();
	});

    


});

function limpiar()
{
    $("#ptitulo").val("");
    $("#establecimiento").val("");
    $("#duracion").val("");
    $("#nivel").val("");
    $("#dato2").val("");
	$("#dato3").val("");
}

function agregar()
{
	titulo=$("#ptitulo").val();
	//alert(titulo);
	estable=$("#establecimiento").val();
	duracion=$("#duracion").val();
	nivel=$("#nivel").val();
	fecha1=$("#dato2").val();
	fecha2=$("#dato3").val();
	//alert(fecha2);
	municipio=$("#pidmunicipio option:selected").text();
	if (titulo!="")
    {
        var fila='<tr class="selected" id="fila'+cont+'"><td><input type="hidden" name="titulo[]" value="'+titulo+'">'+titulo+'</td> <td><input type="hidden" name="estable[]" value="'+estable+'">'+estable+'</td> <td><input type="hidden" name="duracion[]" value="'+duracion+'">'+duracion+'</td> <td><input type="hidden" name="nivel[]" value="'+nivel+'">'+nivel+'</td> <td><input type="hidden" name="fecha1[]" value="'+fecha1+'">'+fecha1+'</td> <td><input type="hidden" name="fecha2[]" value="'+fecha2+'">'+fecha2+'</td> <td><input type="hidden" name="municipio[]" value="">'+municipio+'</td> </tr>';
        cont=cont+1;
        limpiar();
        $('#detalles').append(fila);
    }
    else
    {
        alert('Ingrese un titulo')
    }   
}