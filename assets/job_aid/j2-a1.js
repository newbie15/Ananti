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
                $('#my-spreadsheet').jexcel({
                    data: data,
                    allowInsertColumn: false,
                    colHeaders: [
                        'Nametag / ID',
                        'Poin 1',
                        'Poin 2',
                        'Poin 3',
                        'Poin 4',
                        'Poin 5',
                        'Poin 6',
                        'Poin 7',
                        'Poin 8',
                        'Poin 9',
                        'Poin 10',
                        'Hasil Test',
                    ],
                    colWidths: [300, 75,75,75,75,75,75,75,75,75,75,75,100],
                    columns: [
                        { type: 'text' },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                        { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    ],
                });

            });
        }else{
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                colHeaders: [
                    'Nametag / ID',
                    'Poin 1',
                    'Poin 2',
                    'Poin 3',
                    'Poin 4',
                    'Poin 5',
                    'Poin 6',
                    'Poin 7',
                    'Poin 8',
                    'Poin 9',
                    'Poin 10',
                    'Hasil Test',
                ],
                colWidths: [300, 75,75,75,75,75,75,75,75,75,75,75,100],
                columns: [
                    { type: 'text' },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
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
