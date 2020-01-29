$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    dx = [];
    data = [];
    data_detail = {};
    keterangan_detail = [];
    data_detailnya = "";
    no_wo_aktif = "";

    data_sparepart = {};
    data_sparepartnya = "";

    function add(no) {
        var sama = 0;
        var index = 0;
        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        dx.forEach(element => {
            if (no == element[0]) {
                sama = 1;
            }
            index++;
        });
        $("#wo").val("");
        if (sama == 0) {
            if(dx.length==1){
                if(dx[0][0]==""){ // kosong
                    dx[0][0] = no;
                }else{ // isi satu
                    dx.push([no, "", "", ""]);
                }
            }else{ // isi lebih dari 1
                dx.push([no, "", "", ""]);
            }
            refresh(dx);
        }
        $("#wo").val("");
    }

    function refresh_modal(){
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
            var table = $('#dt-table').DataTable({
                destroy: true,
                data: y,
                columns: [
                    { title: "Daftar" },
                ]
            });

            $('.dataTable tbody').on('click', 'tr', function () {
                if (table.row(this).data()!=undefined){
                    console.log('API row values : ', table.row(this).data());
                    var sp = table.row(this).data();
                    sp = sp[0].split(" - ");
                    add(sp[0]);
                    $('#modal-default').modal('toggle');
                }
            });
        });
    }

    function detail_refresh(no) {
        if (keterangan_detail[no] == undefined) {
            console.log("g ada");
            $.ajax({
                method: "POST",
                url: BASE_URL + "wo/detail_wo/" + no,
            }).done(function (msg) {
                console.log(msg);
                data = JSON.parse(msg);
                console.log(data);
                // refresh(data);
                var t = "";
                t += "<strong>Station :</strong> " + data['station'] + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                t += "<strong>Unit :</strong> " + data['unit'] + "<br>";
                t += "Problem : " + data['problem'] + "<br>";
                t += "Desc Problem : " + data['desc_masalah'] + "<br>";
                $("#keterangan").html(t);
                keterangan_detail[no] = t;
            });
        } else {
            $("#keterangan").html(keterangan_detail[no]);
            console.log("ada");
        }


        if(data_detail[no_wo_aktif]==undefined){
            data_detail[no_wo_aktif] = [["","","",""]];
            data_detailnya = data_detail[no_wo_aktif]; 
        }else{
            data_detailnya = data_detail[no_wo_aktif];
        }

        if (data_sparepart[no_wo_aktif] == undefined) {
            data_sparepart[no_wo_aktif] = [["", ""]];
            data_sparepartnya = data_sparepart[no_wo_aktif];
        } else {
            data_sparepartnya = data_sparepart[no_wo_aktif];
        }

        $('#my-spreadsheet2').jexcel({
            allowInsertColumn: false,
            data: data_detailnya,
            allowInsertColumn: false,
            onchange: handler,
            colHeaders: [
                'Nama Teknisi',
                'Target<br>Jam<br>Mulai',
                'Target<br>Jam<br>Selesai',
                'Real<br>Jam<br>Mulai',
                'Real<br>Jam<br>Selesai',
                'Durasi',
            ],
            colWidths: [150, 50, 53, 50, 53, 100, 75, 80, 80],
            columns: [
                { type: 'autocomplete', url: BASE_URL + 'karyawan/ajax/' + $("#pabrik").val() },
                { type: 'text', mask: '##:##' },
                { type: 'text', mask: '##:##' },
                { type: 'text', mask: '##:##' },
                { type: 'text', mask: '##:##' },
                { type: 'text' },
            ]
        });

        $('#my-spare').jexcel({
            allowInsertColumn: false,
            data: data_sparepartnya,
            allowInsertColumn: false,
            onchange: handlers,
            colHeaders: [
                'Nama Sparepart / Material',
                'Qty',
            ],
            colWidths: [400, 50, 53, 50, 53, 100, 75, 80, 80],
            columns: [
                { type: 'text' },
                { type: 'text' },
            ]
        });

    }

    function refresh(data) {
        handlers = function (obj, cell, val) {
            data_sparepart[no_wo_aktif] = $('#my-spare').jexcel('getData');
        };

        handler = function (obj, cell, val) {
            data_detail[no_wo_aktif] = $('#my-spreadsheet2').jexcel('getData');

            pos = $(cell).prop('id').split("-");

            console.log(pos);

            dt_start = data_detail[no_wo_aktif][pos[1]][3];
            dt_stop = data_detail[no_wo_aktif][pos[1]][4];

            if(dt_start!="" && dt_stop!="" && (pos[0]==3 || pos[0]==4)){
                var date1 = new Date("08/05/2015 "+ dt_start+":00");
                var date2 = new Date("08/05/2015 "+ dt_stop +":00");

                var diff = date2.getTime() - date1.getTime();
                if(diff<0){
                    date2 = new Date("08/06/2015 " + dt_stop + ":00");
                    diff = date2.getTime() - date1.getTime();
                }

                console.log("diff ="+diff);
                var msec = diff;
                var hh = Math.floor(msec / 1000 / 60 / 60);
                console.log(hh);
                msec -= hh * 1000 * 60 * 60;
                var mm = Math.floor(msec / 1000 / 60);
                console.log(mm);
                msec -= mm * 1000 * 60;
                var ss = Math.floor(msec / 1000);
                msec -= ss * 1000;
                hour = "";
                min = "";

                if (hh < 10) { hour = "0" + hh.toString(); } else { hour = hh.toString(); }
                if (mm < 10) { min = "0" + mm.toString(); } else { min = mm.toString(); }

                console.log(hour + ':' + min);
                console.log(hh + ':' + mm);

                $("#my-spreadsheet2").jexcel('setValue', 'F' + (parseInt(pos[1])+1).toString() ,hour+':'+min);
            }

        };

        selection = function (obj, cell, val) {
            var pos = $(cell).prop('id').split("-");

            console.log('Cell select: ' + $(cell).prop('id'));
            var value = pos[1];
            var data = $("#my-spreadsheet").jexcel('getRowData', value)
            console.log(data);
            if(data[0]!=""){
                $("#side-note").show();
                no_wo_aktif = data[0];
                detail_refresh(no_wo_aktif);
            }else{
                console.log("kosong");
                $("#side-note").hide();
            }
        }

        if (data == undefined) {
            data = [];
        }

        $('#my-spreadsheet').jexcel({
            data: data,
            allowInsertColumn: false,
            colHeaders: [
                'No WO',
                'Perbaikan',
                'Jenis<br>Kerusakan',
                'Jenis<br>Problem'
            ],
            colWidths: [160, 230, 110, 65, 50, 100, 60, 100, 100],
            columns: [
                { type: 'autocomplete', url: BASE_URL+'wo/ajax/open/' + $("#pabrik").val() },
                { type: 'text', wordWrap: true },
                { type: 'dropdown', source: ['PCM','UPCM','breakdown unit', 'breakdown line', 'breakdown pabrik'] },
                { type: 'dropdown', source: ['alat', 'proses'] },
            ],
            // onfocus: selection,
            onselection:selection,
        });
        detail_refresh();
    }


    $("#pabrik").change(function () {
        refresh_modal();
        ajax_refresh();
        $("#side-note").hide();
    });

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

        // graph_refresh();
        // refresh();

        ajax_refresh();
        $("#side-note").hide();


    });



    // $("#tahun").change(function () {
    //     ajax_refresh();
    //     $("#side-note").hide();
    // });

    $("#bulan").change(function () {
        ajax_refresh();
        $("#side-note").hide();
    });
    $("#tanggal").change(function () {
        ajax_refresh();
        $("#side-note").hide();
    });

    $("#wo").keydown(function (e) {
        if (e.which == 13 && $(this).val() != "") {
            var t = $(this).val();
            $(this).val("");
            var x = t.split(" - ");
            console.log(x.length);
            console.log(t);
            add(x[0]);
        }
    });

    $("#tambah").click(function(){
        if ($("#wo").val()!=""){
            var t = $("#wo").val().split(' - ');
            add(t[0]);
            console.log(t[0]);
        }
    });

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);
        console.log(JSON.stringify(data_detail));

        $.ajax({
            method: "POST",
            success: sukses,
            url: BASE_URL+"activity/simpan",
            data: {
                pabrik: $("#pabrik").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
                detail: JSON.stringify(Object.assign({}, data_detail)),
                sparepart: JSON.stringify(Object.assign({}, data_sparepart)),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function ajax_refresh() {

        $.ajax({
            method: "POST",
            url: BASE_URL + "activity/load",
            data: {
                id_pabrik: $("#pabrik").val(),
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

        $.ajax({
            method: "POST",
            url: BASE_URL + "activity/load_detail",
            data: {
                id_pabrik: $("#pabrik").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log("detail");
            data = JSON.parse(msg);
            console.log(data_detail);
            data_detail = data;
            console.log(data_detail);

        });

        $.ajax({
            method: "POST",
            url: BASE_URL + "activity/load_sparepart",
            data: {
                id_pabrik: $("#pabrik").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
            }
        }).done(function (msg) {
            data = JSON.parse(msg);
            console.log(data_sparepart);
            data_sparepart = data;
            console.log(data_sparepart);
        });
    }

    var tgl = new Date();
    var m = tgl.getMonth() + 1;
    if (m < 10) {
        $("#bulan").val("0" + m.toString());
    } else {
        $("#bulan").val(m.toString());
    }
    // var tgl = new Date();
    var y = tgl.getFullYear();

    var shtml = null; //"<option>"++"</option>"
    var start_year = y - 2;
    var stop_year = y + 2;
    for (var i = start_year; i <= stop_year; i++) {
        shtml += "<option>" + i + "</option>";
    }
    $("#tahun").html(shtml);
    $("#tahun").val(y.toString());

    var d = tgl.getDate();
    if (d < 10) {
        $("#tanggal").val("0" + d.toString());
    } else {
        $("#tanggal").val(d.toString());
    }

    $("#side-note").hide();

    ajax_refresh();
    refresh_modal();
});
