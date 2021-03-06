$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh(data){

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
            allowInsertRow: false,
            tableOverflow: true,
            tableHeight: '400px',
            onchange :handler,
            // colHeaders: ['Tanggal', 'No WO', 'Station', 'Equipment', 'Problem', 'Penjelasan<br>Masalah', 'HM', 'Kategori', 'status'],
            colHeaders: ['No WO', 'Station<br>Unit<br>Sub Unit', 'Problem', 'Keterangan', 'HM', 'Kategori', 'status'],
            colWidths: [140, 250, 340, 250, 75, 75, 75, 80, 80],
            columns: [
                { type: 'text' },                
                { type: 'text' , wordWrap: true },
                // { type: 'text' },                
                { type: 'text', wordWrap: true },
                { type: 'text', wordWrap: true },
                { type: 'text' },
                { type: 'text' },
                { type: 'dropdown', source: ['open', 'close'] },
            ]
        });

        $('#my-spreadsheet').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col == 6) {
                    if (val == "open") {
                        $(cell).css('background-color', '#ff0000');
                        $(cell).css('color', '#ffffff');
                    } else if (val == "close") {
                        $(cell).css('background-color', '#00ff00');
                        $(cell).css('color', '#000000');
                    }
                }
            }
        });

    }

    $("#pabrik").change(function () {
        ajax_refresh();
    });

    $("#download").click(function(){
        $("#my-spreadsheet").jexcel("download");
    });

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');

        var closed_wo = [];

        data_j.forEach(element => {
            // console.log(element);
            if(element[6]=="close"){
                closed_wo.push(element[0]);
            }            
        });

        closed_wo.forEach(element => {
            console.log(element);
        });

        if (confirm("anda yakin untuk close "+closed_wo.length+" WO ini ?")) {
            $.ajax({
                method: "POST",
                url: SITE_URL + "wo/close_wo_unfinished",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    wo: closed_wo
                }
            }).done(function (msg) {
                console.log(msg);
                if(msg=="OK"){
                    window.location.reload();
                }
            });
        }
    });

    // refresh();
    function ajax_refresh(){
        $.ajax({
            method: "POST",
            url: SITE_URL+"wo/load_unfinished",
            data: {
                id_pabrik: $("#pabrik").val(),
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
