$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];

    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh() {
        if (data == undefined) {
            data = [];
        }

        $('#my-M').jexcel({
            data: data,
            colHeaders: [
                'Jam Breakdown', 'Persentase<br>Breakdown'],
            colWidths: [200, 200, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 200],
            columns: [
                // { type: 'autocomplete', source: ['loading ramp', 'sterilizer', 'thresher', 'press', 'bunch press', 'kernel', 'klarifikasi', 'boiler', 'effluent', 'dispatch'] },
                { type: 'text' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'text', wordWrap: true },
            ],
            // onchange: handler,
            allowInsertColumn: false,
        });
    }

    $("#pabrik").change(function () {
        ajax_refresh();
    });
    $("#tahun").change(function () {
        ajax_refresh();
    });
    $("#bulan").change(function () {
        ajax_refresh();
    });
    $("#tanggal").change(function () {
        ajax_refresh();
    });

    $("#simpan").click(function () {
        var data_m = $('#my-M').jexcel('getData');

        $.ajax({
            method: "POST",
            url: BASE_URL+"feedback_maintenance/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_maintenance: JSON.stringify(data_m),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "feedback_maintenance/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                // id_station: $("#station").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }

    var tgl = new Date();
    var m = tgl.getMonth() + 1;
    if (m < 10) {
        $("#bulan").val("0" + m.toString());
    } else {
        $("#bulan").val(m.toString());
    }
    var y = tgl.getFullYear();
    $("#tahun").val(y.toString());
    var d = tgl.getDate();
    if (d < 10) {
        $("#tanggal").val("0" + d.toString());
    } else {
        $("#tanggal").val(d.toString());
    }

    ajax_refresh();

});
