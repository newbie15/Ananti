$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    var type_screw = 0;
    var type_bunch = 0;
    var type_hydro = 0;
    var type_kcp = 0;


    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh(data) {
        // var x;
        // alert(data.length);
        if (data.length<1) {
            console.log("yes");
            $.ajax({
                method: "POST",
                url: BASE_URL + "sub_unit/hm_default_list",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    id_station: $("#station").val(),
                }
            }).done(function (msg) {
                console.log(msg);
                data = JSON.parse(msg);
                console.log(data);
                x = data;
                $('#my-spreadsheet').jexcel({
                    data: data,
                    allowInsertColumn: false,
                    colHeaders: [
                        'Unit',
                        'Sub Unit',
                        'Hour Meter',
                    ],
                    colWidths: [300, 360, 100, 95, 90, 50, 100, 60, 100, 100],
                    columns: [
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'numeric', wordWrap: true },
                    ],
                });

            });

        }else{
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                colHeaders: [
                    'Unit',
                    'Sub Unit',
                    'Hour Meter',
                ],
                colWidths: [300, 360, 100, 95, 90, 50, 100, 60, 100, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'numeric', wordWrap: true },
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
            url: BASE_URL+"recordhm/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),

                // screwpress : type_screw,
                // bunchpress : type_bunch,
                // hydrocyclone : type_hydro,
                // kcp: type_kcp,

            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function station_refresh(){
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function(responseTxt,statusTxt,xhr){
                if(statusTxt == "success"){
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
            url: BASE_URL + "recordhm/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
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

        // $.ajax({
        //     method: "POST",
        //     url: BASE_URL + "recordhm/load_type_monitoring",
        //     data: {
        //         id_pabrik: $("#pabrik").val(),
        //         id_station: $("#station").val(),
        //     }
        // }).done(function (msg) {
        //     // console.log(msg);
        //     data = JSON.parse(msg);
        //     // console.log(data);
        //     // console.log(data.screwpress);

        //     if(data.screwpress == 1){
        //         type_screw = 1;
        //     }else{
        //         type_screw = 0;
        //     }

        //     if (data.bunchpress == 1) {
        //         type_bunch = 1;
        //     } else {
        //         type_bunch = 0;
        //     }

        //     if (data.hydrocyclone == 1) {
        //         type_hydro = 1;
        //     } else {
        //         type_hydro = 0;
        //     }

        //     if (data.kcp == 1) {
        //         type_kcp = 1;
        //         // alert("kcp");
        //     } else {
        //         type_kcp = 0;
        //     }
        //     // refresh(data);
        // });
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

});
