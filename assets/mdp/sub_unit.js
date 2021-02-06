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
                    unit_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function unit_refresh() {
        $("#unit").load(SITE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
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

    function ajax_refresh(){
        $.ajax({
            method: "POST",
            url: SITE_URL+"sub_unit/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                id_unit: $("#unit").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            $('#my-spreadsheet').jexcel({
                data: data,
                colHeaders: [
                    'Sub Unit',
                    'Klasifikasi',
                    'Critical<br>Unit',
                    'Hourmeter<br>Monitoring',
                    'Vibration<br>Monitoring',
                    'Temperature<br>Monitoring',
                    'Oiling<br>Monitoring',
                    'Electromotor<br>Monitoring'

                ],
                allowInsertColumn: false,
                tableOverflow: true,
                tableHeight: '400px',
                colWidths: [250, 250, 100, 100, 100, 100, 100, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'checkbox' },
                    { type: 'checkbox' },
                    { type: 'checkbox' },
                    { type: 'checkbox' },
                    { type: 'checkbox' },
                    { type: 'checkbox' },

                ]
            });
        });
    }

    // refresh();
    var data = [];

    $('#my-spreadsheet').jexcel({
        data: data,
        colHeaders: [
            'Sub Unit',
            'Klasifikasi',
            'Critical<br>Unit',
            'Hourmeter<br>Monitoring',
            'Vibration<br>Monitoring',
            'Temperature<br>Monitoring',
            'Oiling<br>Monitoring',
            'Electromotor<br>Monitoring'

        ],
        allowInsertColumn: false,
        tableOverflow: true,
        tableHeight: '400px',
        colWidths: [250, 250, 100, 100, 100, 100, 100, 100],
        columns: [
            { type: 'text' },
            { type: 'text' },
            { type: 'checkbox' },
            { type: 'checkbox' },
            { type: 'checkbox' },
            { type: 'checkbox' },
            { type: 'checkbox' },
            { type: 'checkbox' },

        ]
    });


    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"sub_unit/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                unit: $("#unit").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    $("#pabrik").change(function(){
        station_refresh();
    });

    $("#station").change(function () {
    	unit_refresh();
    });

    $("#unit").change(function () {
        ajax_refresh();
    });

    station_refresh();
});
