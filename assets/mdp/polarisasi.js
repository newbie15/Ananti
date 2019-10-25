$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh() {
        if (data == undefined) {
            data = [];
        }

        $('#my-M').jexcel({
            data: data,
            allowInsertColumn: false,

            colHeaders: [
                '<br>Tanggal',
                'Nama Unit<br>Turbin / Genset',
                '<br>Fase',
                '0<br>detik',
                '30<br>detik',
                '1<br>menit',
                '10<br>menit',
                'Rasio<br>IP 1',
                'Rasio<br>IP 2',
                'Hasil<br>IP 1',
                'Hasil<br>IP 2',
            ],

            colWidths: [100, 200, 50, 50, 50, 50, 50, 50, 50, 50],
            columns: [
                { type: 'calendar', options: { format: 'DD/MM/YYYY' } },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ]
        });
    }

    $("#pabrik").change(function () {
        ajax_refresh();
    });
    $("#tahun").change(function () {
        var syear = parseInt($("#tahun").val());
        var shtml = null; //"<option>"++"</option>"
        var start_year = syear - 2;
        var stop_year = syear + 2;
        for (var i = start_year; i <= stop_year; i++) {
            shtml += "<option>" + i + "</option>";
        }
        $("#tahun").html(shtml);
        $("#tahun").val(syear.toString());

        ajax_refresh();
    });

    var tgl = new Date();
    var y = tgl.getFullYear();

    var shtml = null; //"<option>"++"</option>"
    var start_year = y - 2;
    var stop_year = y + 2;
    for (var i = start_year; i <= stop_year; i++) {
        shtml += "<option>" + i + "</option>";
    }
    $("#tahun").html(shtml);

    $("#tahun").val(y.toString());

    // $("#tahun").change(function () {
    //     ajax_refresh();
    // });

    // var tgl = new Date();
    // var y = tgl.getFullYear();
    // $("#tahun").val(y.toString());


    $("#simpan").click(function () {
        var data = $('#my-M').jexcel('getData');
        console.log(data);

        $.ajax({
            method: "POST",
            url: BASE_URL + "polarisasi/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                tahun: $("#tahun").val(),
                data_json: JSON.stringify(data),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "polarisasi/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                tahun: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }

    ajax_refresh();

});
