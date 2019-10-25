$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    function refresh(data) {
        $('#my-spreadsheet').jexcel({
            data: data,
            allowInsertColumn: false,
            colHeaders: [
                'Tanggal Isi<br>Terakhir',
                'Station',
                'Unit',
                'acm',
                'Keterangan'
            ],
            colWidths: [100, 200, 300, 50, 300, 100, 60, 100, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'checkbox' },
                { type: 'text' },
            ],
        });
    }

    $("#pabrik").change(function () {
        ajax_refresh();
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "acm/load_problem",
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
