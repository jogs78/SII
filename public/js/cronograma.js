
//var url = "http://energia.ittg.mx/colaboradores/";
var url = "/cronograma";
//    <!--   id, actividad, fecha_inicio, fecha_fin, monto, proyecto_id, entregables_id  -->

function agregar(){
        if ($('#actividad').val()==""){
            alert('No especifico actividad');
            return;
        }
        if ($('#fecha_inicio').val()==""){
            alert('No especifico fecha de inicio'); 
            return;
        }

        if ($('#fecha_fin').val()==""){
            alert('No especifico fecha de fin'); 
            return;
        }             


    var formData = {
        actividad: $('#actividad').val(), 
        fecha_inicio: $('#fecha_inicio').val(), 
        fecha_fin: $('#fecha_fin').val(), 
        proyecto_id: $('#proyecto_id').val(), 
        entregables_id: $('#entregables_id').val(),
    }
    console.log('formData:', formData);
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
                        $('#frmactiviades').trigger("reset");
                        console.log("regreso en agregar:",data);
//# ACTIVIDAD   PERIODO MONTO   ENTREGABLE  ELIMINAR
                        // if (data.participacion == null ) 
                        //     data.participacion = "Aún no acepta";
                        // else 
                        //     data.participacion = "Acepto";
                        var linea = '<tr id="actividad_' + data.id + '"><td>' + data.actividad + '</td><td>' + data.fecha_inicio + ' a '   + data.fecha_inicio + '</td>';
                        linea += '<td>' + data.entregable +'</td>';
                        linea += '<td><button class="btn btn-danger btndel" value="' + data.id + '">Eliminar</button></td></tr>';

                        var columnas = $('#actividades-list > tbody > tr > td').prop( "colspan");
                        if (columnas==4){
                        $('#actividades-list > tbody').empty();
                        }
                        $('#actividades-list > tbody').append(linea);
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

function eliminar(){
    var formData = {
        actividad_id: this.value,
    }

    console.log(formData);
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url + "/eliminar" ,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            console.log("regreso en eliminar:", data);
            $("#actividad_" + data.id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

