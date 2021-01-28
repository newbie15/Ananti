$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    handler = function (obj, cell, val) {
        console.log('My table id: ' + $(obj).prop('id'));
        console.log('Cell changed: ' + $(cell).prop('id'));
        console.log('Value: ' + val);

        cll = $(cell).prop('id');
        dd = cll.split("-");

        if(dd[0]=="3" || dd[0] == "4"){
            // roww = "H"+roww;
            var d = $("#my-M").jexcel('getRowData', dd[1]);
            console.log(d);
            // console.log("hello "+ val);
            var r1 = d[4]/d[3];
            if(!isNaN(r1)){
                $("#my-M").jexcel('setValue', "H" + dd[1] + 1, r1);
                if (r1 < 1) {
                    $("#my-M").jexcel('setValue', "J" + dd[1] + 1, "NOK");
                } else if (r1 < 2) {
                    if (d[4] > 2) {
                        $("#my-M").jexcel('setValue', "J" + dd[1] + 1, "OK");
                    } else {
                        $("#my-M").jexcel('setValue', "J" + dd[1] + 1, "warning");
                    }
                } else {
                    $("#my-M").jexcel('setValue', "J" + dd[1] + 1, "OK");
                }
            }else{
                $("#my-M").jexcel('setValue', "J" + dd[1] + 1, "");
                $("#my-M").jexcel('setValue', "H" + dd[1] + 1, "");
            }

        }

        if(dd[0]=="5" || dd[0] == "6"){
            // roww = "H"+roww;
            var d = $("#my-M").jexcel('getRowData', dd[1]);
            console.log(d);
            // console.log("hello "+ val);
            var r2 = d[6]/d[5];
            if(!isNaN(r2)){
                $("#my-M").jexcel('setValue', "I" + dd[1] + 1, r2);
                if (r2 < 1) {
                    $("#my-M").jexcel('setValue', "K" + dd[1] + 1, "NOK");
                } else if (r2 < 2) {
                    if (d[6] > 2) {
                        $("#my-M").jexcel('setValue', "K" + dd[1] + 1, "OK");
                    } else {
                        $("#my-M").jexcel('setValue', "K" + dd[1] + 1, "warning");
                    }
                } else {
                    $("#my-M").jexcel('setValue', "K" + dd[1] + 1, "OK");
                }
            }else{
                $("#my-M").jexcel('setValue', "K" + dd[1] + 1, "");
                $("#my-M").jexcel('setValue', "I" + dd[1] + 1, "");
            }
        }            

    };

    function refresh() {
        if (data == undefined) {
            data = [];
        }

        $('#my-M').jexcel({
            data: data,
            allowInsertColumn: false,
            onchange: handler,

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
            url: SITE_URL + "polarisasi/simpan",
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
            url: SITE_URL + "polarisasi/load",
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
