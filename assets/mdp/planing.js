$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    handler = function (obj, cell, val) {
        // console.log('My table id: ' + $(obj).prop('id'));
        // console.log('Cell changed: ' + $(cell).prop('id'));
        // console.log('Value: ' + val);

        // console.log(cell);
        // console.log(col);
        // console.log(row);
        cll = $(cell).prop('id');
        dd = cll.split("-");

        console.log(cll);
        console.log(dd);

        if (dd[0] == "9" || dd[0] == "10"){
            var roww = parseInt(dd[1]) + 1;

            var jstartx = "J"+roww;
            var jstopx  = "K"+roww;

            console.log(jstartx);
            console.log(jstopx);

            jstart = $("#my-spreadsheet").jexcel('getValue', jstartx);
            jstop = $("#my-spreadsheet").jexcel('getValue', jstopx);

            console.log(jstart);
            console.log(jstop);

            var t1 = jstart.split(":");
            var t2 = jstop.split(":");

            var min_1 = parseInt(t1[0]) * 60 + parseInt(t1[1]);
            var min_2 = parseInt(t2[0]) * 60 + parseInt(t2[1]);

            console.log((min_2-min_1));
        } 
    };
    
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
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                onchange: handler,
                colHeaders: [
                    'No WO',
                    'Station<br>Unit<br>Sub Unit',
                    // 'Unit',
                    // 'Sub Unit',
                    'Problem',
                    'Plan',
                    'MPP',
                    'Nama',
                    'Mek /<br>Elek',
                    'Jam<br>Start',
                    'Jam<br>Stop',
                    'Jam<br>Istirahat',
                    'PM',
                    'Ket',
                ],
                // colWidths: [150, 150, 150, 150, 200, 200, 40, 100, 60, 75, 75, 75, 100],
                colWidths: [140, 160, 200, 200, 40, 100, 60, 75, 75, 75, 75, 100],
                columns: [
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true, wordWrap: true },
                    { type: 'text' , wordWrap: true},
                    { type: 'text' , wordWrap: true},
                    { type: 'number' },
                    // { type: 'text' },
                    { type: 'autocomplete', url: BASE_URL + 'karyawan/ajax/' + $("#pabrik").val(),autocomplete:true, multiple:true},
                    { type: 'dropdown', source: ['M', 'E'] },
                    { type: 'text', mask: '##:##' },
                    { type: 'text', mask: '##:##' },
                    { type: 'number' },
                    { type: 'dropdown', source: ['Preventive', 'Predictive', 'Corrective', 'Unplan'] },
                    { type: 'text' },
                ],
            });
        }else{
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                onchange: handler,
                colHeaders: [
                    'No WO',
                    'Station<br>Unit<br>Sub Unit',
                    'Problem',
                    'Plan',
                    'MPP',
                    'Nama',
                    'Mek /<br>Elek',
                    'Jam<br>Start',
                    'Jam<br>Stop',
                    'Jam<br>Istirahat',
                    'PM',
                    'Ket',
                ],
                // colWidths: [150, 150, 150, 150, 200, 200, 40, 100, 60, 75, 75, 75, 100],
                colWidths: [140, 160, 200, 200, 40, 100, 60, 75, 75, 75, 75, 100],
                columns: [
                    { type: 'text', readOnly: true },
                    { type: 'text', readOnly: true ,wordWrap: true},
                    { type: 'text', wordWrap: true },
                    { type: 'text', wordWrap: true },
                    { type: 'number' },
                    { type: 'autocomplete', url: BASE_URL + 'karyawan/ajax/' + $("#pabrik").val(),autocomplete:true, multiple:true},
                    { type: 'dropdown', source: ['M', 'E'] },
                    { type: 'text', mask: '##:##' },
                    { type: 'text', mask: '##:##' },
                    { type: 'number'},
                    { type: 'dropdown', source: ['Preventive', 'Predictive', 'Corrective','Unplan'] },
                    { type: 'text' },
                ],
            });

        }
    }

    $("#pabrik").change(function () {
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
            dx[0][1] = sx + "\n" + ux + "\n" + su;
            // dx[0][2] = ux;
            // dx[0][3] = su;
            dx[0][2] = pb;

        } else { // isi satu
            dx.push([nw, sx+"\n"+ux+"\n"+su, pb, "", "", "", "", "", "", "", ""]);
        }

        refresh(dx);

        $("#wo").val("");
        $("#modal-default").modal("hide");

        updatescroll();
    }

    function updatescroll() {
        setTimeout(() => {
            var el = document.getElementById("scrll");
            el.scrollTop = el.scrollHeight;            
        }, 500);
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

    $("#download_plan").click(function () {
        // station_refresh();
        window.open(BASE_URL + "index.php/planing/download_plan_harian/" + $("#pabrik").val() + "/" + $("#tahun").val() + "/" + $("#bulan").val() + "/" + $("#tanggal").val());
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

    function get_category(jstart,jstop) {
        var t1 = jstart.split(":");
        var t2 = jstop.split(":");

        var min_1 = parseInt(t1[0]) * 60 + parseInt(t1[1]);
        var min_2 = parseInt(t2[0]) * 60 + parseInt(t2[1]);
        
        var min = min_2 - min_1;

        if(min<=60){
            return " *A* ";
        }else if(min<=120){
            return " *B* ";
        }else if(min>120){
            return " *C* ";
        }
    }

    function share_wa() {

        $('#my-spreadsheet').jexcel('orderBy', 5);

        dx = $('#my-spreadsheet').jexcel('getData');
        console.log(dx);

        var tanggal = $("#tanggal").val() +"-"+ $("#bulan").val() +"-"+ $("#tahun").val();

        var text_wa = "Plan Harian "+$("#pabrik").val()+"\n\n";
        text_wa += "Tanggal : " + tanggal;
        
        text_wa += "\n" + "Planned Maintenance (PM) : Preventive (P) – Corrective (C) – Predictive (Pd)" + "\n";
        
        text_wa_m = text_wa;

        // dx.forEach(element => {
        //     console.log(element);

        //     dt = element[1].split("\n");

        //     text_wa += "\n" + "Area : " + (dt[0]);
        //     if(dt[1]==dt[2]){
        //         text_wa += " - " + (dt[1]);
        //     }else{
        //         text_wa += " - " + (dt[1]);
        //         text_wa += " - " + (dt[2]);
        //     }
        //     text_wa += "\n" + "Problem\n - " + (element[2]);
        //     text_wa += "\n" + "Plan\n - " + (element[3]);
        //     text_wa += "\n" + "MPP : " + (element[4]) + " *" + (element[5]) + "*";
        //     text_wa += "\n" + "Waktu : " + get_category(element[7], element[8]) +" ("+ (element[7] + "-" + element[8]) + ")";
        //     text_wa += "\n" + "Tipe : " + (element[10]);
        //     text_wa += "\n";
        // });
        
        
        dt_mpp = "";

        i = 0;


        setTimeout(() => {
            dx.forEach(element => {
                console.log(element);

                dt = element[1].split("\n");

                if (dt_mpp != element[5]) {
                    text_wa_m += "\n" + "MPP: " + (element[4]) + " *" + (element[5]) + "* ";
                    dt_mpp = element[5];
                }

                if (dt[1] == dt[2]) {
                    text_wa_m += "\n  " + dt[0] + " | " + dt[1];
                } else {
                    text_wa_m += "\n  " + dt[0] + " | " + dt[1] + " | " + dt[2];
                }


                text_wa_m += "\n  Problem : " + element[2];
                text_wa_m += "\n  Plan : " + element[10] +" "+ get_category(element[7], element[8]) + " (" + (element[7] + " - " + element[8]) + ")" + "\n  " + element[3];
                text_wa_m += "\n";
            });

            dt_station = "";

            console.log(text_wa);

            console.log("\n\n");
            console.log(text_wa_m);

            $("#generatewa").text(text_wa_m);

        }, 15);


        // https://api.whatsapp.com/send?phone=91XXXXXXXXXX&text=urlencodedtext
        // var href = "https://api.whatsapp.com/send?text=" + encodeURI(text_wa);
        
        // var href = "whatsapp://send?text=" + encodeURI(text_wa);
        // $("#sharewa").attr("target", "_blank");
        // $("#sharewa").attr("href", href);
    }

    $("#bcopy").click(function () {
        $("#generatewa").select();
        document.execCommand("copy");
    });

    $("#bwaweb").click(function () {
        var text_wa = $("#generatewa").val();
        var href = "https://api.whatsapp.com/send?text=" + encodeURI(text_wa);
        $(this).attr("target", "_blank");
        $(this).attr("href", href);
    });

    $("#bwaapp").click(function () {
        var text_wa = $("#generatewa").val();
        var href = "whatsapp://send?text=" + encodeURI(text_wa);
        $(this).attr("target", "_blank");
        $(this).attr("href", href);
    });
});
