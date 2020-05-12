$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    var first = 0;

    function station_refresh() {
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success" && first == 1) {
                    unit_refresh();
                } else {
                }
            }
        );
    }

    function unit_refresh() {
        $("#unit").load(BASE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success" && first == 1) {
                    sub_unit_refresh();
                } else {
                }
            }
        );
    }

    function sub_unit_refresh() {
        $("#sub_unit").load(BASE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val() + "/" + $("#unit").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success" && first == 1) {
                    ajax_refresh();
                } else {
                }
            }
        );
    }

    function table_ui_refresh(params) {
        shtml = "<tbody><tr>\
            <th>No WO</th>\
            <th>Area</th>\
            <th>Problem & Penyelesaian</th>\
            <th>Start</th>\
            <th>Stop</th>\
            <th>Status</th>\
            <th>Action</th>\
            </tr>";
        params.forEach(element => {
            shtml += "<tr>";
            shtml += "<td>" + element[0] + "</td>";
            if (element[1] == "null") {
                shtml += "<td><button class=\"btn btn-info\" area=\"'" + element[2] + "<br>" + element[3] + "<br>" + element[4] + "'\">Pick WO</button></td>";
            } else {
                shtml += "<td>" + element[1] + "</td>";
            }
            shtml += "<td>" + element[2] + "</td>";
            shtml += "<td>Problem : " + element[3] + "<br>Penyelesaian:" + element[4] + "</td>";
            shtml += "<td>" + element[5] + "</td>";
            shtml += "<td>" + element[6] + "</td>";
            shtml += "<td>" + element[7] + "</td>";
            if (element[8] == 0) {
                shtml += "<td><button class=\"btn btn-xs btn-warning\">Verify</button></td>";
            } else {
                shtml += "<td><button class=\"btn btn-xs btn-success\">Verified</button></td>";
            }
            shtml += "</tr>";
        });

        shtml += "</tbody>"
        $("#my-table").html(shtml);
    }

    function ajax_refresh(){
        $.ajax({
            method: "POST",
            url: BASE_URL+"wo/pick_wo",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                id_unit: $("#unit").val(),
                id_sub_unit: $("#sub_unit").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            table_ui_refresh(data);
        });
    }

    var data = [];

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"attachment/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                unit: $("#unit").val(),
                sub_unit: $("#sub_unit").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function firts_ui(){
        first = 1;
        $("#station").val(passdata[0]);
        unit_refresh();
        setTimeout(() => {
            $("#unit").val(passdata[1]);
            sub_unit_refresh();            
        }, 1500);
        setTimeout(() => {
            $("#sub_unit").val(passdata[2]);
            ajax_refresh();            
        }, 3000);
    }

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
        ajax_refresh();
    });

    station_refresh();

    setTimeout(() => {
        firts_ui();
    }, 500);

});
