$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh(data) {
        console.log(data);
        $('#my-spreadsheet').jexcel({
            data: data,
            allowInsertColumn: false,
            allowInsertRow: false,
            colHeaders: [
                'PK RM',
                'PO RM',
                'PK Olah',
                'PO Olah',
            ],
            colWidths: [100, 100, 100, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ],
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
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"cost/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "cost/load",
            data: {
                id_pabrik: $("#pabrik").val(),
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

    // station_refresh();
    ajax_refresh();

});
