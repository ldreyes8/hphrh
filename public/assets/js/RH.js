$(document).ready(function(){
    $(document).on('click','.btn-vacaciones',function(){
        var errHTML="";
        idempleado=$(this).val();
        $.get('empleados/calculardias/'+idempleado,function(data){
           
            var horas = '';
            var dias = '';
            var tdh;

            $.each(data,function(){
                horas = data[0];
                dias = data[1];
                autorizacion = data[2];
            })

            $('#inputTitle').html("Saldo de vacaciones");
            $('#formAgregar').trigger("reset");
            $('#formModal').modal('show');
            $('#datomar').attr('disabled', 'disabled');
            $('#hhoras').attr('disabled', 'disabled');
            $('#dacumulado').attr('disabled', 'disabled');
            $('#btnguardarV').attr('disabled', 'disabled'); 

            tdh = (dias + ' ' + 'dias' + ' ' + 'con' +' '+ horas +' '+ 'horas');
            document.getElementById('dacumulado').value = tdh;
            document.getElementById('tdias').value = dias;
            document.getElementById('thoras').value = horas;
            
        });
    });
});
