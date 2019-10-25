$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [
        ['Google', '#542727'],
        ['Yahoo', '#724f4f'],
        ['Bing', '#b43131'],
    ];

    unit =[
        ''
    ];

    $('#my-spreadsheet').jexcel({
        data: data,
        colHeaders: [
            'Station', 'Unit', 'Problem', 'Jenis<br>Problem','Tipe', 'Perbaikan', 'Tanggal<br>Mulai', 'Jam<br>Mulai', 'Tanggal<br>Selesai', 'Jam<br>Selesai','Keterangan'],
        colWidths: [100, 100, 250, 70, 60, 150, 100, 63, 100, 63, 100],
        columns: [
            { type: 'text' },
            { type: 'text' },
            { type: 'text', wordWrap: true },
            { type: 'dropdown', source: ['unit', 'line', 'pabrik'] },
            { type: 'dropdown', source: ['Alat', 'Proses'] },
            { type: 'text', wordWrap: true },
            { type: 'calendar', option: { format: 'DD/MM/YYYY HH24:MI', time: 1 } },
            // { type: 'number' , option: { format:'##:##:##' } },
            { type: 'text', mask: '##:##:##' },
            { type: 'calendar', option: { format: 'DD/MM/YYYY HH24:MI', time: 1 } },
            // { type: 'text' },
            { type: 'text', mask: '##:##:##' },
        ]
    });

    function refresh(xdata){
        $('#my-spreadsheet').jexcel({
            data: xdata,
            colHeaders: [
                'Station', 'Unit', 'Problem', 'Jenis<br>Problem', 'Tipe', 'Perbaikan', 'Tanggal<br>Mulai', 'Jam<br>Mulai', 'Tanggal<br>Selesai', 'Jam<br>Selesai', 'Keterangan'],
            colWidths: [100, 100, 250, 70, 60, 150, 100, 63, 100, 63, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text', wordWrap: true },
                { type: 'dropdown', source: ['unit', 'line', 'pabrik'] },
                { type: 'dropdown', source: ['Alat', 'Proses'] },
                { type: 'text', wordWrap: true },
                { type: 'calendar', option: { format: 'DD/MM/YYYY HH24:MI', time: 1 } },
                // { type: 'text' },
                { type: 'text', mask: '##:##:##' },
                { type: 'calendar', option: { format: 'DD/MM/YYYY HH24:MI', time: 1 } },
                { type: 'text', mask: '##:##:##' },
                // { type: 'text' },
            ]
        });        
    }

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "breakdown/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                bulan: $("#bulan").val(),
                tahun: $("#tahun").val(),
                tanggal: $("#tanggal").val(),
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

    $("#tanggal").change(function(){
        ajax_refresh();
    });

    $("#tahun").change(function () {
        ajax_refresh();
    });
    $("#bulan").change(function () {
        ajax_refresh();
    });

    $("#pabrik").change(function () {
        ajax_refresh();
    });

    $("#simpan").click(function () {
        var data = $('#my-spreadsheet').jexcel('getData');
        console.log(data);

        $.ajax({
            method: "POST",
            url: BASE_URL + "breakdown/simpan",
            success: sukses,
            data: {
                id_pabrik: $("#pabrik").val(),
                bulan: $("#bulan").val(),
                tahun: $("#tahun").val(),
                tanggal: $("#tanggal").val(),
                data_json: JSON.stringify(data),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    ajax_refresh();
});
