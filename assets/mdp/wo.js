$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh(data){
        var nama_pt = $("#pabrik").val();
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        var tanggal = $("#tanggal").val();


        var no_wo = nama_pt+"-"+tahun+"-"+bulan+"-"+tanggal;

        var arr_no_wo = [];

        var no_last_wo = 1;
        var no_max_wo = no_last_wo+100;
        if(no_max_wo>9999){
            no_max_wo = 9999;
        }
        var j = 0;
        for(var i=no_last_wo;i<no_max_wo;i++){
            if(i<10){
                arr_no_wo[j++] = no_wo +"-0"+ i.toString();
            } else if (i < 100){
                arr_no_wo[j++] = no_wo + "-" + i.toString();
            }
            // } else if (i < 1000){
            //     arr_no_wo[j++] = no_wo + "-0" + i.toString();
            // }else{
            //     arr_no_wo[j++] = no_wo + "-" +i.toString();
            // }
        }

        handler = function (obj, cell, val) {
            console.log('My table id: ' + $(obj).prop('id'));
            console.log('Cell changed: ' + $(cell).prop('id'));
            console.log('Value: ' + val);
        };

        if (data == undefined){
            data = [];
        }

        $('#my-spreadsheet').jexcel({
            data: data,
            allowInsertColumn: false,
            onchange :handler,
            // colHeaders: ['Tanggal', 'No WO', 'Station', 'Equipment', 'Problem', 'Penjelasan<br>Masalah', 'HM', 'Kategori', 'status'],
            colHeaders: ['No WO', 'Station', 'Equipment', 'Problem', 'Penjelasan<br>Masalah', 'HM', 'Kategori', 'status'],
            colWidths: [170, 140, 140, 250, 250, 100, 75, 80, 80],
            columns: [
                // { type: 'calendar', option: { format: 'DD/MM/YYYY' } },
                { type: 'autocomplete', source: arr_no_wo },
                { type: 'autocomplete', url: BASE_URL+'station/ajax/' + $("#pabrik").val() },
                { type: 'autocomplete', url: BASE_URL+'unit/ajax/' + $("#pabrik").val() },
                { type: 'text', wordWrap: true },
                { type: 'text', wordWrap: true },
                { type: 'text' },
                { type: 'dropdown', source: ['plan', 'unplan'] },
                { type: 'dropdown', source: ['open', 'close'] },
            ]
        });

        $('#my-spreadsheet').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col == 7) {
                    if (val == "open") {
                        $(cell).css('background-color', '#ff0000');
                    } else if (val == "close") {
                        $(cell).css('background-color', '#00ff00');
                    }
                }
            }
        });

    }

    $("#pabrik").change(function () {
        ajax_refresh();
    });
    $("#tahun").change(function () {
        ajax_refresh();
    });
    $("#bulan").change(function () {
        ajax_refresh();
    });
    $("#tanggal").change(function () {
        ajax_refresh();
    });

    $("#simpan").click(function(){
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"wo/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    var tgl = new Date();
    var m = tgl.getMonth()+1;
    if(m<10){
        $("#bulan").val("0"+m.toString());
    }else{
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

    // refresh();
    function ajax_refresh(){
        $.ajax({
            method: "POST",
            url: BASE_URL+"wo/load",
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

    ajax_refresh();
});
