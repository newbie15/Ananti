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
                    // ajax_refresh();
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
                    attachment_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function attachment_refresh() {
        $("#attachment").load(SITE_URL + "attachment/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val() + "/" + $("#unit").val() + "/" + $("#sub_unit").val()),
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

    function refresh(datax) {
        $('#my-spreadsheet').html("");
        $('#my-spreadsheet').jexcel({
            data: datax,
            colHeaders: [
                'Part Numbering',
                'Part Number<br>From Catalog',
                'Part Name<br>From Catalog',
                'Specification<br>From Catalog',
                'Instrument<br>Label',
            ],
            allowInsertColumn: false,
            tableOverflow: true,
            tableHeight: '400px',
            colWidths: [250, 250, 250, 250, 250, 100, 100, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ]
        });        
    }

    function refresh_modal() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "partcatalog/list_part",
            data: {
                id_pabrik: $("#pabrik").val(),
            }
        }).done(function (msg) {
            x = [];
            y = [];
            data = JSON.parse(msg);

            for (i in data) {
                console.log(data[i].daftar);
                x.push(data[i].daftar);
                y[i] = x;
                x = [];
            }
            // console.log(y);
            var table = $('#dt-table-part').DataTable({
                destroy: true,
                data: y,
                columns: [{
                    title: "Daftar"
                }, ]
            });

            $('.dataTable tbody').on('click', 'tr', function () {
                if (table.row(this).data() != undefined) {
                    console.log('API row values : ', table.row(this).data());
                    var sp = table.row(this).data();
                    sp = sp[0].split(" - ");
                    add(sp[0],sp[1],sp[2]);
                    $('#modal-part-katalog').modal('toggle');
                }
            });
        });
    }

    function ajax_refresh(){
        $.ajax({
            method: "POST",
            url: SITE_URL+"part/load",
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
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                colHeaders: [
                    'Part Numbering',
                    'Part Number<br>From Catalog',
                    'Part Name<br>From Catalog',
                    'Specification<br>From Catalog',
                    'Instrument<br>Label',
                ],
                allowInsertColumn: false,
                tableOverflow: true,
                tableHeight: '400px',
                colWidths: [250, 250, 250, 250, 250, 100, 100, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ]
            });
        });
    }

    // refresh();
    var data = [];

    $('#my-spreadsheet').html("");
    $('#my-spreadsheet').jexcel({
        data: data,
        colHeaders: [
            'Part Numbering',
            'Part Number<br>From Catalog',
            'Part Name<br>From Catalog',
            'Specification<br>From Catalog',
            'Instrument<br>Label',
        ],
        allowInsertColumn: false,
        tableOverflow: true,
        tableHeight: '400px',
        colWidths: [250, 250, 250, 250, 250, 100, 100, 100],
        columns: [
            { type: 'text' },
            { type: 'text' },
            { type: 'text' },
            { type: 'text' },
            { type: 'text' },
        ]
    });

    function add(nu, na, sp) {
        var sama = 0;
        var index = 0;
        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        if (dx[0][0] == "") { // kosong
            dx[0][0] = "";
            dx[0][1] = nu;
            dx[0][2] = na;
            dx[0][3] = sp;

        } else { // isi satu
            dx.push(["", nu, na, sp, ""]);
        }

        refresh(dx);

        // $("#wo").val("");
        // $("#modal-part-katalog").modal("hide");

        // updatescroll();
    }

    $("#tambahpart").click(function () {
        refresh_modal();
    });

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"part/simpan",
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
