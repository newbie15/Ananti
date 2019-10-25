$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL+"karyawan/load",
            data: {
                id_pabrik: $("#pabrik").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            $('#my-spreadsheet').jexcel({
                data: data,
                colHeaders: [
                    'Nama',
                    'Bagian',
                ],

                colWidths: [150, 150, 150, 100, 250, 250, 75, 75],
                columns: [
                    { type: 'text' },
                    { type: 'dropdown', source: ["mekanik", "elektrik"] },

                ]
            });
        });
    }

    refresh();

    // $('#my-spreadsheet').jexcel({
    //     colHeaders: [
    //         'Nama',
    //         'Bagian',
    //     ],

    //     colWidths: [150, 150, 150, 100, 250, 250, 75, 75],
    //     columns: [
    //         { type: 'text' },
    //         { type: 'dropdown', source: ["mekanik","elektrik"] },

    //     ]
    // });

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"karyawan/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    $("#pabrik").change(function () {
        console.log($(this).val());
        refresh();
    });
});
