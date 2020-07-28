$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh(data) {
        if (data.length < 1){
            $.ajax({
                method: "POST",
                url: BASE_URL + "motor/ajax_default_list",
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
                    tableOverflow: true,
                    tableHeight: '400px',
                    colHeaders: [
                        '<br>Unit',
                        'Ampere',
                        'Bearing<br>Depan',
                        'Bearing<br>Belakang',
                        'Body',
                        'Kondisi<br>Fan',
                        'Seal<br>terminal',
                        'Kabel<br>Gland',
                    ],

                    colWidths: [300, 75, 75, 75, 75, 75, 100, 100, 100],
                    columns: [
                        { type: 'text', wordWrap: true, readOnly:true},
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'checkbox' },
                        { type: 'checkbox' },
                        { type: 'checkbox' },
                        // { type: 'text' },
                        // { type: 'text' },
                    ],
                    nestedHeaders: [
                        [   
                            {title: '',colspan: '1',},
                            {title: '',colspan: '1'},
                            {title: 'Temperature',colspan: '3'},
                            {title: 'Checklist',colspan: '3'},
                        ],
                    ],
                });
                $('#my-spreadsheet').jexcel('updateSettings', {
                    table: function (instance, cell, col, row, val, id) {
                        if (col >1 && col < 4){
                            if (val != 0 ){
                                if(val > MAX_TEMP_BEARING){
                                    $(cell).css('background-color', '#ff0000');
                                    $(cell).css('color', '#fff');
                                }else{
                                    $(cell).css('background-color', '#1aab68');
                                    $(cell).css('color', '#fff');
                                }
                            }
                        }else if (col == 4){
                            if (val != 0 ){
                                if(val > MAX_TEMP_MOTOR){
                                    $(cell).css('background-color', '#ff0000');
                                    $(cell).css('color', '#fff');
                                }else{
                                    $(cell).css('background-color', '#1aab68');
                                    $(cell).css('color', '#fff');
                                }
                            }
                        }
                        // else if (col > 4){
                        //     if (val == 0 ){
                        //         $(cell).css('background-color', '#ff0000');
                        //         $(cell).css('color', '#fff');
                        //     }else{
                        //         $(cell).css('background-color', '#1aab68');
                        //         $(cell).css('color', '#fff');
                        //     }
                        // }
                    }
                });
            });
        }else{
            $.ajax({
                method: "POST",
                url: BASE_URL + "motor/load",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    id_station: $("#station").val(),
                    periode: $("#periode").val(),
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
                    tableOverflow: true,
                    tableHeight: '400px',
                    colHeaders: [
                        '<br>Unit',
                        'Ampere',
                        'Bearing<br>Depan',
                        'Bearing<br>Belakang',
                        'Body',
                        'Kondisi<br>Fan',
                        'Seal<br>terminal',
                        'Kabel<br>Gland',
                    ],

                    colWidths: [300, 75, 75, 75, 75, 75, 100, 100, 100],
                    columns: [
                        { type: 'text', wordWrap: true, readOnly:true},
                        // { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'checkbox' },
                        { type: 'checkbox' },
                        { type: 'checkbox' },
                    ],
                    nestedHeaders: [
                        [   
                            {title: '',colspan: '1',},
                            {title: '',colspan: '1'},
                            {title: 'Temperature',colspan: '3'},
                            {title: 'Checklist',colspan: '3'},
                        ],
                    ],
                });

                $('#my-spreadsheet').jexcel('updateSettings', {
                    table: function (instance, cell, col, row, val, id) {
                        if (col >1 && col < 4){
                            if (val != 0 ){
                                if(val > MAX_TEMP_BEARING){
                                    $(cell).css('background-color', '#ff0000');
                                    $(cell).css('color', '#fff');
                                }else{
                                    $(cell).css('background-color', '#1aab68');
                                    $(cell).css('color', '#fff');
                                }
                            }
                        }else if (col == 4){
                            if (val != 0 ){
                                if(val > MAX_TEMP_MOTOR){
                                    $(cell).css('background-color', '#ff0000');
                                    $(cell).css('color', '#fff');
                                }else{
                                    $(cell).css('background-color', '#1aab68');
                                    $(cell).css('color', '#fff');
                                }
                            }
                        }
                        // else if (col>4){
                        //     if (val == 0 ){
                        //         $(cell).css('background-color', '#ff0000');
                        //         $(cell).css('color', '#fff');
                        //     }else{
                        //         $(cell).css('background-color', '#1aab68');
                        //         $(cell).css('color', '#fff');
                        //     }
                        // }
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
            url: BASE_URL+"motor/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                periode: $("#periode").val(),
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
            url: BASE_URL + "motor/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                periode: $("#periode").val(),
                tahun: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }


    function station_refresh() {
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
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

    $("#periode").change(function () {
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

    var tgl = new Date();
    var m = tgl.getMonth() + 1;
    if (m < 5) {
        $("#periode").val("1");
    } else if (m < 9) {
        $("#periode").val("2");
    } else {
        $("#periode").val("3");
    }

    station_refresh();

});
