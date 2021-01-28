$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];

    function refresh(data){
        if (data == undefined) {
            data = [];
        }
        $('#my-spreadsheet').jexcel({
            data: data,
            allowInsertColumn: false,
            colHeaders: [
                'Station', 'Unit', 'Kondisi', 'Status', 'Identifikasi<br>Problem', 'Perbaikan<br>Yang Diperlukan', 'PIC', 'Status<br>Sparepart', 'Keterangan'],
            colWidths: [100, 100, 250, 70, 200, 250, 80, 100, 100, 100],
            columns: [
                { type: 'autocomplete', url: SITE_URL + 'station/ajax/' + $("#pabrik").val() },
                { type: 'autocomplete', url: SITE_URL + 'unit/ajax/' + $("#pabrik").val() },
                { type: 'text', wordWrap: true },
                { type: 'dropdown', source: ['Hijau', 'Kuning', 'Merah'] },
                { type: 'text', wordWrap: true },
                { type: 'text' },
                { type: 'dropdown', source: ['Internal', 'WSC', 'External'] },
                { type: 'dropdown', source: ['Ready', 'Order', 'Progress Order'] },
                { type: 'text' },
            ]
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
            url: SITE_URL + "lkpmp/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                bulan: $("#bulan").val(),
                tahun: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

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

    // refresh();
    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "lkpmp/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                bulan: $("#bulan").val(),
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
