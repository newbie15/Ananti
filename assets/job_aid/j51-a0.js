$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    data_default = [
        ["Sebelum","",""],

        ["a) Memiliki manual testing dan instruksi dari pabrikan (OEM)","",""],
        ["b) Anda adalah teknisi elektrik yang telah di-training khusus terkait inspeksi ini","",""],
        ["c) Isi dan tanda tangan personel terkait pada Pre-Job Hazard Analysis (PJHA)","",""],
        ["d) Personel sudah menggunakan PPE yang sesuai ","",""],
        ["e) Alat kerja yang dibutuhkan dalam kondisi baik dan lengkap","",""],
        
                
        ["Sedang","",""],

        ["Informasi Generator","",""],
        ["Kode Aset","",""],
        ["Tag Name","",""],
        ["Maker/Brand","",""],
        ["Type/Model","",""],

        ["a) Tidak terdapat tanda/bukti kelembapan/basah pada generator","",""],
        ["b) Tidak terdapat tanda/bukti penumpukan kotoran pada generator","",""],
        ["c) konduit dan kotak terminal Generator tidak keadaan rusak atau kendor ","",""],
        ["d) Pemeriksaan kabel gland  dalam keadaan terpasang dan kencang","",""],
        ["e) Kotak terminal Generator tertutup dengan baik dan semua baut lengkap","",""],
        ["f) Gasket pada kotak terminal Generator tidak ada kerusakan","",""],
        ["g) lubang udara (pada kipas Generator) tidak terhalang/tersumbat","",""],
        ["h) tidak ada suara-suara yang tidak biasa ","",""],
        ["i) Apakah ada Vibrasi Generator yang tidak biasa","",""],
        ["j) Tidak ada kebocoran oli di sekitar seal","",""],
        ["k) Level Oli pada sight glass","",""],
        ["l) Tidak terdapat perubahan warna Oli","",""],
        ["m) Tidak terdapat kontaminasi Oli","",""],
        ["n) grouting dan base  menyatu dengan baik","",""],
        ["o) Strap bonding lokal dalam keadaan baik","",""],
        ["p) Name plate terpasang pada generator dan data masih bisa terbaca","",""],
        ["q) TAG generator terpasang dengan benar sesuai tempat","",""],
        ["r) Kotak terminal/koneksi tidak membahayakan","",""],
        
        ["Sesudah","",""],
        ["a) Foto temuan defect sudah lengkap sesuai jumlah","",""],

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
                colWidths: [650,100,300],
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
                    { A8: 'text-align:left; font-weight: bold;background-color: yellow' },
                    { B8: 'text-align:left; font-weight: bold;background-color: yellow' },
                    { C8: 'text-align:left; font-weight: bold;background-color: yellow' },
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
                    { A28: 'text-align:left;' },
                    { A29: 'text-align:left;' },
                    { A30: 'text-align:left;' },
                    { A31: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B31: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C31: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A32: 'text-align:left;' },
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
                colWidths: [650,100,300],
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
                    { A8: 'text-align:left; font-weight: bold;background-color: yellow' },
                    { B8: 'text-align:left; font-weight: bold;background-color: yellow' },
                    { C8: 'text-align:left; font-weight: bold;background-color: yellow' },
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
                    { A28: 'text-align:left;' },
                    { A29: 'text-align:left;' },
                    { A30: 'text-align:left;' },
                    { A31: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B31: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C31: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A32: 'text-align:left;' },
                ]
            );
        }
    }

    $("#pabrik").change(function () {
        equipment_refresh();
    });
    $("#station").change(function () {
        equipment_refresh();
    });
    $("#equipment").change(function () {
        ajax_refresh();
    });
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
            url: SITE_URL+"job_aid/j51/a0_save",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
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
        $("#equipment").load(SITE_URL + "attachment/list_attachment_dropdown/" + $("#pabrik").val() + "/J51/",
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
            url: SITE_URL + "job_aid/j51/a0_load",
            data: {
                id_pabrik: $("#pabrik").val(),
                // id_station: $("#station").val(),
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
