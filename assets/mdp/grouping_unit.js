$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    function station_refresh() {
        $("#station").load(SITE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    unit_refresh();
                } else {
                }
            }
        );
    }

    function unit_refresh() {
        $("#unit").load(SITE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    sub_unit_refresh();
                } else {
                }
            }
        );
    }

    function sub_unit_refresh() {
        $("#sub_unit").load(SITE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()) + "/" + encodeURI($("#unit").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                } else {
                }
            }
        );
    }



    function group_unit_refresh() {
        $("#group_unit").load(SITE_URL + "grouping/ajax_dropdown/" + $("#pabrik").val(),
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

    function add(no, sx, ux) {
        var sama = 0;
        var index = 0;
        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        if (dx[0][0] == "") { // kosong
            dx[0][0] = no;
            dx[0][1] = sx;
            dx[0][2] = ux;
            // dx[0][3] = su;
        } else { // isi satu
            dx.push([no, sx , ux ]);
        }

        refresh(dx);

        // $("#wo").val("");
        $("#modal-default").modal("hide");

        updatescroll();
    }

    function updatescroll() {
        setTimeout(() => {
            var el = document.getElementById("scrll");
            el.scrollTop = el.scrollHeight;
        }, 500);
    }


    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "grouping_unit/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                grouping: $("#group_unit").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }

    function refresh(data) {
        // $.ajax({
        //     method: "POST",
        //     url: SITE_URL+"grouping_unit/load",
        //     data: {
        //         id_pabrik: $("#pabrik").val(),
        //         grouping: $("#group_unit").val(),
        //     }
        // }).done(function (msg) {
        //     console.log(msg);
        //     data = JSON.parse(msg);
        //     console.log(data);
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                // tableOverflow: true,
                // tableHeight: '400px',
                colHeaders: [
                    // 'Station',
                    'Station',
                    'Unit',
                    'Sub Unit',
                ],

                colWidths: [200, 250, 250, 100, 100, 100, 100, 100],
                columns: [
                    // { type: 'autocomplete', url: SITE_URL+'station/ajax/' + $("#pabrik").val() },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ]
            });
        // });
    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"grouping_unit/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                grouping: $("#group_unit").val(),

                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    $("#pabrik").change(function () {
        group_unit_refresh();
    });
    $("#group_unit").change(function () {
        ajax_refresh();
    });

    $("#tambah").click(function () {
        station_refresh();
    });

    $("#station").change(function () {
        unit_refresh();
    });

    $("#unit").change(function () {
        sub_unit_refresh();
    });

    $("#tplus").click(function () {
        add($("#station").val(), $("#unit").val(), $("#sub_unit").val());
    });

    group_unit_refresh();

    


});
