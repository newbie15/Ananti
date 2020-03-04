$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
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

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "unit/load",
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

    function refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL+"unit/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                tableOverflow: true,
                tableHeight: '400px',
                colHeaders: [
                    // 'Station',
                    'Kode Asset',
                    'Unit',
                    // 'Critical<br>Unit',
                    // 'Hourmeter<br>Monitoring',
                    // 'Vibration<br>Monitoring',
                    // 'Temperature<br>Monitoring',
                    // 'Oiling<br>Monitoring',
                    // 'Electromotor<br>Monitoring'
                ],

                colWidths: [150, 350, 100, 100, 100, 100, 100, 100],
                columns: [
                    // { type: 'autocomplete', url: BASE_URL+'station/ajax/' + $("#pabrik").val() },
                    { type: 'text' },
                    { type: 'text' },
                    // { type: 'checkbox' },
                    // { type: 'checkbox' },
                    // { type: 'checkbox' },
                    // { type: 'checkbox' },
                    // { type: 'checkbox' },
                    // { type: 'checkbox' },
                ]
            });
        });
    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"unit/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),

                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    // $('#my-spreadsheet').jexcel({
    //     // data: data,
    //     colHeaders: [
    //         'Station',
    //         'Kode Asset',
    //         'Unit',
    //     ],

    //     colWidths: [150,150,150,100,250,250,75,75],
    //     columns: [
    //         { type: 'autocomplete', url: 'http://localhost/MDP/station/ajax/'+$("#pabrik").val() },
    //         { type: 'text' },
    //         { type: 'text' },
    //     ]
    // });


    $("#pabrik").change(function () {
        station_refresh();
    });
    $("#station").change(function () {
        ajax_refresh();
    });

    station_refresh();

    


});
