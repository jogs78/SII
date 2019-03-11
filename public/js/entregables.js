
//var url = "http://energia.ittg.mx/colaboradores/";
var url = "/entregables";

function marcar(){      
      var e = $("#descripcion");
      var lista = e[0].list.options;
      var texto = e.val();
      $.each( lista, function( key, value ) {            
        if ( texto == value.value ){
          var tipo = value.attributes["data-value"].value; 
          $("#tipo_" + tipo).prop( "checked", true );
        }
      });     
    }

function agregar(){
    var formData = {
//        users_id: $('#investigador').val(),
        tipo:  $("input[name='tipo']:checked").val(),
        cuantos:  $('#cuantos').val(),
        descripcion:  $('#descripcion').val(),
        proyecto_id: $('#noproyecto').val(),
    }

    console.log(formData);
    console.log(url);

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
                        $('#frmentregables').trigger("reset");
                        console.log("regreso en agregar:",data);
                        if(data.error ) {alert(data.error); return;}
            // if (data.participacion == null ) 
            //     data.participacion = "Aún no acepta";
            // else 
            //     data.participacion = "Acepto";
             var linea = '<tr id="entregable_' + data.id + '"><td>' + data.tipo + '</td><td>' + data.cuantos + '</td><td>' + data.descripcion + '</td>';
             linea += '<td><button class="btn btn-danger btndel" value="' + data.id + '">Eliminar</button></td></tr>';
             $('#entregables-list > tbody').append(linea);
        //    $('#frmcolaboradores').trigger("reset");
        //    $('#colaboradoresModal').modal('hide');
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

function eliminar(){
    var formData = {
        entregable_id: this.value,
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
            $("#entregable_" + data.id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

