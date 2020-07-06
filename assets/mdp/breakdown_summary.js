$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];

    unit =[
        ''
    ];

    function refresh(xdata){
        $('#my-spreadsheet').jexcel({
            data: xdata,
            tableOverflow: true,
            tableHeight: '450px',
            tableWidth: '500px',
            colHeaders: [
                'Tanggal','Area','Problem', 'Jenis<br>Problem', 'Tipe', 'waktu<br>(menit)'],
            colWidths: [80, 150, 250, 80, 170, 50, 100, 63, 100, 63, 100],
            columns: [
                { type: 'text', readOnly:true },
                { type: 'text', wordWrap: true },
                { type: 'text', readOnly:true },
                { type: 'dropdown', source: ['unit', 'line', 'total'] },
                { type: 'dropdown', source: ['Operation Pogen','Operation Non Pogen', 'Maintenance Pogen', 'Maintenance Non Pogen'] },
                { type: 'text', wordWrap: true },
                { type: 'text', wordWrap: true },
            ]
        });        
    }

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "breakdown/load_summary",
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
    var y = tgl.getFullYear();

    var shtml = null; //"<option>"++"</option>"
    var start_year = y - 2;
    var stop_year = y + 2;
    for (var i = start_year; i <= stop_year; i++) {
        shtml += "<option>" + i + "</option>";
    }
    $("#tahun").html(shtml);
    $("#tahun").val(y.toString());

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

    $("#bulan").change(function () {
        ajax_refresh();
    });

    $("#pabrik").change(function () {
        ajax_refresh();
        // station_refresh();
    });

    ajax_refresh();
});
