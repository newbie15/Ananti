$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    data_default = [
        ["Sebelum","",""],
        ["a) Isi dan tanda tangan personel terkait pada Pre-Job Hazard Analysis (PJHA)","",""],
        ["b) Anda adalah teknisi elektrik yang telah di-training khusus terkait inspeksi ini","",""],
        ["c) Memiliki manual testing dan instruksi dari pabrikan (OEM) ","",""],
        ["d) Personel sudah menggunakan PPE yang sesuai level fault","",""],
        ["e) Alat Kerja Lengkap (Senter, Kamera digital, Drawing dan System Study)","",""],
                
        ["Sedang","",""],
        ["Kode Aset","",""],
        ["Tegangan Nominal (V)","",""],
        ["Frekuensi Nominal (Hz)","",""],
        ["Inspection","",""],
        ["Tegangan (Fase R)","Volt",""],
        ["Tegangan (Fase S)","Volt",""],
        ["Tegangan (Fase T)","Volt",""],
        ["Arus (Fase R)","Ampere",""],
        ["Arus (Fase S)","Ampere",""],
        ["Arus (Fase T)","Ampere",""],
        ["KW","",""],
        ["THD V","",""],
        ["THD I","",""],
        ["KWH","",""],
        ["Frekuensi (Hz)","",""],
        ["PF","",""],
        ["Angkur panel dalam keadaan baik","",""],
        ["Alignment panel dalam keadaan baik","",""],
        ["Clearance/Jarak panel keadaan baik","",""],
        ["Filter fan lengkap kondisi terpasang, lubang ventilasi tidak terhalang/bersih","",""],
        ["Kondisi fisik dan mekanik lengkap dan baik","",""],
        ["Switchgear/Switchboard tersambung pada grounding busbar dan Konduktor PE dari kabel pendulang","",""],
        ["Tidak ada koneksi antara PE dan N (N tersambung N, dan PE dengan PE)","",""],
        ["Ukuran Fuse dan Breaker  sudah sesuai Drawing","",""],
        ["Ukuran Fuse dan Breaker  sudah sesuai System Study (coordination study)","",""],
        ["Kompartemen heater dan Kipas dapat di operasikan dan berfungsi dengan baik","",""],
        ["Tidak terdapatnya tanda memburuknya  pada kabel dan komponen kelistrikan lain di dalam panel (contoh kontak terminal berubah warna, dll)","",""],
        ["Tidak terdapatnya tanda overheat pada kabel dan komponen kelistrikan lain di dalam panel","",""],
        ["Hasil pengecekan terhadap indikator peralatan proteksi, fuse putus atau indikator peringatan/trip alarm","",""],
        ["Label identifikasi panel dan Label peringatan sesuai standard terpasang sesuai standard lokal dan kebijakan perusahaan/korporasi","",""],
        ["Tegangan","",""],
        ["Maksimal  ketidakseimbangan Tegangan (V)","",""],
        ["Tegangan Rata-Rata (V)","",""],
        ["% dari tegangan Nominal","",""],
        ["% ketidakseimbangan tegangan ","",""],
        ["Arus","",""],
        ["Maksimal ketidakseimbangan Arus (A)","",""],
        ["Arus Rata-Rata (A)","",""],
        ["% ketidakseimbangan Arus","",""],
        ["Frekuensi","",""],
        ["% dari frekuensi Nominal","",""],
        ["THD","",""],
        ["THD V (%)","",""],
        ["THD I (%)","",""],
                
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
                    'Status',
                ],
                colWidths: [850,100,100],
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
                    { A8: 'text-align:left;' },
                    { A9: 'text-align:left;' },
                    { A10: 'text-align:left;' },
                    { A11: 'font-weight: bold;background-color: yellow' },
                    { B11: 'font-weight: bold;background-color: yellow' },
                    { C11: 'font-weight: bold;background-color: yellow' },
                    { A12: 'text-align:left;' },
                    { A13: 'text-align:left;' },
                    { A14: 'text-align:left;' },
                    { A15: 'text-align:left;' },
                    { A16: 'text-align:left;' },
                    // { A16: 'text-align:left;font-weight: bold;background-color: yellow' },
                    // { B16: 'text-align:left;font-weight: bold;background-color: yellow' },
                    // { C16: 'text-align:left;font-weight: bold;background-color: yellow' },
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
                    { A31: 'text-align:left;' },
                    { A32: 'text-align:left;' },
                    { A33: 'text-align:left;' },
                    { A34: 'text-align:left;' },
                    { A35: 'text-align:left;' },
                    { A36: 'text-align:left;' },
                    { A37: 'text-align:left;' },
                    // { A38: 'text-align:left;' },
                    { A38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A39: 'text-align:left;' },
                    { A40: 'text-align:left;' },
                    { A41: 'text-align:left;' },
                    { A42: 'text-align:left;' },
                    // { A43: 'text-align:left;' },
                    { A43: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B43: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C43: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A44: 'text-align:left;' },
                    { A45: 'text-align:left;' },
                    { A46: 'text-align:left;' },
                    // { A47: 'text-align:left;' },
                    { A47: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B47: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C47: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A48: 'text-align:left;' },
                    { A49: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B49: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C49: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A50: 'text-align:left;' },
                    { A51: 'text-align:left;' },

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
                    'Status',
                ],
                colWidths: [850,100,100],
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
                    { A8: 'text-align:left;' },
                    { A9: 'text-align:left;' },
                    { A10: 'text-align:left;' },
                    { A11: 'font-weight: bold;background-color: yellow' },
                    { B11: 'font-weight: bold;background-color: yellow' },
                    { C11: 'font-weight: bold;background-color: yellow' },
                    { A12: 'text-align:left;' },
                    { A13: 'text-align:left;' },
                    { A14: 'text-align:left;' },
                    { A15: 'text-align:left;' },
                    { A16: 'text-align:left;' },
                    // { A16: 'text-align:left;font-weight: bold;background-color: yellow' },
                    // { B16: 'text-align:left;font-weight: bold;background-color: yellow' },
                    // { C16: 'text-align:left;font-weight: bold;background-color: yellow' },
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
                    { A31: 'text-align:left;' },
                    { A32: 'text-align:left;' },
                    { A33: 'text-align:left;' },
                    { A34: 'text-align:left;' },
                    { A35: 'text-align:left;' },
                    { A36: 'text-align:left;' },
                    { A37: 'text-align:left;' },
                    // { A38: 'text-align:left;' },
                    { A38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A39: 'text-align:left;' },
                    { A40: 'text-align:left;' },
                    { A41: 'text-align:left;' },
                    { A42: 'text-align:left;' },
                    // { A43: 'text-align:left;' },
                    { A43: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B43: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C43: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A44: 'text-align:left;' },
                    { A45: 'text-align:left;' },
                    { A46: 'text-align:left;' },
                    // { A47: 'text-align:left;' },
                    { A47: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B47: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C47: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A48: 'text-align:left;' },
                    { A49: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B49: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C49: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A50: 'text-align:left;' },
                    { A51: 'text-align:left;' },

                ]
            );                

        }
    }

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
            url: SITE_URL+"job_aid/j19/a0_save",
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
        $("#equipment").load(SITE_URL + "attachment/list_attachment_dropdown/" + $("#pabrik").val() + "/J19" ,
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
            url: SITE_URL + "job_aid/j19/a0_load",
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
