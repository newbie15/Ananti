$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    data_default = [
        ["Sebelum","",""],
        ["A) Memiliki manual testing dan instruksi dari pabrikan (OEM)","",""],
        ["B) Anda adalah teknisi elektrik yang telah di-training khusus terkait inspeksi ini","",""],
        ["C) Personel sudah menggunakan PPE yang sesuai level fault","",""],
        ["D) Isi dan tanda tangan personel terkait pada Pre-Job Hazard Analysis (PJHA)","",""],
        ["E) Alat kerja yang dibutuhkan dalam kondisi baik dan lengkap","",""],

        ["Sedang","",""],
        ["Name Tag Panel","",""],
        ["Suhu (oC)","",""],
        ["Daya Motor (KW)","",""],
        ["Deskripsi Peralatan","",""],
        ["Merk/Brand VFD","",""],                                            
        ["Tipe VFD","",""],
        ["A) Casing/Frame VFD terpasang degnan baik pada dinding/kabinet","",""],
        ["B) Tidak ada bagian Frame VFD yang hilang (baut, mur, terminal,nut, washer dll)","",""],
        ["C) Tidak ada tanda-tanda titik panas (pada kabel, terminal dll)","",""],
        ["D) Tidak ada suara-suara noise yang abnormal dari VFD","",""],
        ["E) Tidak ada Penumpukan debu pada casing/frame VFD","",""],
        ["F) Kondisi VFD dan ruangan bersih","",""],
        ["G) Koneksi Kabel shield tersambung dengan baik ke titik lokal pentanahan/grounding","",""],
        ["H) flat copper strips (Bonding VFD) ada, aman dan tersambung dengan pentanahan/grounding dengan baik","",""],
        ["I) Kondisi kipas pendingin VFD selalu berfungsi saat VFD ON semua","",""],
        ["J) Filter ventilasi pintu MCC kabinet dan remote panel terpasang dan bersih","",""],
    ];

    data = [];
    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh(data) {
        console.log("refresh data");
        console.log(data);
        if (data.length<1) {
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data_default,
                allowInsertColumn: false,
                colHeaders: [
                    'Inspection Test',
                    'Satuan',
                    'Status',
                ],
                colWidths: [850,100,100,75,75,75,75,75,75,75,75,75,100],
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
                ]
            );

            $('#my-fault').html("");
            $('#my-fault').jexcel({
                data: [],
                allowInsertColumn: false,
                colHeaders: [
                    'Kode Fault',
                    'Deskripsi',
                    'Tanggal',
                    'Waktu',
                ],
                colWidths: [100,400,100,100,75,75,75,75,75,75,75,75,100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

            $('#my-setting').html("");
            $('#my-setting').jexcel({
                data: [],
                allowInsertColumn: false,
                colHeaders: [
                    'Kode',
                    'Deskripsi',
                    'Value',
                    'Remarks',
                ],
                colWidths: [100,400,100,100,75,75,75,75,75,75,75,75,100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

        }else{
            console.log("here");
            console.log(data);
            data_pre = data.pre;
            data_fault = data.fault;
            data_setting = data.setting;
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data_pre,
                allowInsertColumn: false,
                colHeaders: [
                    'Inspection Test',
                    'Satuan',
                    'Status',
                ],
                colWidths: [850,100,100,75,75,75,75,75,75,75,75,75,100],
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
                ]
            );

            $('#my-fault').html("");
            $('#my-fault').jexcel({
                data: data_fault,
                allowInsertColumn: false,
                colHeaders: [
                    'Kode Fault',
                    'Deskripsi',
                    'Tanggal',
                    'Waktu',
                ],
                colWidths: [100,400,100,100,75,75,75,75,75,75,75,75,100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

            $('#my-setting').html("");
            $('#my-setting').jexcel({
                data: data_setting,
                allowInsertColumn: false,
                colHeaders: [
                    'Kode',
                    'Deskripsi',
                    'Value',
                    'Remarks',
                ],
                colWidths: [100,400,100,100,75,75,75,75,75,75,75,75,100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

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
        var data_f = $('#my-fault').jexcel('getData');
        var data_s = $('#my-setting').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"job_aid/j24/a0_save",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                equipment: $("#equipment").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_json: JSON.stringify(data_j),
                data_fault: JSON.stringify(data_f),
                data_setting: JSON.stringify(data_s),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function equipment_refresh(){
        $("#equipment").load(SITE_URL + "attachment/list_attachment_dropdown/" + $("#pabrik").val() + "/J24",
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
            url: SITE_URL + "job_aid/j24/a0_load",
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
