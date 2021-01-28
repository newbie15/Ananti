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

    function unit_refresh(){
        // console.log(SITE_URL + "unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()));
        $("#unit").load(SITE_URL + "unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    sub_unit_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function sub_unit_refresh() {
        $("#sub_unit").load(SITE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val() + "/" + $("#unit").val()),
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
        refresh();
    }

    function refresh() {

        var id_pabrik = $("#pabrik").val();
        var id_station = $("#station").val();
        var id_unit = $("#unit").val();
        var id_sub_unit = $("#sub_unit").val();
        console.log(SITE_URL + 'index.php/historical/loadcsv/' + id_pabrik + "/" + encodeURI(id_station) + "/" + encodeURI(id_unit));

        // jexcel(document.getElementById('#my-spreadsheet'), {
        $("#my-spreadsheet").html("");
        jexcel(document.getElementById('my-spreadsheet'), {
            csv: SITE_URL + 'index.php/historical/loadcsv/' + id_pabrik + "/" + encodeURI(id_station) + "/" + encodeURI(id_unit) + "/" + encodeURI(id_sub_unit),
            csvHeaders: true,
            search: true,
            pagination: 10,
            columns: [
                { type: 'text', width: 200 },
                { type: 'text', width: 200 },
                { type: 'text', width: 250 },
                { type: 'text', width: 100 },
                { type: 'text', width: 100 },
                { type: 'text', width: 75 },
            ]
        }); 


        // $.ajax({
        //     method: "POST",
        //     url: SITE_URL+"historical/load",
        //     data: {
        //         id_pabrik: $("#pabrik").val(),
        //         id_station: $("#station").val(),
        //         id_unit: $("#unit").val(),
        //     }
        // }).done(function (msg) {
        //     console.log(msg);
        //     data = JSON.parse(msg);
        //     console.log(data);
        //     $('#my-spreadsheet').jexcel({
        //         data: data,
        //         allowInsertColumn: false,

        //         colHeaders: [
        //             // 'Station',
        //             'No WO',
        //             'Problem',
        //             'Desc<br>Masalah',
        //             'HM',
        //             // 'kategori',
        //             // 'status',
        //         ],

        //         colWidths: [150, 350, 150, 100, 250, 250, 75, 75],
        //         columns: [
        //             // { type: 'autocomplete', url: SITE_URL+'station/ajax/' + $("#pabrik").val() },
        //             { type: 'text' },
        //             { type: 'text' },
        //             { type: 'text' },
        //             { type: 'text' },
        //             { type: 'text' },
        //             { type: 'text' },
        //             // { type: 'checkbox' },

        //         ]
        //     });
        // });
    }

    // $("#simpan").click(function () {
    //     var data_j = $('#my-spreadsheet').jexcel('getData');
    //     console.log(data_j);

    //     $.ajax({
    //         method: "POST",
    //         url: SITE_URL+"unit/simpan",
    //         success: sukses,
    //         data: {
    //             pabrik: $("#pabrik").val(),
    //             station: $("#station").val(),

    //             data_json: JSON.stringify(data_j),
    //         }
    //     }).done(function (msg) {
    //         console.log(msg);
    //     });
    // });

    $("#download").click(function(){
        window.open(SITE_URL + "index.php/historical/download_excel/" + $("#pabrik").val() + "/" + $("#station").val() + "/" + $("#unit").val() + "/" + $("#sub_unit").val());
    });

    $("#pabrik").change(function () {
        station_refresh();
    });

    $("#station").change(function () {
        unit_refresh();
    });

    $("#unit").change(function () {
        sub_unit_refresh();
    });

    $("#sub_unit").change(function () {
        ajax_refresh();
    });

    station_refresh();
});
