
var url = "/proyecto";
 
function agregar(){
    var formData = new FormData(document.getElementById("frmproyecto"));
    console.log('formData:', formData);
    $.ajax({
        type: 'POST',
        url: "/proyecto",
        data: formData,
        dataType: "json",        
        cache: false,
        contentType: false,
        processData: false,        
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            console.log("regreso al agregar:",data);
            $('#sucedio').removeClass()
            $('#sucedio').text(data.mensaje);
            $('#sucedio').addClass(data.status);
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    }).fail(function () {
        alert('No fue posible agregar el proyecto.');
    });
}

function especial(){
    var formData = new FormData(document.getElementById("frmproyecto"));
    console.log('formData:', formData);
    $.ajax({
        type: 'POST',
        url: "/proyectoespecial",
        data: formData,
        dataType: "json",        
        cache: false,
        contentType: false,
        processData: false,        
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            console.log("regreso al agregar:",data);
            $('#sucedio').removeClass()
            $('#sucedio').text("Proyeto con título: '" + data.titulo + "' fue agregado.");
            $('#sucedio').addClass("alert-warning");
//            alert("Regreso");
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    }).fail(function () {
        alert('No fue posible agregar el proyecto.');
    });
}

function actualizar(){
    var formData = new FormData(document.getElementById("frmproyecto"));
    console.log('formData:', formData);
    $.ajax({
        type: 'POST',
        url: "/proyectoa",
        data: formData,
        dataType: "json",        
        cache: false,
        contentType: false,
        processData: false,        
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            console.log("regreso al agregar:",data);
            $('#sucedio').removeClass()
            $('#sucedio').text(data.mensaje);
            $('#sucedio').addClass(data.status);
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    }).fail(function () {
        alert('No fue posible agregar el proyecto.');
    });
}

