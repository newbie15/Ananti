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

    function station_refresh() {
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    unit_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function unit_refresh() {
        $("#unit").load(BASE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    sub_unit_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function sub_unit_refresh() {
        $("#sub_unit").load(BASE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()) + "/" + encodeURI($("#unit").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    // ajax_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }



    $('#my-spreadsheet').jexcel({
        data: data,
        colHeaders: [
            'Station', 'Unit', 'Problem', 'Jenis<br>Problem','Tipe', 'Perbaikan', 'Tanggal<br>Mulai', 'Jam<br>Mulai', 'Tanggal<br>Selesai', 'Jam<br>Selesai','Keterangan'],
        colWidths: [100, 100, 250, 70, 60, 150, 100, 63, 100, 63, 100],
        columns: [
            { type: 'text' , readOnly:true },
            { type: 'text' , readOnly:true },
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
            tableOverflow: true,
            tableHeight: '450px',
            tableWidth: '500px',
            colHeaders: [
                'Station', 'Unit', 'Sub Unit','Problem', 'Jenis<br>Problem', 'Tipe', 'Perbaikan', 'Tanggal<br>Mulai', 'Jam<br>Mulai', 'Tanggal<br>Selesai', 'Jam<br>Selesai', 'Keterangan'],
            colWidths: [100, 100, 100, 250, 70, 60, 150, 100, 63, 100, 63, 100],
            columns: [
                { type: 'text', readOnly:true },
                { type: 'text', readOnly:true },
                { type: 'text', readOnly:true },
                { type: 'text', wordWrap: true },
                { type: 'dropdown', source: ['unit', 'line', 'total'] },
                { type: 'dropdown', source: ['Operation Pogen','Operation Non Pogen', 'Maintenance Pogen', 'Maintenance Non Pogen'] },
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
    
    $("#station").change(function () {
        unit_refresh();
    });

    $("#unit").change(function () {
        sub_unit_refresh();
    });

    function add(sx,ux,su) {
        var sama = 0;
        var index = 0;
        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        // dx.forEach(element => {
        //     if (no == element[0]) {
        //         sama = 1;
        //     }
        //     index++;
        // });
        // $("#wo").val("");
        // if (sama == 0) {
        //     if (dx.length == 1) {
                if (dx[0][0] == "") { // kosong
                    dx[0][0] = sx;
                    dx[0][1] = ux;
                    dx[0][2] = su;
                } else { // isi satu
                    dx.push([sx, ux, su, "", "", "", "", "", "", "", "", ""]);
                }
        //     } else { // isi lebih dari 1
        //         dx.push([sx, ux, "", "", "", "", "", "", "", "", ""]);
        //     }
        //     refresh(dx);
        // }
        
        // dx.push([sx, ux, "", "", "", "", "", "", "", "", ""]);
        refresh(dx);

        // $("#wo").val("");
        $("#modal-default").modal("hide");
    }

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
    
    $("#tambah").click(function(){
        station_refresh();
    });

    $("#tplus").click(function () {
        add($("#station").val(), $("#unit").val(), $("#sub_unit").val());
    });



});
