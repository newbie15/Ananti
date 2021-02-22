$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    data_default = [
        ["Sebelum","",""],
        ["a) Personel sudah menggunakan PPE yang sesuai level fault","",""],
        ["b) Isi dan tanda tangan personel terkait pada Pre-Job Hazard Analysis (PJHA)","",""],
        ["c) Anda adalah teknisi elektrik yang telah di-training khusus terkait inspeksi ini","",""],
        ["d) Personel tidak masuk pada zona live working","",""],
        ["e) Alat kerja yang dibutuhkan dalam kondisi baik dan lengkap (Kamera, senter)","",""],
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

        ["a) Tidak ada kerusakan secara fisik (mengelupas, berjamur, perubahan warna)","",""],
        ["b) Tidak ada kerusakan secara mekanik (perubahan bentuk, Bergeser dari rack)","",""],
        ["c) Data kabel sesuai dengan drawing dan spesifikasi","",""],
        ["d) Ukuran Lug/Schoen sama dengan ukuran kabel","",""],
        ["e) Minimum Tekukan/Bend kabel aktual sudah sesuai standar","",""],
        ["f) Intalasi melewati tembok memiliki Fire proof minimal sama dengan fire rating dari tembok ","",""],
        ["g) Terdapat tape (code) pada tiap phase dan sesuai dengan kedua ujungnya","",""],
        ["h) Kondisi jaket dan kondisi insulasi  keadaan baik (lakukan jika memungkinkan)","",""],
        ["Sesudah","",""],
        ["a)Foto temuan defect sudah lengkap sesuai jumlah","",""],
        

        // ["a) Tidak ada kerusakan secara fisik (mengelupas, berjamur, perubahan warna)","",""],
        // ["b) Tidak ada kerusakan secara mekanik (perubahan bentuk, Bergeser dari rack)","",""],
        // ["c) Data kabel sesuai dengan drawing dan spesifikasi","",""],
        // ["d) Ukuran Lug/Schoen sama dengan ukuran kabel","",""],
        // ["e) Terdapat indikasi Corona pada terminasi","",""],
        // ["f) Shield grounding terkoneksi","",""],
        // ["g) Minimum Tekukan/Bend kabel aktual","",""],
        // ["h) Kabel support lengkap dan tidak ada kabel menggantung bebas","",""],
        // ["i) Intalasi melewati tembok memiliki Fire proof minimal sama dengan fire rating dari tembok","",""],
        // // ["fire rating dari tembok","",""],
        // ["j) Rute shield koneksinya tidak melewati window/loop (seperti pada lubang CT)","",""],
        // ["k) Terdapat tape (code) pada tiap phase","",""],
        // ["l) Kondisi jaket dan kondisi insulasi  keadaan baik (lakukan jika memungkinkan)","",""],
        // ["m) Terdapat kontaminasi, debu, perubahan warna pada Stress Cone dan Insulator Pin","",""],
        // // ["Insulator Pin","",""],
        // ["n) Tidak ada kerusakan pada stress cone dan Bushing Boot/pelindung","",""],
        // ["Sesudah","",""],
        // ["a) Foto temuan defect sudah lengkap sesuai jumlah","",""],

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
                    { A7: 'font-weight: bold;background-color: yellow' },
                    { B7: 'font-weight: bold;background-color: yellow' },
                    { C7: 'font-weight: bold;background-color: yellow' },
                    { A8: 'font-weight: bold;background-color: yellow' },
                    { B8: 'font-weight: bold;background-color: yellow' },
                    { C8: 'font-weight: bold;background-color: yellow' },
                    { A9: 'text-align:left;' },
                    { A10: 'text-align:left;' },
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
                    { A22: 'text-align:left;' },
                    { A23: 'text-align:left;' },
                    { A24: 'text-align:left;' },
                    { A25: 'text-align:left;' },
                    { A26: 'text-align:left;' },
                    { A27: 'text-align:left;' },
                    { A28: 'font-weight: bold;background-color: yellow' },
                    { B28: 'font-weight: bold;background-color: yellow' },
                    { C28: 'font-weight: bold;background-color: yellow' },
                    { A29: 'text-align:left;' },
                    { A30: 'text-align:left;' },
                    { A31: 'text-align:left;' },
                    { A32: 'text-align:left;' },
                    { A33: 'text-align:left;' },
                    // { A34: 'text-align:left;' },
                    { A34: 'font-weight: bold;background-color: yellow' },
                    { B34: 'font-weight: bold;background-color: yellow' },
                    { C34: 'font-weight: bold;background-color: yellow' },
                    { A35: 'text-align:left;' },
                    { A36: 'text-align:left;' },
                    { A37: 'text-align:left;' },
                    { A38: 'text-align:left;' },
                    { A39: 'text-align:left;' },
                    { A40: 'text-align:left;' },
                    { A41: 'text-align:left;' },
                    { A42: 'text-align:left;' },
                    { A43: 'text-align:left;' },
                    { A44: 'text-align:left;' },

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
                    { A7: 'font-weight: bold;background-color: yellow' },
                    { B7: 'font-weight: bold;background-color: yellow' },
                    { C7: 'font-weight: bold;background-color: yellow' },
                    { A8: 'font-weight: bold;background-color: yellow' },
                    { B8: 'font-weight: bold;background-color: yellow' },
                    { C8: 'font-weight: bold;background-color: yellow' },
                    { A9: 'text-align:left;' },
                    { A10: 'text-align:left;' },
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
                    { A22: 'text-align:left;' },
                    { A23: 'text-align:left;' },
                    { A24: 'text-align:left;' },
                    { A25: 'text-align:left;' },
                    { A26: 'text-align:left;' },
                    { A27: 'text-align:left;' },
                    { A28: 'font-weight: bold;background-color: yellow' },
                    { B28: 'font-weight: bold;background-color: yellow' },
                    { C28: 'font-weight: bold;background-color: yellow' },
                    { A29: 'text-align:left;' },
                    { A30: 'text-align:left;' },
                    { A31: 'text-align:left;' },
                    { A32: 'text-align:left;' },
                    { A33: 'text-align:left;' },
                    // { A34: 'text-align:left;' },
                    { A34: 'font-weight: bold;background-color: yellow' },
                    { B34: 'font-weight: bold;background-color: yellow' },
                    { C34: 'font-weight: bold;background-color: yellow' },
                    { A35: 'text-align:left;' },
                    { A36: 'text-align:left;' },
                    { A37: 'text-align:left;' },
                    { A38: 'text-align:left;' },
                    { A39: 'text-align:left;' },
                    { A40: 'text-align:left;' },
                    { A41: 'text-align:left;' },
                    { A42: 'text-align:left;' },
                    { A43: 'text-align:left;' },
                    { A44: 'text-align:left;' },

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
            url: SITE_URL+"job_aid/j61/a0a1_save",
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
        $("#equipment").load(SITE_URL + "attachment/list_attachment_dropdown/" + $("#pabrik").val() + "/J61/",
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
            url: SITE_URL + "job_aid/j61/a0a1_load",
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
