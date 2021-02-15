$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh(data,data2,data3) {

        $('#my-spreadsheet').jexcel({
            data: data,
            allowInsertColumn: false,
            colHeaders: [
                'Nametag<br>Breaker',
                'Lokasi<br>Panel',
                'Tegangan<br>Nominal',
                'Humidity<br>(RH)',
                'Temp<br>(C)',
                'R-S',
                'S-T',
                'T-R',
                'R-E',
                'S-E',
                'T-E',
                'STD<br>Aman',
                'Status',
            ],
            colWidths: [150, 400, 100, 75, 75, 60, 60, 60, 60, 60, 60, 60, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'dropdown', source: ["<=250","251-1K","1K-2.5K","2.5K-5K","5K-8K","8K-15K","15K-25K","25K-34.5K",">34.5K"] },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },

            ],
        });

        $('#my-spreadsheet2').jexcel({
            data: data2,
            allowInsertColumn: false,
            colHeaders: [
                'Nametag<br>Breaker',
                'Lokasi<br>Panel',
                'Tegangan<br>Nominal',
                'Humidity<br>(RH)',
                'Temp<br>(C)',
                'R-S',
                'S-T',
                'T-R',
                'R-E',
                'S-E',
                'T-E',
                'STD<br>Aman',
                'Status',
            ],
            colWidths: [150, 400, 100, 75, 75, 60, 60, 60, 60, 60, 60, 60, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'dropdown', source: ["<=250","251-1K","1K-2.5K","2.5K-5K","5K-8K","8K-15K","15K-25K","25K-34.5K",">34.5K"] },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },

            ],
        });

        $('#my-spreadsheet3').jexcel({
            data: data3,
            allowInsertColumn: false,
            colHeaders: [
                'Nametag<br>Breaker',
                'Lokasi<br>Panel',
                'Tegangan<br>Nominal',
                'Humidity<br>(RH)',
                'Temp<br>(C)',
                'R-S',
                'S-T',
                'T-R',
                'R-E',
                'S-E',
                'T-E',
                'STD<br>Aman',
                'Status',
            ],
            colWidths: [150, 400, 100, 75, 75, 60, 60, 60, 60, 60, 60, 60, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'dropdown', source: ["<=250","251-1K","1K-2.5K","2.5K-5K","5K-8K","8K-15K","15K-25K","25K-34.5K",">34.5K"] },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
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

    function add(id, lo, id2, lo2, id3, lo3) {
        var sama = 0;
        var index = 0;
        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        if (dx[0][0] == "") { // kosong
            dx[0][0] = id;
            dx[0][1] = lo;
        } else { // isi satu
            dx.push([id , lo, "", "", "", ""]);
        }

        dx2 = $('#my-spreadsheet2').jexcel('getData');
        console.log(dx);
        if (dx2[0][0] == "") { // kosong
            dx2[0][0] = id2;
            dx2[0][1] = lo2;
        } else { // isi satu
            dx2.push([id2 , lo2, "", "", "", ""]);
        }

        dx3 = $('#my-spreadsheet3').jexcel('getData');
        console.log(dx);
        if (dx3[0][0] == "") { // kosong
            dx3[0][0] = id3;
            dx3[0][1] = lo3;
        } else { // isi satu
            dx3.push([id3 , lo3, "", "", "", ""]);
        }

        refresh(dx,dx2,dx3);

        $("#wo").val("");
        $("#modal-j9").modal("hide");

        updatescroll();
    }

    function refresh_modal() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "attachment/list_attachment_modal/" + $("#pabrik").val() +"/J9",
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
            var table = $('#dt-table-j9').DataTable({
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
                    add(sp[0],sp[1],sp[0],sp[1],sp[0],sp[1]);
                    $('#modal-j9').modal('toggle');
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
        var data_j2 = $('#my-spreadsheet2').jexcel('getData');
        var data_j3 = $('#my-spreadsheet3').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"job_aid/j9/a8_save",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
                data_json2: JSON.stringify(data_j2),
                data_json3: JSON.stringify(data_j3),
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
                    ajax_refresh();
        //         }else{
        //             // alert("gaagal");
        //         }
        //     }
        // );
    }

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "job_aid/j9/a8_load",
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
            x = JSON.parse(msg);
            console.log(data);
            refresh(x[0],x[1],x[2]);
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
