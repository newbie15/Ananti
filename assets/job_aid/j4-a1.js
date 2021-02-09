$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    
    data_default = [
        ["Sebelum","",""],
        ["a) Memiliki petunjuk pengujian dan pengoperasian OEM","",""],
        ["b) Anda adalah teknisi elektrik yang telah di-training khusus terkait inspeksi ini","",""],
        ["c) Personel sudah menggunakan PPE yang sesuai ","",""],
        ["d) Isi dan tanda tangan personel terkait pada Pre-Job Hazard Analysis (PJHA)","",""],
        ["e) Alat kerja yang dibutuhkan dalam kondisi baik dan lengkap","",""],
        ["VISUAL INSPECTION (Kondisi Energized dan Kondisi Operasi Normal)","",""],
        ["Sedang","",""],
        ["Housekeeping","",""],
        ["a) Kondisi ventilasi dan sirkulasi udara sekitar  transformer pada kondisi yang baik","",""],
        ["Angkur dan Grounding (Lakukan jika bisa di akses dengan aman)","",""],
        ["a) Kondisi angkur kondisi baik","",""],
        ["b) Evaluasi kondisi dan koneksi straps grounding pada casing transformer tersambung dengan baik pada sistem grounding","",""],
        ["- Straps Grounding Keadaan Baik (tidak ada cacat atau sambungan)","",""],
        ["- Koneksi straps kencang dan tidak ada perubahan warna pada straps","",""],
        ["Kebocoran dan Tumpahan Oli (Lakukan jika bisa di akses dengan aman)","",""],
        ["a) Area Bushing dan penetration tidak ada kebocoran oli","",""],
        ["b) Tidak ada perubahan warna permukaan yang di cat pada sekitar bushing dan area penetration (indikasi rembesan dari dalam)","",""],
        ["c) Jika ada rembesan Oli, ambil Foto situasi/lokasi rembesan","",""],
        ["d) Pembersihan Rembesan Oli","",""],
        ["Kondisi Cat dan Kebersihan","",""],
        ["a) Tidak ada perubahan warna cat atau mengelupas","",""],
        ["b) Luar kompartemen transformer dalam keadaan bersih","",""],
        ["c) Fin/Sirip-sirip transformer keadaan bersih dan tidak ada halangan","",""],
        ["Suhu Tekanan dan Level Oli  (Lakukan jika bisa di akses dengan aman)","",""],
        ["a) Suhu transformer","",""],
        ["b) Tekanan Oli transformer","",""],
        ["c) Ketinggian Oli diatas indikator level aman","",""],
        ["Corona","",""],
        ["a) Corona pada terminasi ","",""],
        ["b) Corona pada Bushing","",""],
        ["Label Arc flash/safety/statutory","",""],
        ["a) Ada Label Arc Flash 	","",""],
        ["b) Ada Label Electric Shock Hazard	","",""],
        ["c) Tanda Peringatan Backpower	","",""],
        ["d) Ada Label Peraturan Keamanan Pertolongan Pertama	","",""],
        ["c) Terdapat Label kode artikel dan peringatan	","",""],
        ["Pengamanan","",""],
        ["a) Semua Kompartement elektrik dan pintu sudah terkunci	","",""],
        ["b) Tidak ada halangan/hambatan pada akses masuk dan keluar sekitar trafo	","",""],
        ["c) Valve drain/discharge keadaan terkunci dan tertutup","",""],
        ["d) Pagar pengaman logam diamankan/dikunci,terkoneksi ke grounding dan ada tanda peringatan terpasang","",""],
    ];

    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh(data) {
        console.log("refresh data");
        console.log(data);
        if (data.length<1) {
            console.log("yes kurang dari 1");
            // $.ajax({
            //     method: "POST",
            //     url: SITE_URL + "unit/ajax_default_list",
            //     data: {
            //         id_pabrik: $("#pabrik").val(),
            //         id_station: $("#station").val(),
            //     }
            // }).done(function (msg) {
            //     console.log("ini refresh");

            //     console.log(msg);
            //     data = JSON.parse(msg);
            //     console.log(data);
            //     x = data;
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
                        // { type: 'dropdown', source: ['-', 'Tidak', 'Ya'] },
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
                        { A9: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B9: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C9: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { A10: 'text-align:left;' },
                        { A11: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B11: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C11: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { A12: 'text-align:left;' },
                        { A13: 'text-align:left;' },
                        { A14: 'text-align:left;' },
                        { A15: 'text-align:left;' },
                        { A16: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B16: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C16: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { A17: 'text-align:left;' },
                        { A18: 'text-align:left;' },
                        { A19: 'text-align:left;' },
                        { A20: 'text-align:left;' },
                        { A21: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B21: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C21: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { A22: 'text-align:left;' },
                        { A23: 'text-align:left;' },
                        { A24: 'text-align:left;' },
                        { A25: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B25: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C25: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { A26: 'text-align:left;' },
                        { A27: 'text-align:left;' },
                        { A28: 'text-align:left;' },
                        { A29: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B29: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C29: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { A30: 'text-align:left;' },
                        { A31: 'text-align:left;' },
                        { A32: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B32: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C32: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { A33: 'text-align:left;' },
                        { A34: 'text-align:left;' },
                        { A35: 'text-align:left;' },
                        { A36: 'text-align:left;' },
                        { A37: 'text-align:left;' },
                        { A38: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B38: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C38: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { A39: 'text-align:left;' },
                        { A40: 'text-align:left;' },
                        { A41: 'text-align:left;' },
                        { A42: 'text-align:left;' },
                        { A43: 'text-align:left;' },
                    ]
                );

            // });
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
                colWidths: [850,100,100,75,75,75,75,75,75,75,75,75,100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    // { type: 'dropdown', source: ['-', 'Tidak', 'Ya'] },
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
                    { A9: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B9: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C9: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A10: 'text-align:left;' },
                    { A11: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B11: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C11: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A12: 'text-align:left;' },
                    { A13: 'text-align:left;' },
                    { A14: 'text-align:left;' },
                    { A15: 'text-align:left;' },
                    { A16: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B16: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C16: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A17: 'text-align:left;' },
                    { A18: 'text-align:left;' },
                    { A19: 'text-align:left;' },
                    { A20: 'text-align:left;' },
                    { A21: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B21: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C21: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A22: 'text-align:left;' },
                    { A23: 'text-align:left;' },
                    { A24: 'text-align:left;' },
                    { A25: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B25: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C25: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A26: 'text-align:left;' },
                    { A27: 'text-align:left;' },
                    { A28: 'text-align:left;' },
                    { A29: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B29: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C29: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A30: 'text-align:left;' },
                    { A31: 'text-align:left;' },
                    { A32: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B32: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C32: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A33: 'text-align:left;' },
                    { A34: 'text-align:left;' },
                    { A35: 'text-align:left;' },
                    { A36: 'text-align:left;' },
                    { A37: 'text-align:left;' },
                    { A38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C38: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { A39: 'text-align:left;' },
                    { A40: 'text-align:left;' },
                    { A41: 'text-align:left;' },
                    { A42: 'text-align:left;' },
                    { A43: 'text-align:left;' },
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
            url: SITE_URL+"job_aid/j4/a1_save",
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
        $("#equipment").load(SITE_URL + "attachment/list_attachment_dropdown/" + $("#pabrik").val() + "/J4" ,
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
            url: SITE_URL + "job_aid/j4/a1_load",
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
