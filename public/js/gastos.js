
var url = "/gastos";
 
function agregar(){
             
//id, descripcion, partida, monto, cronograma_id, proyecto_id

    var formData = {
        descripcion: $('#descripcion').val(), 
        partida: $('#partida').val(), 
        monto: $('#monto').val(), 
        cronograma_id: $('#cronograma_id').val(),
        proyecto_id: $('#proyecto_id').val(), 
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
            // linea: partida, descripcion, monto, eliminar
             var linea = '<tr id="gasto_' + data.id + '"><td>' + data.partida + '</td><td>' + data.descripcion + '</td><td>' + data.monto + '</td>';
             linea += '<td><button class="btn btn-danger btndel" value="' + data.id  + '">Eliminar</button></td></tr>';
             $('#gastos-list_actividad_' + data.cronograma_id + " > tbody").append(linea);
//            $('#gastosModal').trigger("reset");
                alert("Tu presupuesto es de : " + data.total[0].monto);
            $('#gastosModal').modal('hide');
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

function eliminar(){
    tablaactiviades = this.parentNode.parentNode.parentNode.parentNode.id; //gasto_3
    activiad = tablaactiviades.substr(22,1);

    var formData = {
        gasto_id: this.value,
        actividad_id: activiad

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
//            $('#gastos-list_actividad_' + data.cronograma_id)
quitar = "#gasto_" + data.id;
console.log ("QUITAR: ", quitar);
            $("#gasto_" + data.id ).remove();
            alert("Tu presupuesto es de : " + data.total[0].monto);

        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

