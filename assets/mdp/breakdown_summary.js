$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];

    unit =[
        ''
    ];

    var area,t_history,t_spread;

    // selection = function (obj, cell, val) {
    //     var pos = $(cell).prop('id');//.split("-");

    //     console.log('Cell select: ' + $(cell).prop('id'));
    //     var value = pos[1];
    //     // var data = $("#my-spreadsheet").jexcel('getRowData', value);
    //     var data = t_spread.jexcel('getRowData', value);
    //     console.log(data);
    //     if (data[0] != "") {
    //         $("#history").show();
    //         area = data[1];
    //         // history_refresh(area);
    //         console.log(area);
    //     } else {
    //         console.log("kosong");
    //         $("#history").hide();
    //     }
    // }

    var selection = function (instance, x1, y1, x2, y2, origin) {
		// console.log('x1 ' + x1 + ' x2 ' + x2 + '    ');
		var dtx = t_spread.getRowData(y1);
        console.log(dtx[1]);
        if (dtx[1] != "") {
            $("#history").show();
            var area = dtx[1];
            history_refresh(area);
            area = area.replace("\n", " - ").replace("\n", " - ");
            $("#ar").html(area);
            console.log(area);
        } else {
            console.log("kosong");
            $("#history").hide();
        }
        
    }

    function history_refresh(ar){
        var x = ar.split("\n");
        var x_id_pabrik = $("#pabrik").val();
        var x_station = x[0];
        var x_unit = x[1];
        var x_sub_unit = x[2];

        $("#my-history").html("");
        t_history = jexcel(document.getElementById('my-history'), {
            csv: BASE_URL + 'index.php/historical/mini_history_csv/' + x_id_pabrik + "/" + encodeURI(x_station) + "/" + encodeURI(x_unit) + "/" + encodeURI(x_sub_unit),
            csvHeaders: true,
            search: true,
            pagination: 10,
            columns: [
                { type: 'text', width: 150 },
                { type: 'text', width: 175, wordWrap: true},
                { type: 'text', width: 175, wordWrap: true },
            ]
        }); 
    }

    function refresh(xdata){
        // $('#my-spreadsheet').jexcel({
        $("#my-spreadsheet").html("");
        t_spread = jexcel(document.getElementById('my-spreadsheet'), {
            data: xdata,
            // tableOverflow: true,
            tableHeight: '450px',
            // tableWidth: '500px',
            colHeaders: [
                'Tanggal','Area','Problem', "Jenis<br>Problem", 'Tipe', "waktu<br>(menit)"],
            colWidths: [80, 150, 250, 80, 170, 50, 100, 63, 100, 63, 100],
            columns: [
                { type: 'text', readOnly:true },
                { type: 'text', wordWrap: true },
                { type: 'text', readOnly:true },
                { type: 'dropdown', source: ['unit', 'line', 'total'] },
                { type: 'dropdown', source: ['Operation Pogen','Operation Non Pogen', 'Maintenance Pogen', 'Maintenance Non Pogen'] },
                { type: 'text', wordWrap: true },
                // { type: 'text', wordWrap: true },
            ],
            onselection: selection,
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
