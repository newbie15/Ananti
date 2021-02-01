$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    function ajax_refresh(){
        $.ajax({
            method: "POST",
            url: BASE_URL+"report/load",
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
                    'Parameter',
                    'Value',
                ],
                allowInsertColumn: false,
                tableOverflow: true,
                tableHeight: '400px',
                colWidths: [250, 250],
                columns: [
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
            'Parameter',
            'Value',
        ],
        allowInsertColumn: false,
        tableOverflow: true,
        tableHeight: '400px',
        colWidths: [250, 250],
        columns: [
            { type: 'text' },
            { type: 'text' },
        ]
    });


    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"report/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    $("#pabrik").change(function(){
        ajax_refresh();
    });

    ajax_refresh();
});
