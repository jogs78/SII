
var url = "/aval";
 
function agregar(){
    var archivo = $('#archivo');
    var noproy = $('#proyecto_id').val();

    var formData = new FormData();
    formData.append('evidencia', archivo[0].files[0]);
    formData.append('proyecto_id', noproy);
    console.log('formData:', formData);
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: "json",        
        cache: false,
        contentType: false,
        processData: false,        
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            if(data.error)
                alert(data.mensaje);
            else{        
                alert("Carta de aval subida correctamente");
                console.log("regreso en agregar:",data);
                epdf = $('#pdf');
                $('#pdf').attr('src', data.fileName);
                javascript:location.reload();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    }).fail(function () {
        alert('No fue posible cargar la carta de aval.');
    });

}

function eliminar( id ){

    var formData = {
        proyecto_id: id,
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
            if (data.realizado){
                alert("Carta de aval eliminada");
                $('#pdf').attr('src', 'evidencias/balnco.pdf');
                javascript:location.reload();
            }
            else alert("No se pudo eliminar la carta de aval.")
            
            // $('#gastos-list_actividad_' + data.cronograma_id)
            // quitar = "#gasto_" + data.id;
            // console.log ("QUITAR: ", quitar);
            // $("#gasto_" + data.id ).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    }).fail(function () {
        alert('No fue posible eliminar la carta de vinculación.');
    });
}

