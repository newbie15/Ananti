$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];

    function refresh(){
        if (data == undefined) {
            data = [];
        }

        $('#my-G').html("");
        $('#my-G').jexcel({
            data: data,
            colHeaders: ['Kapasitor', 'KVAR', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'Keterangan'],
            colWidths: [200, 100, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 200],
            columns: [
                { type: 'text' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                // { type: 'number' },                
                { type: 'text', wordWrap: true },
            ],
            nestedHeaders: [
                [   
                    {title: '',colspan: '2',},
                    {title: 'Januari',colspan: '3'},
                    {title: 'Februari',colspan: '3'},
                    {title: 'Maret',colspan: '3'},
                    {title: 'April',colspan: '3'},
                    {title: 'Mei',colspan: '3'},
                    {title: 'Juni',colspan: '3'},
                    {title: 'Juli',colspan: '3'},
                    {title: 'Agustus',colspan: '3'},
                    {title: 'September',colspan: '3'},
                    {title: 'Oktober',colspan: '3'},
                    {title: 'November',colspan: '3'},
                    {title: 'Desember',colspan: '3'},
                    {title: 'Note',colspan: '0'},
                ],
            ],
            // onchange: handler,
            allowInsertColumn: false,	
        });

        $('#my-G').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col > 1 && col < 38) {
                    if (val != "0") {
                        var a = 0;
                        var b = 0;
                        if (data == [] || data == null) {
                            a = 0;
                            b = 0;
                        } else {
                            try {
                                a = data[row];
                                b = parseInt(a[1]);
                                console.log(b);
                            } catch (error) {

                            }
                        }
                        if (val < ((b * 1000 / (1.73 * 380)) * 0.5)) {
                            if(val!=""){
                                $(cell).css('background-color', '#ff0000');
                                $(cell).css('color', '#fff');
                            }
                        } else if (val <= ((b * 1000 / (1.73 * 380)) * 0.75)) {
                            $(cell).css('background-color', '#ffff00');
                            $(cell).css('color', '#000');
                        } else {
                            $(cell).css('background-color', '#1aab68');
                            $(cell).css('color', '#fff');
                        }
                    } else {
                        $(cell).css('background-color', '#ffffff');
                    }
                }
            }
        });

    }
    function mona_ui_refresh(datam){
        if (datam == undefined) {
            datam = [];
        }

        $('#monalisa').jexcel({
            data: data,
            colHeaders: ['Kapasitor', 'KVAR', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'R', 'S', 'T', 'Keterangan'],
            colWidths: [200, 100, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 200],
            columns: [
                { type: 'text' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                { type: 'number' },
                // { type: 'number' },                
                { type: 'text', wordWrap: true },
            ],
            // onchange: handler,
            allowInsertColumn: false,
        });

        $('#monalisa').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col > 1 && col < 38) {
                    if (val != "0") {
                        var a = 0;
                        var b = 0;
                        if (data == [] || data == null) {
                            a = 0;
                            b = 0;
                        } else {
                            try {
                                a = data[row];
                                b = parseInt(a[1]);
                                console.log(b);
                            } catch (error) {

                            }
                        }
                        if (val < ((b * 1000 / (1.73 * 380)) * 0.5)) {
                            if(val!=""){
                                $(cell).css('background-color', '#ff0000');
                                $(cell).css('color', '#fff');
                            }else{
                                $(cell).css('background-color', '#ffffff');
                                $(cell).css('color', '#000');
                            }
                        } else if (val <= ((b * 1000 / (1.73 * 380)) * 0.75)) {
                            $(cell).css('background-color', '#ffff00');
                            $(cell).css('color', '#000');
                        } else {
                            $(cell).css('background-color', '#1aab68');
                            $(cell).css('color', '#fff');
                        }
                    } else {
                        $(cell).css('background-color', '#ffffff');
                        $(cell).css('color', '#000');
                    }
                }
            }
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
            shtml += "<option>"+i+"</option>";
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
        shtml += "<option>"+i+"</option>";
    }
    $("#tahun").html(shtml);

    $("#tahun").val(y.toString());


    $("#simpan").click(function () {
        var data = $('#my-G').jexcel('getData');
        console.log(data);

        $.ajax({
            method: "POST",
            url: SITE_URL + "kapasitor/simpan",
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
            url: SITE_URL + "kapasitor/load",
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

    function monalisa_refresh() {
        $.ajax({
            method: "POST",
            url: INET_URL + "kapasitor/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                tahun: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            mona_ui_refresh(data);
        });
    }

    $("#sync").click(function () {

        $("#dialog").dialog({
            resizable: true,
            minWidth: 1200,
            maxWidth: 1300,
            minHeight: 200,
            maxHeight: 500,
            height: 350,
            // modal: true
            show: {
                effect: "fade",
                duration: 150
            },
            hide: {
                effect: "fade",
                duration: 150
            },
        });

        monalisa_refresh();
    });

    $("#m2a").click(function () {
        if(confirm("anda yakin untuk mengcopy ?\n\nData Kapasitor\nMonalisa ke Ananti")){
            var datam = $('#monalisa').jexcel('getData');
            datam.forEach(element => { // remove last index from bug
                element.pop();
            });
            console.log(datam);
            data = datam;
            refresh(data);
            $("#dialog").dialog('close');
        }
    });

    ajax_refresh();
});
