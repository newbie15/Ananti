$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    data_default = [
        ["Sebelum","",""],

        ["a) Isi dan tanda tangan personel terkait pada Pre-Job Hazard Analysis (PJHA)","",""],
        ["b) Personel sudah menggunakan PPE yang sesuai level fault","",""],
        ["c) Lock-Out/Tag Out (LOTO)","",""],
        ["d) Anda adalah teknisi elektrik yang telah di-training khusus terkait inspeksi ini","",""],
        ["e) Identifikasi kabel untuk memudahkan terminasi kembali setelah testing","",""],
        ["f) Kondisi sudah De-energized total (tidak ada arus listrik mengalir)/Terisolasi kedua sisi kabel","",""],
        ["g) Barier peringatan sudah terpasang di kedua sisi ujung kabel","",""],
        
        ["Sedang","",""],
        ["Informasi Kabel Aktual","",""],
        ["Kode Aset","",""],
        ["Tag Kabel","",""],
        ["Lokasi Sumber Kabel","",""],
        ["Tipe Kabel","",""],
        ["Tegangan Aktual","(V)",""],
        ["Panjang Kabel","(Meter)",""],
        ["Tegangan Kerja","",""],
        ["Merek Kabel","",""],
        ["Lokasi Terminasi Kabel","",""],
        ["Ukuran Kabel","(mm2)",""],
        ["Jumlah per phase","",""],

        ["Pengukuran Line R-Ground","",""],
        ["Insulation Resistance Menit 0.5","M Ohm",""],
        ["Insulation Resistance Menit 1","M Ohm",""],
        ["Insulation Resistance Menit 2","M Ohm",""],
        ["Insulation Resistance Menit 3","M Ohm",""],
        ["Insulation Resistance Menit 4","M Ohm",""],
        ["Insulation Resistance Menit 5","M Ohm",""],
        ["Insulation Resistance Menit 6","M Ohm",""],
        ["Insulation Resistance Menit 7","M Ohm",""],
        ["Insulation Resistance Menit 8","M Ohm",""],
        ["Insulation Resistance Menit 9","M Ohm",""],
        ["Insulation Resistance Menit 10","M Ohm",""],
        ["Polarisasi Index (PI 2) *IR10/IR1","",""],
        ["DAR *IR1/IR0.5","",""],
        ["Pengukuran Line S-Ground","",""],
        ["Insulation Resistance Menit 0.5","M Ohm",""],
        ["Insulation Resistance Menit 1","M Ohm",""],
        ["Insulation Resistance Menit 2","M Ohm",""],
        ["Insulation Resistance Menit 3","M Ohm",""],
        ["Insulation Resistance Menit 4","M Ohm",""],
        ["Insulation Resistance Menit 5","M Ohm",""],
        ["Insulation Resistance Menit 6","M Ohm",""],
        ["Insulation Resistance Menit 7","M Ohm",""],
        ["Insulation Resistance Menit 8","M Ohm",""],
        ["Insulation Resistance Menit 9","M Ohm",""],
        ["Insulation Resistance Menit 10","M Ohm",""],
        ["Polarisasi Index (PI 2) *IR10/IR1","",""],
        ["DAR *IR1/IR0.5 ","",""],
        ["Pengukuran Line T-Ground","",""],
        ["Insulation Resistance Menit 0.5","M Ohm",""],
        ["Insulation Resistance Menit 1","M Ohm",""],
        ["Insulation Resistance Menit 2","M Ohm",""],
        ["Insulation Resistance Menit 3","M Ohm",""],
        ["Insulation Resistance Menit 4","M Ohm",""],
        ["Insulation Resistance Menit 5","M Ohm",""],
        ["Insulation Resistance Menit 6","M Ohm",""],
        ["Insulation Resistance Menit 7","M Ohm",""],
        ["Insulation Resistance Menit 8","M Ohm",""],
        ["Insulation Resistance Menit 9","M Ohm",""],
        ["Insulation Resistance Menit 10","M Ohm",""],
        ["Polarisasi Index (PI 2) *IR10/IR1","",""],
        ["DAR *IR1/IR0.5 ","",""],

        ["Sesudah","",""],
        ["a) Pembatas atau peringatan bahaya sudah di amankan/kembalikan","",""],
        ["b) Kabel sudah dilepas jumpernya, diterminasi dan di kunci torsi ulang sesuai standar","",""],
        
    ];

    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh(data) {
        console.log("refresh data");
        console.log(data);
        if (data.length<1) {
            console.log("yes kurang dari 1");

            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data_default,
                allowInsertColumn: false,
                colHeaders: [
                    'Inspection Test',
                    'Satuan',
                    'Status / Nilai',
                ],
                colWidths: [800, 100, 200, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
            $('#my-spreadsheet').jexcel('setStyle', 
                [
                    { A1: 'font-weight: bold;background-color: yellow' }, 
                    { B1: 'font-weight: bold;background-color: yellow' }, 
                    { C1: 'font-weight: bold;background-color: yellow' }, 
                    { A2: 'text-align:left;' },
                    { A3: 'text-align:left;' },
                    { A4: 'text-align:left;' },
                    { A5: 'text-align:left;' },
                    { A6: 'text-align:left;' },
                    { A7: 'text-align:left;' },
                    { A8: 'text-align:left;' },
                    { A9: 'font-weight: bold;background-color: yellow' },
                    { B9: 'font-weight: bold;background-color: yellow' },
                    { C9: 'font-weight: bold;background-color: yellow' },
                    { A10: 'font-weight: bold;background-color: yellow' },
                    { B10: 'font-weight: bold;background-color: yellow' },
                    { C10: 'font-weight: bold;background-color: yellow' },
                    { A11: 'text-align:left;' },
                    { A12: 'text-align:left;' },
                    { A13: 'text-align:left;' },
                    { A14: 'text-align:left;' },
                    { A15: 'text-align:left;' },
                    { A16: 'text-align:left;' },
                    { A17: 'text-align:left;' },
                    { A18: 'text-align:left;' },
                    { A19: 'text-align:left;' },
                    { A20: 'text-align:left;' },
                    { A21: 'text-align:left;' },
                    { A22: 'font-weight: bold;background-color: yellow' },
                    { B22: 'font-weight: bold;background-color: yellow' },
                    { C22: 'font-weight: bold;background-color: yellow' },
                    { A23: 'text-align:left;' },
                    { A24: 'text-align:left;' },
                    { A25: 'text-align:left;' },
                    { A26: 'text-align:left;' },
                    { A27: 'text-align:left;' },
                    { A28: 'text-align:left;' },
                    { A29: 'text-align:left;' },
                    { A30: 'text-align:left;' },
                    { A31: 'text-align:left;' },
                    { A32: 'text-align:left;' },
                    { A33: 'text-align:left;' },
                    { A34: 'text-align:left;' },
                    { A35: 'text-align:left;' },
                    { A36: 'font-weight: bold;background-color: yellow' },
                    { B36: 'font-weight: bold;background-color: yellow' },
                    { C36: 'font-weight: bold;background-color: yellow' },
                    { A37: 'text-align:left;' },
                    { A38: 'text-align:left;' },
                    { A39: 'text-align:left;' },
                    { A40: 'text-align:left;' },
                    { A41: 'text-align:left;' },
                    { A42: 'text-align:left;' },
                    { A43: 'text-align:left;' },
                    { A44: 'text-align:left;' },
                    { A45: 'text-align:left;' },
                    { A46: 'text-align:left;' },
                    { A47: 'text-align:left;' },
                    { A48: 'text-align:left;' },
                    { A49: 'text-align:left;' },
                    { A50: 'font-weight: bold;background-color: yellow' },
                    { B50: 'font-weight: bold;background-color: yellow' },
                    { C50: 'font-weight: bold;background-color: yellow' },
                    { A51: 'text-align:left;' },
                    { A52: 'text-align:left;' },
                    { A53: 'text-align:left;' },
                    { A54: 'text-align:left;' },
                    { A55: 'text-align:left;' },
                    { A56: 'text-align:left;' },
                    { A57: 'text-align:left;' },
                    { A58: 'text-align:left;' },
                    { A59: 'text-align:left;' },
                    { A60: 'text-align:left;' },
                    { A61: 'text-align:left;' },
                    { A62: 'text-align:left;' },
                    { A63: 'text-align:left;' },
                    { A64: 'font-weight: bold;background-color: yellow' }, 
                    { B64: 'font-weight: bold;background-color: yellow' }, 
                    { C64: 'font-weight: bold;background-color: yellow' }, 
                    { A65: 'text-align:left;' },
                    { A66: 'text-align:left;' },

                ]
            );

        }else{
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                colHeaders: [
                    'Inspection Test',
                    'Satuan',
                    'Status / Nilai',
                ],
                colWidths: [800, 100, 200, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
            $('#my-spreadsheet').jexcel('setStyle', 
                [
                    { A1: 'font-weight: bold;background-color: yellow' }, 
                    { B1: 'font-weight: bold;background-color: yellow' }, 
                    { C1: 'font-weight: bold;background-color: yellow' }, 
                    { A2: 'text-align:left;' },
                    { A3: 'text-align:left;' },
                    { A4: 'text-align:left;' },
                    { A5: 'text-align:left;' },
                    { A6: 'text-align:left;' },
                    { A7: 'text-align:left;' },
                    { A8: 'text-align:left;' },
                    { A9: 'font-weight: bold;background-color: yellow' },
                    { B9: 'font-weight: bold;background-color: yellow' },
                    { C9: 'font-weight: bold;background-color: yellow' },
                    { A10: 'font-weight: bold;background-color: yellow' },
                    { B10: 'font-weight: bold;background-color: yellow' },
                    { C10: 'font-weight: bold;background-color: yellow' },
                    { A11: 'text-align:left;' },
                    { A12: 'text-align:left;' },
                    { A13: 'text-align:left;' },
                    { A14: 'text-align:left;' },
                    { A15: 'text-align:left;' },
                    { A16: 'text-align:left;' },
                    { A17: 'text-align:left;' },
                    { A18: 'text-align:left;' },
                    { A19: 'text-align:left;' },
                    { A20: 'text-align:left;' },
                    { A21: 'text-align:left;' },
                    { A22: 'font-weight: bold;background-color: yellow' },
                    { B22: 'font-weight: bold;background-color: yellow' },
                    { C22: 'font-weight: bold;background-color: yellow' },
                    { A23: 'text-align:left;' },
                    { A24: 'text-align:left;' },
                    { A25: 'text-align:left;' },
                    { A26: 'text-align:left;' },
                    { A27: 'text-align:left;' },
                    { A28: 'text-align:left;' },
                    { A29: 'text-align:left;' },
                    { A30: 'text-align:left;' },
                    { A31: 'text-align:left;' },
                    { A32: 'text-align:left;' },
                    { A33: 'text-align:left;' },
                    { A34: 'text-align:left;' },
                    { A35: 'text-align:left;' },
                    { A36: 'font-weight: bold;background-color: yellow' },
                    { B36: 'font-weight: bold;background-color: yellow' },
                    { C36: 'font-weight: bold;background-color: yellow' },
                    { A37: 'text-align:left;' },
                    { A38: 'text-align:left;' },
                    { A39: 'text-align:left;' },
                    { A40: 'text-align:left;' },
                    { A41: 'text-align:left;' },
                    { A42: 'text-align:left;' },
                    { A43: 'text-align:left;' },
                    { A44: 'text-align:left;' },
                    { A45: 'text-align:left;' },
                    { A46: 'text-align:left;' },
                    { A47: 'text-align:left;' },
                    { A48: 'text-align:left;' },
                    { A49: 'text-align:left;' },
                    { A50: 'font-weight: bold;background-color: yellow' },
                    { B50: 'font-weight: bold;background-color: yellow' },
                    { C50: 'font-weight: bold;background-color: yellow' },
                    { A51: 'text-align:left;' },
                    { A52: 'text-align:left;' },
                    { A53: 'text-align:left;' },
                    { A54: 'text-align:left;' },
                    { A55: 'text-align:left;' },
                    { A56: 'text-align:left;' },
                    { A57: 'text-align:left;' },
                    { A58: 'text-align:left;' },
                    { A59: 'text-align:left;' },
                    { A60: 'text-align:left;' },
                    { A61: 'text-align:left;' },
                    { A62: 'text-align:left;' },
                    { A63: 'text-align:left;' },
                    { A64: 'font-weight: bold;background-color: yellow' }, 
                    { B64: 'font-weight: bold;background-color: yellow' }, 
                    { C64: 'font-weight: bold;background-color: yellow' }, 
                    { A65: 'text-align:left;' },
                    { A66: 'text-align:left;' },

                ]
            );
        }
    }

    // $('#equipment').select2();

    $("#pabrik").change(function () {
        equipment_refresh();
    });
    $("#equipment").change(function () {
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
            url: SITE_URL+"job_aid/j60/a8_save",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                equipment: $("#equipment").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function equipment_refresh(){
        $("#equipment").load(SITE_URL + "attachment/list_attachment_dropdown/" + $("#pabrik").val() + "/J60/",
            function(responseTxt,statusTxt,xhr){
                if(statusTxt == "success"){
                    // alert("success");
                    ajax_refresh();
                }else{
                    // alert("gaagal");
                }
            }
        );
    }

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "job_aid/j60/a8_load",
            data: {
                id_pabrik: $("#pabrik").val(),
                equipment: $("#equipment").val(),
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

    equipment_refresh();
    ajax_refresh();
    // ajax_refresh();

});
