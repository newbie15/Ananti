$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh(data) {
        if (data.length < 1){
            $.ajax({
                method: "POST",
                url: SITE_URL + "megger/ajax_default_list",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    id_station: $("#station").val(),
                }
            }).done(function (msg) {
                console.log(msg);
                data = JSON.parse(msg);
                console.log(data);
                x = data;
                $('#my-spreadsheet').html("");
                $('#my-spreadsheet').jexcel({
                    data: data,
                    allowInsertColumn: false,

                    colHeaders: [
                        '<br>Unit',
                        'Kabel<br>R-S',
                        'Kabel<br>S-T',
                        'Kabel<br>T-R',
                        'Kabel<br>R-N',
                        'Kabel<br>S-N',
                        'Kabel<br>T-N',
                        'Motor<br>R-S',
                        'Motor<br>S-T',
                        'Motor<br>T-R',
                        'Motor<br>R-Body',
                        'Motor<br>S-Body',
                        'Motor<br>T-Body',
                    ],

                    colWidths: [300, 60, 60, 60, 60, 60, 60, 60, 60, 60, 60, 60, 60],
                    columns: [
                        { type: 'text', wordWrap: true, readOnly:true },
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
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                    ]
                });
                $('#my-spreadsheet').jexcel('updateSettings', {
                    table: function (instance, cell, col, row, val, id) {
                        if (col >0 && col < 4){
                            if (val != 0 ){
                                if(val < MIN_CABLE_MEGGER){
                                    $(cell).css('background-color', '#ff0000');
                                    $(cell).css('color', '#fff');
                                } else if (val < MED_CABLE_MEGGER) {
                                    $(cell).css('background-color', '#ffff00');
                                    $(cell).css('color', '#000');
                                } else if (val < SAFE_CABLE_MEGGER) {
                                    $(cell).css('background-color', '#1aab68');
                                    $(cell).css('color', '#fff');
                                }
                            }else{
                                $(cell).css('color', '#000');
                                $(cell).css('background-color', '#ffffff');
                            }
                        }else if (col > 6){
                            if (val != 0) {
                                if (val < MIN_MOTOR_MEGGER) {
                                    $(cell).css('background-color', '#ff0000');
                                    $(cell).css('color', '#fff');
                                } else if (val < MED_MOTOR_MEGGER) {
                                    $(cell).css('background-color', '#ffff00');
                                    $(cell).css('color', '#000');
                                } else if (val < SAFE_MOTOR_MEGGER) {
                                    $(cell).css('background-color', '#1aab68');
                                    $(cell).css('color', '#fff');
                                }
                            }else{
                                $(cell).css('color', '#000');
                                $(cell).css('background-color', '#ffffff');
                            }
                        }
                    }
                });
            });

        }else{
            $.ajax({
                method: "POST",
                url: SITE_URL + "megger/load",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    id_station: $("#station").val(),
                    // periode: $("#periode").val(),
                    tahun : $("#tahun").val(),
                }
            }).done(function (msg) {
                console.log(msg);
                data = JSON.parse(msg);
                console.log(data);
                $('#my-spreadsheet').html("");
                $('#my-spreadsheet').jexcel({
                    data: data,
                    allowInsertColumn: false,

                    colHeaders: [
                        '<br>Unit',
                        'Kabel<br>R-S',
                        'Kabel<br>S-T',
                        'Kabel<br>T-R',
                        'Kabel<br>R-N',
                        'Kabel<br>S-N',
                        'Kabel<br>T-N',
                        'Motor<br>R-S',
                        'Motor<br>S-T',
                        'Motor<br>T-R',
                        'Motor<br>R-Body',
                        'Motor<br>S-Body',
                        'Motor<br>T-Body',
                    ],

                    colWidths: [300, 60, 60, 60, 60, 60, 60, 60, 60, 60, 60, 60, 60],
                    columns: [
                        { type: 'text', wordWrap: true, readOnly:true },
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
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                    ]
                });
                $('#my-spreadsheet').jexcel('updateSettings', {
                    table: function (instance, cell, col, row, val, id) {
                        if (col >0 && col < 4){
                            if (val != 0 ){
                                if(val < MIN_CABLE_MEGGER){
                                    $(cell).css('background-color', '#ff0000');
                                    $(cell).css('color', '#fff');
                                } else if (val < MED_CABLE_MEGGER) {
                                    $(cell).css('background-color', '#ffff00');
                                    $(cell).css('color', '#000');
                                } else if (val < SAFE_CABLE_MEGGER) {
                                    $(cell).css('background-color', '#1aab68');
                                    $(cell).css('color', '#fff');
                                }
                            }else{
                                $(cell).css('color', '#000');
                                $(cell).css('background-color', '#ffffff');
                            }
                        }else if (col > 6){
                            if (val != 0) {
                                if (val < MIN_MOTOR_MEGGER) {
                                    $(cell).css('background-color', '#ff0000');
                                    $(cell).css('color', '#fff');
                                } else if (val < MED_MOTOR_MEGGER) {
                                    $(cell).css('background-color', '#ffff00');
                                    $(cell).css('color', '#000');
                                } else if (val < SAFE_MOTOR_MEGGER) {
                                    $(cell).css('background-color', '#1aab68');
                                    $(cell).css('color', '#fff');
                                }
                            }else{
                                $(cell).css('color', '#000');
                                $(cell).css('background-color', '#ffffff');
                            }
                        }
                    }
                });
            });

        }
    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"megger/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                tahun: $("#tahun").val(),

                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "megger/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                // periode: $("#periode").val(),
                tahun: $("#tahun").val(),
                // m: $("#bulan").val(),
                // y: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }


    function station_refresh() {
        $("#station").load(SITE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    ajax_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    $("#pabrik").change(function () {
        station_refresh();
    });

    $("#station").change(function () {
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
    // var tgl = new Date();
    // var m = tgl.getMonth() + 1;
    // if (m < 5) {
    //     $("#periode").val("1");
    // } else if (m < 9) {
    //     $("#periode").val("2");
    // } else {
    //     $("#periode").val("3");
    // }

    station_refresh();

});
