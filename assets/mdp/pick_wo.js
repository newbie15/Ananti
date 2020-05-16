$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    var first = 0;

    function station_refresh() {
        $("#inp_station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val());
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
        $("#inp_unit").load(BASE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()));
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
        $("#inp_sub_unit").load(BASE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val() + "/" + $("#unit").val()));
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
            <th>Problem</th>\
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
            // shtml += "<td>Problem : " + element[3] + "<br>Penyelesaian:" + element[4] + "</td>";
            // shtml += "<td>" + element[5] + "</td>";
            // shtml += "<td>" + element[6] + "</td>";
            shtml += "<td>" + element[7] + "</td>";
            // if (element[8] == 0) {
            //     shtml += "<td><button class=\"btn btn-xs btn-warning\">Pick</button></td>";
            // } else {
                shtml += "<td><button class=\"btn btn-success\" onclick=\"pick('"+element[0]+"')\">Pick WO</button></td>";
            // }
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

    $("#savenchoose").click(function () {
        // var data_j = $('#my-spreadsheet').jexcel('getData');
        // console.log(data_j);

        // var pabrik = $("#pabrik").val();
        // var tanggal = $("#inp_tanggal").val();
        // var no_wo = $("#inp_no_wo").val();
        // var station = $("#inp_station").val();
        // var unit = $("#inp_unit").val();
        // var sub_unit = $("#inp_sub_unit").val();
        // var problem = $("#inp_problem").val();

        // $.ajax({
        //     method: "POST",
        //     url: BASE_URL+"wo/simpan_single",
        //     success: sukses,
        //     data: {
        //         pabrik = $("#pabrik").val(),
        //         tanggal = $("#inp_tanggal").val(),
        //         no_wo = $("#inp_no_wo").val(),
        //         station = $("#inp_station").val(),
        //         unit = $("#inp_unit").val(),
        //         sub_unit = $("#inp_sub_unit").val(),
        //         problem = $("#inp_problem").val(),
        //     }
        // }).done(function (msg) {
        //     console.log(msg);
        // });
    });

    function firts_ui(){
        first = 1;
        $("#station").val(passdata[0]);
        $("#inp_station").val(passdata[0]);

        $("#problem").html(passdata[3]);
        $("#inp_problem").val(passdata[3]);
        $("#penyelesaian").html(passdata[4]);
        unit_refresh();
        setTimeout(() => {
            $("#unit").val(passdata[1]);
            $("#inp_unit").val(passdata[1]);
            sub_unit_refresh();            
        }, 1500);
        setTimeout(() => {
            $("#sub_unit").val(passdata[2]);
            $("#inp_sub_unit").val(passdata[2]);
            ajax_refresh();            
        }, 3000);
    }

    var tgl = new Date();
    var y = tgl.getFullYear();
    var m = tgl.getMonth() + 1;
    var d = tgl.getDate();

    if (m < 10) { m = "0" + m; } else {}
    if (d < 10) { d = "0" + d; } else {}

    $("#inp_tanggal").val(y+"-"+m+"-"+d);

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

    $("#inp_station").change(function () {
        $("#station").val($(this).val());
        unit_refresh();
    });

    $("#inp_unit").change(function () {
        $("#unit").val($(this).val());
        sub_unit_refresh();
    });

    $("#inp_sub_unit").change(function () {
        $("#sub_unit").val($(this).val());
        ajax_refresh();
    });

    $("#gen_no_wo").click(function(){
        var tanggal = $("#inp_tanggal").val();
        console.log(tanggal);

        $.ajax({
            method: "POST",
            url: BASE_URL + "wo/generate_no_wo",
            // success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                tanggal: tanggal,
            }
        }).done(function (msg) {
            console.log(msg);
            if(msg!=''){
                no_wo = msg.split('-');
                no = parseInt(no_wo[4]) + 1;
                no_wo_baru = no_wo[0] + "-" + no_wo[1] + "-" + no_wo[2] + "-" + no_wo[3] + "-" + no;
                $("#inp_no_wo").val(no_wo_baru);
            }else{
                no_wo = $("#inp_tanggal").val().split('-');
                // no = parseInt(no_wo[4]) + 1;
                no_wo_baru = $("#pabrik").val() + "-" + no_wo[0] + "-" + no_wo[1] + "-" + no_wo[1] + "-01";
                $("#inp_no_wo").val(no_wo_baru);
            }
        });

    });

    station_refresh();

    setTimeout(() => {
        firts_ui();
    }, 500);

});
