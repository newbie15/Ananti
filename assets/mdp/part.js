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
                    unit_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function unit_refresh() {
        $("#unit").load(BASE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    // ajax_refresh();
                    sub_unit_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function sub_unit_refresh() {
        $("#sub_unit").load(BASE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val() + "/" + $("#unit").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    attachment_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function attachment_refresh() {
        $("#attachment").load(BASE_URL + "attachment/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val() + "/" + $("#unit").val() + "/" + $("#sub_unit").val()),
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
            url: BASE_URL+"part/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                id_unit: $("#unit").val(),
                id_sub_unit: $("#sub_unit").val(),
                id_attachment: $("#attachment").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            $('#my-spreadsheet').jexcel({
                data: data,
                colHeaders: [
                    'Part',
                    'Spresifikasi',
                    'Lifetime',
                ],
                allowInsertColumn: false,
                tableOverflow: true,
                tableHeight: '400px',
                colWidths: [250, 250, 100, 100, 100, 100, 100, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ]
            });
        });
    }

    // refresh();
    var data = [];

    $('#my-spreadsheet').jexcel({
        data: data,
        colHeaders: [
            'Part',
            'Spesifikasi',
            'Lifetime',
        ],
        allowInsertColumn: false,
        tableOverflow: true,
        tableHeight: '400px',
        colWidths: [250, 250, 100, 100, 100, 100, 100, 100],
        columns: [
            { type: 'text' },
            { type: 'text' },
            { type: 'text' },
        ]
    });


    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"part/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                unit: $("#unit").val(),
                sub_unit: $("#sub_unit").val(),
                attachment: $("#attachment").val(),
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
        sub_unit_refresh();
    });

    $("#sub_unit").change(function () {
        attachment_refresh();
    });

    $("#attachment").change(function () {
        ajax_refresh();
    });

    station_refresh();
});
