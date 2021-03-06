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

        $('#my-G').jexcel({
            data: data,
            colHeaders: [
                'Titik Pengukuran', 'Ada Bak<br>Kontrol ?', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des', 'Keterangan'],
            colWidths: [200, 100, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 200],
            columns: [
                // { type: 'autocomplete', source: ['loading ramp', 'sterilizer', 'thresher', 'press', 'bunch press', 'kernel', 'klarifikasi', 'boiler', 'effluent', 'dispatch'] },
                { type: 'text' },
                { type: 'checkbox' },
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
                { type: 'text', wordWrap: true },
            ],
            // onchange: handler,
            allowInsertColumn: false,	
        });
        $('#my-G').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col > 1 && col < 14) {
                    var nilai = parseFloat(val);
                    // console.log(nilai);
                    if (!isNaN(nilai)) {
                        // console.log(val);
                        if (nilai <= 1.0) {
                            $(cell).css('background-color', '#1aab68');
                            $(cell).css('color', '#fff');
                        } else if (nilai <= 3.0) {
                            $(cell).css('background-color', '#ffff00');
                            $(cell).css('color', '#000');
                        } else {
                            $(cell).css('background-color', '#ff0000');
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
            data: datam,
            colHeaders: [
                'Titik Pengukuran', 'Ada Bak<br>Kontrol ?', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des', 'Keterangan'],
            colWidths: [200, 100, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 200],
            columns: [
                // { type: 'autocomplete', source: ['loading ramp', 'sterilizer', 'thresher', 'press', 'bunch press', 'kernel', 'klarifikasi', 'boiler', 'effluent', 'dispatch'] },
                { type: 'text' },
                { type: 'checkbox' },
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
                { type: 'text', wordWrap: true },
            ],
            // onchange: handler,
            allowInsertColumn: false,	
        });
        $('#monalisa').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col > 1 && col < 14) {
                    var nilai = parseFloat(val);
                    // console.log(nilai);
                    if (!isNaN(nilai)) {
                        // console.log(val);
                        if (nilai <= 1.0) {
                            $(cell).css('background-color', '#1aab68');
                            $(cell).css('color', '#fff');
                        } else if (nilai <= 3.0) {
                            $(cell).css('background-color', '#ffff00');
                            $(cell).css('color', '#000');
                        } else {
                            $(cell).css('background-color', '#ff0000');
                            $(cell).css('color', '#fff');
                        }
                    } else {
                        $(cell).css('background-color', '#ffffff');
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
            url: SITE_URL + "grounding/simpan",
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
            url: SITE_URL + "grounding/load",
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
            url: INET_URL + "grounding/load",
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
            minWidth: 1150,
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
        if(confirm("anda yakin untuk mengcopy ?\n\nData Grounding\nMonalisa ke Ananti")){
            var datam = $('#monalisa').jexcel('getData');
            data = datam;
            refresh(data);
            $("#dialog").dialog('close');
        }
    });

    ajax_refresh();
});
