$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    data_default = [
        ["Sebelum","",""],
        ["a) Memiliki manual testing dan instruksi dari pabrikan (OEM)","",""],
        ["b) Sudah Menggunakan PPE Arc Flash dan Shock Protection sesuai level fault category","",""],
        ["c) Isi dan tanda tangan personel terkait pada Pre-Job Hazard Analysis (PJHA)","",""],
        ["d) Anda adalah Teknisi Elektrik yang telah di training inspeksi ini","",""],
        ["e) Alat kerja yang diperlukan kondisi baik dan lengkap","",""],
        ["A0 VISUAL INSPECTION (Kondisi Energized dan Kondisi Operasi Normal)","",""],
        ["Angkur dan Grounding (Lakukan jika bisa di akses dengan aman)","",""],
        ["a) Kondisi angkur kondisi baik","",""],
        ["b) Alignment dan  Clearance panel kondisi baik","",""],
        ["c) Tidak ada tanda tanda overheat, keretakan pada insulasi atau deformasi akibat panas ","",""],
        ["d) Label identifikasi pada HV Switchgear/switchboard lengkap dan bisa terbaca","",""],
        ["e) Label Safety pada HV Switchgear/switchboard lengkap dan bisa terbaca","",""],
        ["f) Verifikasi Tegangan Kerja Aktual ( R )","",""],
        ["g) Verifikasi Tegangan Kerja Aktual ( S )","",""],
        ["h) Verifikasi Tegangan Kerja Aktual ( T )","",""],
        ["i) Verifikasi Arus/Beban Kerja Aktual ( R )","",""],
        ["j) Verifikasi Arus/Beban Kerja Aktual (S )","",""],
        ["k) Verifikasi Arus/Beban Kerja Aktual ( T )","",""],
        ["l) Verifikasi Frekuensi Kerja Aktual pada panel meter","",""],
        ["m) Verifikasi Cos Phi operasional pada panel meter","",""],
        ["n) Indikator trip pada peralatan proteksi (SEPAM jika menggunakan SM6)","",""],
        ["    Contohnya I>51, I>>51, I>51N, I>>51N, ext, trip dll","",""],
        ["o) Fuse putus","",""],
        ["p) Voltage indicator berfungsi dengan baik","",""],
        ["A1 PHYSICAL INSPECTION ","",""],
        ["a) Kondisi Fisik dan mekanikal","",""],
        ["\tmasukkan ke note jika menemukan karat, sekrup hilang, Kirk/Lever Key hilang dll","",""],
        ["b) Kondisi angkur kondisi baik","",""],
        ["c) Alignment dan Clearance panel kondisi baik","",""],
        ["d) CT dalam Kondisi berfungsi ","",""],
        ["e) VT dalam kondisi berfungsi","",""],
        ["Kirk/Lever Key dan Door Interlock sekuensial berfungsi dengan baik","",""],
        ["f) Interlock A3 (IM SM6)","",""],
        ["g) Interlock A3 (IM SM6)","",""],
        ["h) Interlock P1 (IM SM6)","",""],
        ["i) Interlock A1 (DM1 SM6)","",""],
        ["j) Interlock C1 (DM1 SM6)","",""],
        ["k) Interlock C4 (DM1 SM6)","",""],
        ["l) Interlock 50 (DM1 SM6)","",""],
        ["m) Tidak ada tanda tanda overheat, keretakan pada insulasi atau deformasi akibat panas ","",""],
        ["n) Filter keadaan bersih","",""],
        ["o) Fuse dan rangkaian kontrol dalam keadaan baik","",""],
        ["p) Pembersihan sisa grease atau deposit debu pada permukaan rack (jika ada)","",""]
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
            $.ajax({
                method: "POST",
                url: SITE_URL + "unit/ajax_default_list",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    id_station: $("#station").val(),
                }
            }).done(function (msg) {
                console.log("ini refresh");

                console.log(msg);
                data = JSON.parse(msg);
                console.log(data);
                x = data;
                $('#my-spreadsheet').html("");
                $('#my-spreadsheet').jexcel({
                    data: data_default,
                    allowInsertColumn: false,
                    colHeaders: [
                        'Inspection Test',
                        'Satuan',
                        'Status',
                    ],
                    colWidths: [800, 100, 100, 80, 80, 80, 80, 80, 80, 80, 80, 80, 80],
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
                        { A26: 'font-weight: bold;background-color: yellow' },
                        { B26: 'font-weight: bold;background-color: yellow' },
                        { C26: 'font-weight: bold;background-color: yellow' },
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
                        { A38: 'text-align:left;' },
                        { A39: 'text-align:left;' },
                        { A40: 'text-align:left;' },
                        { A41: 'text-align:left;' },
                        { A42: 'text-align:left;' },
                        { A43: 'text-align:left;' },
                        { A44: 'text-align:left;' },

                    ]
                );
            });
        }else{
            $('#my-spreadsheet').html("");
            $('#my-spreadsheet').jexcel({
                data: data,
                allowInsertColumn: false,
                colHeaders: [
                    'Name Tag<br>RCD / GFCI',
                    'Tipe',
                    'Lokasi',
                    'A',
                    'B',
                    'C',
                    'D',
                ],
                colWidths: [200, 200, 200, 100, 100, 100, 100, 100, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { type: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                    { tye: 'dropdown', source: ['-', 'Fail', 'Pass'] },
                ],
            });
        }
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
            url: SITE_URL+"acm/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
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
        $("#station").load(SITE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
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
            url: SITE_URL + "acm/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
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
