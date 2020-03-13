$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    // handler = function (obj, cell, val) {
    //     cll = $(cell).prop('id');
    //     dd = cll.split("-");

    //     console.log(cll);
    //     console.log(dd);

    //     if (dd[0] == "9" || dd[0] == "10"){
    //         var roww = parseInt(dd[1]) + 1;

    //         var jstartx = "J"+roww;
    //         var jstopx  = "K"+roww;

    //         console.log(jstartx);
    //         console.log(jstopx);

    //         jstart = $("#my-spreadsheet").jexcel('getValue', jstartx);
    //         jstop = $("#my-spreadsheet").jexcel('getValue', jstopx);

    //         console.log(jstart);
    //         console.log(jstop);

    //         var t1 = jstart.split(":");
    //         var t2 = jstop.split(":");

    //         var min_1 = parseInt(t1[0]) * 60 + parseInt(t1[1]);
    //         var min_2 = parseInt(t2[0]) * 60 + parseInt(t2[1]);

    //         console.log((min_2-min_1));
    //     } 
    // };
    

    function refresh(data) {
        if (data.length<1) {
            console.log("yes");

            data = []; //JSON.parse(msg);
            console.log(data);
            x = data;
            // $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                // onchange: handler,
                colHeaders: [
                    'No WO',
                    'Station<br>Unit<br>Sub Unit',
                    'Problem',
                    'Status',
                    'Tanggal<br>Closing',
                    'Plan',
                    'Real',

                ],
                // colWidths: [150, 150, 150, 150, 200, 200, 40, 100, 60, 75, 75, 75, 100],
                colWidths: [140, 250, 250, 100, 100, 60, 60, 75, 75, 75, 100],
                columns: [
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true, wordWrap: true },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

            $('#my-spreadsheet').jexcel('updateSettings', {
                table: function (instance, cell, col, row, val, id) {
                    if (col == 3) {
                        console.log(val);

                        if (val == "open") {
                            $(cell).css('color', '#000000');
                            $(cell).css('background-color', '#ff0000');
                        } else if (val == "close") {
                            $(cell).css('color', '#000000');
                            $(cell).css('background-color', '#00ff00');
                        }
                    }
                }
            });

        }else{
            // $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                // onchange: handler,
                colHeaders: [
                    'No WO',
                    'Station<br>Unit<br>Sub Unit',
                    'Problem',
                    'Status',
                    'Tanggal<br>Closing',
                    'Plan',
                    'Real',
                ],
                // colWidths: [150, 150, 150, 150, 200, 200, 40, 100, 60, 75, 75, 75, 100],
                colWidths: [140, 250, 250, 100, 100, 60, 60, 75, 75, 75, 100],
                columns: [
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true ,wordWrap: true},
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

            $('#my-spreadsheet').jexcel('updateSettings', {
                table: function (instance, cell, col, row, val, id) {
                    if (col == 3) {
                        console.log(val);

                        if (val == "open") {
                            $(cell).css('color', '#000000');
                            $(cell).css('background-color', '#ff0000');
                        } else if (val == "close") {
                            $(cell).css('color', '#000000');
                            $(cell).css('background-color', '#00ff00');
                        }
                    }
                }
            });
        }
    }

    $("#pabrik").change(function () {
        // station_refresh();
        // refresh_modal();

        ajax_refresh();
    });
    $("#bulan").change(function () {
        ajax_refresh();
    });
    $("#tanggal").change(function () {
        ajax_refresh();
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "planvsreal/load",
            data: {
                id_pabrik: $("#pabrik").val(),
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

    var d = tgl.getDate();
    if (d < 10) {
        $("#tanggal").val("0" + d.toString());
    } else {
        $("#tanggal").val(d.toString());
    }

    ajax_refresh();

    $("#download_plan").click(function () {
        // station_refresh();
        window.open(BASE_URL + "index.php/planvsreal/download/" + $("#pabrik").val() + "/" + $("#tahun").val() + "/" + $("#bulan").val() + "/" + $("#tanggal").val());
    });
});
