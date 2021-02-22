$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh(data) {

        $('#my-spreadsheet').html("");
        $('#my-spreadsheet').jexcel({
            data: data,
            allowInsertColumn: false,
            colHeaders: [
                'Equipment',
                'Lokasi',
                'Fase',
                'Titik Pengukuran',
                'Titik 1',
                'Titik 2',
                'Temp<br>(C)',
                'Resistance<br>(Ohm)',
                'Status',
            ],
            colWidths: [120, 250, 75 , 400, 250, 250, 75, 80, 75, 60, 60, 60, 60, 60, 60, 100],
            columns: [
                { type: 'text' },
                { type: 'text' , wordWrap: true },
                { type: 'dropdown', source: ['R', 'S', 'T', 'N', 'G'] },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ],
        });    
    }

    $("#tambah").click(function () {
        refresh_modal();
    });    

    function add(id, lo) {
        var sama = 0;
        var index = 0;
        loln = lo.replaceAll("|","\n");
        console.log(lo);console.log(loln);
        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        if (dx[0][0] == "") { // kosong
            dx[0][0] = id;
            dx[0][1] = loln;
        } else { // isi satu
            dx.push([id, loln]);
        }
        console.log(dx);
        refresh(dx);

        $("#wo").val("");
        $("#modal-j60").modal("hide");

        updatescroll();
    }

    function refresh_modal() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "attachment/list_attachment_modal/" + $("#pabrik").val() +"/J60",
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
            var table = $('#dt-table-j60').DataTable({
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
                    add(sp[0],sp[1]);
                    $('#modal-j60').modal('toggle');
                }
            });
        });
    }

    $("#pabrik").change(function () {
        station_refresh();
    });
    $("#station").change(function () {
        ajax_refresh();
    });
    // $("#tahun").change(function () {
    //     ajax_refresh();
    // });
    $("#bulan").change(function () {
        ajax_refresh();
    });
    $("#tanggal").change(function () {
        ajax_refresh();
    });

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"job_aid/j60/a9_save",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                // station: $("#station").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function station_refresh(){
        // $("#station").load(SITE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
        //     function(responseTxt,statusTxt,xhr){
        //         if(statusTxt == "success"){
        //             // alert("success");
        //             ajax_refresh();
        //         }else{
        //             // alert("gaagal");
        //         }
        //     }
        // );
    }

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "job_aid/j60/a9_load",
            data: {
                id_pabrik: $("#pabrik").val(),
                // id_station: $("#station").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log("ini ajax refresh");
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
    // var y = tgl.getFullYear();
    // $("#tahun").val(y.toString());
    var d = tgl.getDate();
    if (d < 10) {
        $("#tanggal").val("0" + d.toString());
    } else {
        $("#tanggal").val(d.toString());
    }

    station_refresh();
    ajax_refresh();
    // ajax_refresh();

});
