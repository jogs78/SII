
var url = "/colaboradores";

function agregar(){
    var formData = {
        users_id: $('#investigador').val(),
        proyecto_id: $('#noproyecto').val(),
    }
    var producto_id = $('#producto_id').val();;
    console.log(formData);
    console.log(url);

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            if(data.error)
                alert(data.mensaje);
            else{
                console.log("regreso en agregar:");     
                console.log(data);
                if (data.Colaborador.participacion == null ) 
                    data.Colaborador.participacion = "Aún no acepta";
                else 
                    data.Colaborador.participacion = "Acepto";
                if (data.Colaborador.cvutecnm == null) data.Colaborador.cvutecnm="";
                var row = '<tr id="colaborador_' + data.Colaborador.users_id + '">';
                row += '<td>' + data.Colaborador.cvutecnm + '</td><td>';
                row +=  data.Colaborador.name + '</td><td>';
                row +=  data.Colaborador.participacion + '</td>';
                row += '<td><button class="btn btn-danger btndel" value="' + data.Colaborador.users_id + '">Eliminar</button></td></tr>';
                $('#colaboradores-list > tbody').append(row);
                $('#investigador option[value=\"' + data.Colaborador.users_id  +  '\"]' ).remove();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

function desinvitar(){
    var formData = {
        users_id: this.value,
        proyecto_id: $('#noproyecto').val(),
    }
    console.log(formData);
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url + "/desinvitar" ,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            console.log("regreso en eliminar:");
            console.log(data);
            if(data.error)
                alert(data.mensaje);
            else{
                $("#colaborador_" + data.Colaborador).remove();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

