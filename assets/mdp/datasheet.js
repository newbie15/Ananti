$(document).ready(function(){
    $.ajax({
        method: "POST",
        url: BASE_URL + "datasheet/list_datasheet/" + $("#pabrik").val(),
        data: {
            id_pabrik: $("#pabrik").val(),
        }
    }).done(function (msg) {
        x = [];
        y = [];
        data = JSON.parse(msg);

        for (i in data) {
            // console.log(data[i].daftar);
            // ct = "2";
            x.push(data[i]);
            y[i] = x;
            x = [];
        }
        var table = $('#d-datasheet').DataTable({
            destroy: true,
            data: y,
            columns: [{
                title: "Daftar Datasheet"
            }, ]
        });

        $('.dataTable tbody').on('click', 'tr', function () {
            if (table.row(this).data() != undefined) {
                console.log('API row values : ', table.row(this).data());
                var sp = table.row(this).data();
                // window.open(BASE_URL + 'assets/uploads/datasheet/' + sp, '_blank', 'fullscreen=yes');
                window.open(BASE_URL + 'datasheet/load/' + sp, '_blank', 'fullscreen=yes');
                // return false;
            }
        });
    });
});
