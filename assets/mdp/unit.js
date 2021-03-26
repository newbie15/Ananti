$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
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

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "unit/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }

    handler = function (obj, cell, val) {
        // console.log('My table id: ' + $(obj).prop('id'));
        // console.log('Cell changed: ' + $(cell).prop('id'));
        // console.log('Value: ' + val);

        cll = $(cell).prop('id');
        dd = cll.split("-");
        kolom = dd[0];
        baris = dd[1];

        var d = $("#my-spreadsheet").jexcel('getRowData', dd[1]);
        console.log(d);
        var e_number = d[0]+"."+$("#station").val()+"."+d[1];
        if( dd[0]==0 || dd[0]==1 ){
            console.log("set value "+"C"+dd[1] + 1+" "+e_number);
            $("#my-spreadsheet").jexcel('setValue', "C" + (parseInt(dd[1]) + 1), e_number);
        }
        jexcel_diubah();
    };    

    function refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL+"unit/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                onchange: handler,
                // tableOverflow: true,
                // tableHeight: '400px',
                colHeaders: [
                    'Unit Type',
                    'Unit Numbering',
                    'Unit Number<br>Auto Generated',
                    'Unit Name',
                ],

                colWidths: [350, 150, 150, 300, 100, 100, 100, 100],
                columns: [
                    { type: 'autocomplete', url: SITE_URL + 'unittype/ajax/',autocomplete:true},
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ]
            });
        });
    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"unit/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),

                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
            jexcel_disimpan();
        });
    });

    $("#pabrik").change(function () {
        station_refresh();
    });
    $("#station").change(function () {
        ajax_refresh();
    });

    station_refresh();

    


});
