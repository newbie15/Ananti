$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    function station_refresh() {
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
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
        $("#unit").load(BASE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
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
        $("#sub_unit").load(BASE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()) + "/" + encodeURI($("#unit").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    // ajax_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function refresh(data){
        var nama_pt = $("#pabrik").val();
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        var tanggal = $("#tanggal").val();


        var no_wo = nama_pt+"-"+tahun+"-"+bulan+"-"+tanggal;

        var arr_no_wo = [];

        var no_last_wo = 1;
        var no_max_wo = no_last_wo+100;
        if(no_max_wo>9999){
            no_max_wo = 9999;
        }
        var j = 0;
        for(var i=no_last_wo;i<no_max_wo;i++){
            if(i<10){
                arr_no_wo[j++] = no_wo +"-0"+ i.toString();
            } else if (i < 100){
                arr_no_wo[j++] = no_wo + "-" + i.toString();
            }
            // } else if (i < 1000){
            //     arr_no_wo[j++] = no_wo + "-0" + i.toString();
            // }else{
            //     arr_no_wo[j++] = no_wo + "-" +i.toString();
            // }
        }

        handler = function (obj, cell, val) {
            console.log('My table id: ' + $(obj).prop('id'));
            console.log('Cell changed: ' + $(cell).prop('id'));
            console.log('Value: ' + val);

            // console.log(cell);
            // console.log(col);
            // console.log(row);
            cll = $(cell).prop('id');
            dd = cll.split("-");

            if(dd[0]=="8" && val == "close"){
                var roww = parseInt(dd[1])+1;
                var y = tgl.getFullYear();
                var m = tgl.getMonth() + 1;
                if (m < 10) {
                    m = ("0" + m.toString());
                }

                var d = tgl.getDate();
                if (d < 10) {
                    d = ("0" + d.toString());
                }

                roww = "J"+roww;
                console.log(d + "-" + m + "-" + y);
                // console.log(id);
                var vv = $("#my-spreadsheet").jexcel('getValue', roww);
                // console.log(vv);
                if (vv == "" || vv == "00-00-0000" || vv == "0000-00-00") {
                    // setTimeout(() => {
                    $("#my-spreadsheet").jexcel('setValue', roww, d + "-" + m + "-" + y);
                    // return;
                    // break table;                            
                    // }, 1000);
                }
            }




        };

        if (data == undefined){
            data = [];
        }

        $('#my-spreadsheet').jexcel({
            data: data,
            allowInsertColumn: false,
            onchange :handler,
            // colHeaders: ['Tanggal', 'No WO', 'Station', 'Equipment', 'Problem', 'Penjelasan<br>Masalah', 'HM', 'Kategori', 'status'],
            colHeaders: ['No WO', 'Station', 'Unit', 'Sub Unit', 'Problem', 'Keterangan', 'HM', 'Kategori', 'Status','Tanggal<br>Closing'],
            colWidths: [140, 140, 140, 140, 250, 250, 100, 75, 80, 80],
            columns: [
                { type: 'text', readOnly: true },
                { type: 'text', readOnly: true },
                { type: 'text', readOnly: true },
                { type: 'text', readOnly: true },
                // { type: 'calendar', option: { format: 'DD/MM/YYYY' } },                { type: 'text', readOnly: true },

                // { type: 'autocomplete', source: arr_no_wo },
                // { type: 'autocomplete', url: BASE_URL+'station/ajax/' + $("#pabrik").val() },
                // { type: 'autocomplete', url: BASE_URL+'unit/ajax/' + $("#pabrik").val() },
                // { type: 'text', wordWrap: true },
                { type: 'text', wordWrap: true },
                { type: 'text', wordWrap: true },
                { type: 'text' },
                { type: 'dropdown', source: ['plan', 'unplan'] },
                { type: 'dropdown', source: ['open', 'close'] },
                // { type: 'text' },
                { type: 'calendar', option: { format: 'DD/MM/YYYY HH24:MI', time: 1 } },
            ]
        });

        $('#my-spreadsheet').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col == 8) {
                    if (val == "open") {
                        $(cell).css('background-color', '#ff0000');
                    } else if (val == "close") {
                        $(cell).css('background-color', '#00ff00');
                    }
                }
            }
        });

    }

    $("#pabrik").change(function () {
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

    $("#station").change(function () {
        unit_refresh();
    });

    $("#unit").change(function () {
        sub_unit_refresh();
    });

    function add(no, sx, ux, su) {
        var sama = 0;
        var index = 0;
        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        if (dx[0][0] == "") { // kosong
            dx[0][0] = no;
            dx[0][1] = sx;
            dx[0][2] = ux;
            dx[0][3] = su;
        } else { // isi satu
            dx.push([no, sx, ux, su, "", "", "", "", "", "", "", "", ""]);
        }

        refresh(dx);

        // $("#wo").val("");
        $("#modal-default").modal("hide");
    }


    $("#simpan").click(function(){
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"wo/simpan",
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

    var tgl = new Date();
    var m = tgl.getMonth()+1;
    if(m<10){
        $("#bulan").val("0"+m.toString());
    }else{
        $("#bulan").val(m.toString());
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



    // var y = tgl.getFullYear();
    // $("#tahun").val(y.toString());

    var d = tgl.getDate();
    if (d < 10) {
        $("#tanggal").val("0" + d.toString());
    } else {
        $("#tanggal").val(d.toString());
    }

    // refresh();
    function ajax_refresh(){
        $.ajax({
            method: "POST",
            url: BASE_URL+"wo/load",
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
    }

    ajax_refresh();

    $("#tambah").click(function () {
        station_refresh();
        auto_wo_number();
    });

    $("#tplus").click(function () {
        // console.log($("#no_wo_auto").val()+"-"+$("#station").val()+"-"+$("#unit").val()+"-"+$("#sub_unit").val())
        add($("#no_wo_auto").val(), $("#station").val(), $("#unit").val(), $("#sub_unit").val());
    });

    function auto_wo_number(){
        var nama_pt = $("#pabrik").val();
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        var tanggal = $("#tanggal").val();

        var no_wo = nama_pt + "-" + tahun + "-" + bulan + "-" + tanggal;

        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);
        // if (dx[0][0] == "") { // kosong
        //     dx[0][0] = no;
        //     dx[0][0] = sx;
        //     dx[0][1] = ux;
        //     dx[0][2] = su;
        // } else { // isi satu
        console.log(dx.length);
        // if(dx.length){}
        var auto_number = null;
        var last = dx[dx.length-1][0];
        if(last == "" && dx.length == 1){
            auto_number = 1;
        }else if(last != ""){
            d = last.split("-");
            last_number = parseInt(d[4]);
            auto_number = last_number + 1;
        }
        if (auto_number < 10) {
            auto_number = "0" + auto_number;
        }

        no_wo += "-" + auto_number;

        $("#no_wo_auto").val(no_wo);
    }
});
