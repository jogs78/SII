
//var url = "http://energia.ittg.mx/colaboradores/";
var url = "/colaboradores";
function aceptar(){
    var formData = {
        colaboracion: this.value,
    }
    var h = "X-CSRF-TOKEN";
    console.log(formData);
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url + "/aceptar" ,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            console.log("regreso en aceptar:", data);
            javascript:location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

function rechaza(){
    var formData = {
        colaboracion: this.value,
    }
    var h = "X-CSRF-TOKEN";
    console.log(formData);
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url + "/rechazar" ,
        data: formData,
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')  },
        success: function (data) {
            console.log("regreso en rechazar:" , data);
            javascript:location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        },
        async:true
    });
}

