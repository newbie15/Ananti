$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";
    
    function station_refresh() {
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    unit_refresh();
                } else {
                }
            }
        );
    }

    function unit_refresh() {
        $("#unit").load(BASE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                } else {
                }
            }
        );
    }

    function refresh(data) {
        if (data.length<1) {
            console.log("yes");

            data = []; //JSON.parse(msg);
            console.log(data);
            x = data;
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                colHeaders: [
                    'No WO',
                    'Station',
                    'Unit',
                    'Sub Unit',
                    'Problem',
                    'Plan',
                    'MPP',
                    'Nama',
                    'Mek /<br>Elek',
                    'Jam<br>Start',
                    'Jam<br>Stop',
                    'PM',
                    'Ket',
                ],
                colWidths: [150, 150, 150, 150, 200, 200, 40, 100, 60, 75, 75, 75, 100],
                columns: [
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'dropdown', source: ['M', 'E'] },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'dropdown', source: ['Preventive', 'Predictive', 'Corrective'] },
                    { type: 'text' },
                ],
            });
        }else{
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                colHeaders: [
                    'No WO',
                    'Station',
                    'Unit',
                    'Sub Unit',
                    'Problem',
                    'Plan',
                    'MPP',
                    'Nama',
                    'Mek /<br>Elek',
                    'Jam<br>Start',
                    'Jam<br>Stop',
                    'PM',
                    'Ket',
                ],
                colWidths: [150, 150, 150, 150, 200, 200, 40, 100, 60, 75, 75, 75, 100],
                columns: [
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'dropdown', source: ['M', 'E'] },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'dropdown', source: ['Preventive', 'Predictive', 'Corrective'] },
                    { type: 'text' },
                ],
            });
        }
    }

    $("#pabrik").change(function () {
        // station_refresh();
        refresh_modal();

        ajax_refresh();
    });
    $("#bulan").change(function () {
        ajax_refresh();
    });
    $("#tanggal").change(function () {
        ajax_refresh();
    });

    $("#station").change(function () {
        unit_refresh();
    });

    function add(nw, sx, ux, su, pb) {
        var sama = 0;
        var index = 0;
        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        if (dx[0][0] == "") { // kosong
            dx[0][0] = nw;
            dx[0][1] = sx;
            dx[0][2] = ux;
            dx[0][3] = su;
            dx[0][4] = pb;

        } else { // isi satu
            dx.push([nw, sx, ux, su, pb, "", "", "", "", "", "", "", ""]);
        }

        refresh(dx);

        $("#wo").val("");
        $("#modal-default").modal("hide");
    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);
        $.ajax({
            method: "POST",
            url: BASE_URL+"planing/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "planing/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                // id_station: $("#station").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }
    $("#tahun").change(function () {
        var syear = parseInt($("#tahun").val());
        var shtml = null; //"<option>"++"</option>"
        var start_year = syear - 2;
        var stop_year = syear + 2;
        for (var i = start_year; i <= stop_year; i++) {
            shtml += "<option>" + i + "</option>";
        }
        $("#tahun").html(shtml);
        $("#tahun").val(syear.toString());

        ajax_refresh();
    });

    var tgl = new Date();
    var y = tgl.getFullYear();

    var shtml = null; //"<option>"++"</option>"
    var start_year = y - 2;
    var stop_year = y + 2;
    for (var i = start_year; i <= stop_year; i++) {
        shtml += "<option>" + i + "</option>";
    }
    $("#tahun").html(shtml);

    $("#tahun").val(y.toString());

    var tgl = new Date();
    var m = tgl.getMonth() + 1;
    if (m < 10) {
        $("#bulan").val("0" + m.toString());
    } else {
        $("#bulan").val(m.toString());
    }

    var d = tgl.getDate();
    if (d < 10) {
        $("#tanggal").val("0" + d.toString());
    } else {
        $("#tanggal").val(d.toString());
    }

    ajax_refresh();

    $("#tambah").click(function () {
        station_refresh();
    });

    $("#tambahwo").click(function () {
    	refresh_modal();
    });

    $("#tplus").click(function () {
        add($("#station").val(), $("#unit").val());
    });

    $("#sharewa").click(function(){
        share_wa();
    });

    function refresh_modal() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "wo/list_open/" + $("#pabrik").val(),
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
            var table = $('#dt-table-wo').DataTable({
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
                    add(sp[0],sp[1],sp[2],sp[3],sp[4]);
                    $('#modal-wo').modal('toggle');
                }
            });
        });
    }

    function share_wa() {

        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);

        var tanggal = $("#tanggal").val() +"-"+ $("#bulan").val() +"-"+ $("#tahun").val();

        var text_wa = "Plan Harian "+$("#pabrik").val()+"\n\n";
        text_wa += "Tanggal : " + tanggal;
        
    	text_wa += "\n" + "Planned Maintenance (PM) : Preventive (P) – Corrective (C) – Predictive (Pd)" + "\n";
        
        dx.forEach(element => {
            console.log(element);
            text_wa += "\n" + "Station : " + (element[1]);
            text_wa += "\n" + "Unit : " + (element[2]);
            text_wa += "\n" + "Sub Unit : " + (element[3]);
            text_wa += "\n" + "Problem\n - " + (element[4]);
            text_wa += "\n" + "Plan\n - " + (element[5]);
            text_wa += "\n" + "MPP : " + (element[6]);
            text_wa += "\n" + "Waktu : " + (element[9] + "-" + element[10]);
            text_wa += "\n" + "Tipe : " + (element[11]);
            text_wa += "\n";
        });        
        console.log(text_wa);
        // https://api.whatsapp.com/send?phone=91XXXXXXXXXX&text=urlencodedtext
        // var href = "https://api.whatsapp.com/send?text=" + encodeURI(text_wa);
        var href = "whatsapp://send?text=" + encodeURI(text_wa);
    	$("#sharewa").attr("target", "_blank");
        $("#sharewa").attr("href", href);
    }
});
