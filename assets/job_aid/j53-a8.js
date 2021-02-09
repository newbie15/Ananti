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
        console.log("refresh data");
        console.log(data);
        if (data.length<1) {
            console.log("yes kurang dari 1");
            $.ajax({
                method: "POST",
                url: SITE_URL + "unit/ajax_default_list",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    id_station: $("#station").val(),
                }
            }).done(function (msg) {
                console.log("ini refresh");

                console.log(msg);
                data = JSON.parse(msg);
                console.log(data);
                x = data;
                $('#my-spreadsheet').html("");
                $('#my-spreadsheet').jexcel({
                    data: data,
                    allowInsertColumn: false,
                    colHeaders: [
                        'Nametag<br>Breaker',
                        'Nametag<br>Panel',
                        'Tegangan<br>Nominal',
                        'Humidity<br>(RH)',
                        'Temp<br>(C)',
                        'R-S',
                        'S-T',
                        'T-R',
                        'R-E',
                        'S-E',
                        'T-E',
                        'STD<br>Aman',
                        'Status',
                    ],
                    colWidths: [300, 100, 100, 75, 75, 60, 60, 60, 60, 60, 60, 60, 100],
                    columns: [
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'dropdown', source: ["<=250","251-1K","1K-2.5K","2.5K-5K","5K-8K","8K-15K","15K-25K","25K-34.5K",">34.5K"] },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },

                    ],
                });

                $('#my-spreadsheet2').html("");
                $('#my-spreadsheet2').jexcel({
                    data: data,
                    allowInsertColumn: false,
                    colHeaders: [
                        'Nametag<br>Breaker',
                        'Nametag<br>Panel',
                        'Tegangan<br>Nominal',
                        'Humidity<br>(RH)',
                        'Temp<br>(C)',
                        'R-S',
                        'S-T',
                        'T-R',
                        'R-E',
                        'S-E',
                        'T-E',
                        'STD<br>Aman',
                        'Status',
                    ],
                    colWidths: [300, 100, 100, 75, 75, 60, 60, 60, 60, 60, 60, 60, 100],
                    columns: [
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'dropdown', source: ["<=250","251-1K","1K-2.5K","2.5K-5K","5K-8K","8K-15K","15K-25K","25K-34.5K",">34.5K"] },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },

                    ],
                });

                $('#my-spreadsheet3').html("");
                $('#my-spreadsheet3').jexcel({
                    data: data,
                    allowInsertColumn: false,
                    colHeaders: [
                        'Nametag<br>Breaker',
                        'Nametag<br>Panel',
                        'Tegangan<br>Nominal',
                        'Humidity<br>(RH)',
                        'Temp<br>(C)',
                        'R-S',
                        'S-T',
                        'T-R',
                        'R-E',
                        'S-E',
                        'T-E',
                        'STD<br>Aman',
                        'Status',
                    ],
                    colWidths: [300, 100, 100, 75, 75, 60, 60, 60, 60, 60, 60, 60, 100],
                    columns: [
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'dropdown', source: ["<=250","251-1K","1K-2.5K","2.5K-5K","5K-8K","8K-15K","15K-25K","25K-34.5K",">34.5K"] },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },

                    ],
                });                

            });
        }else{
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                colHeaders: [
                    'Tipe Peralatan<br>Tagname',
                    'ID',
                    'Tegangan<br>Nominal',
                    'Humidity<br>(RH)',
                    'Temp<br>(C)',
                    'R-S',
                    'S-T',
                    'T-R',
                    'R-E',
                    'S-E',
                    'T-E',
                    'STD<br>Aman',
                    'Status',
                ],
                colWidths: [300, 100, 100, 75, 75, 60, 60, 60, 60, 60, 60, 60, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'dropdown', source: ["<=250","251-1K","1K-2.5K","2.5K-5K","5K-8K","8K-15K","15K-25K","25K-34.5K",">34.5K"] },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        }
    }

    $("#pabrik").change(function () {
        station_refresh();
    });
    $("#station").change(function () {
        ajax_refresh();
    });
    // $("#tahun").change(function () {
    //     ajax_refresh();
    // });
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
            url: SITE_URL+"acm/simpan",
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

    function station_refresh(){
        $("#station").load(SITE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function(responseTxt,statusTxt,xhr){
                if(statusTxt == "success"){
                    // alert("success");
                    ajax_refresh();
                }else{
                    // alert("gaagal");
                }
            }
        );
    }

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "acm/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log("ini ajax refresh");
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }
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

    var tgl = new Date();
    var m = tgl.getMonth() + 1;
    if (m < 10) {
        $("#bulan").val("0" + m.toString());
    } else {
        $("#bulan").val(m.toString());
    }
    // var y = tgl.getFullYear();
    // $("#tahun").val(y.toString());
    var d = tgl.getDate();
    if (d < 10) {
        $("#tanggal").val("0" + d.toString());
    } else {
        $("#tanggal").val(d.toString());
    }

    station_refresh();
    ajax_refresh();
    // ajax_refresh();

});
