$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    
    data_default = [
        ["Sebelum","",""],
        ["a) Teknisi sudah melalui pelatihan terkait bahaya kelistrikan khusus","-",""],
        ["b) Personel sudah memakai PPE untuk perlindungan listrik kejut dan arc flash","-",""],
        ["c) Anda adalah Teknisi Elektrik","-",""],
        ["d) Kondisi lokasi kerja dan cuaca aman","-",""],
        ["e) safety briefing dan job review sebelum inspeksi sudah dilakukan","-",""],
        ["f) Permit kerja untuk inspeksi IR sudah lengkap dan sesuai","-",""],
        ["g) Supervisor area yang sedang bertugas sudah diinformasi terkait inspeksi","-",""],
        ["h) Emissivity kamera IR sudah di atur (rekomendasi 0.98)","-",""],
        ["i) Calibration Check kamera IR sudah dilakukan","-",""],
        ["Sedang","",""],
        ["Tegangan kerja","Volt",""],
        ["Tipe Breaker","",""],
        ["Model Breaker","",""],
        ["Beban kerja phase R","Amp",""],
        ["Beban kerja phase S","Amp",""],
        ["Beban kerja phase T","Amp",""],
        ["Informasi Lain","",""],
        ["a) Temperatur absolut  pada kompartemen koneksi input","Kabel Phase R",""],
        ["b) Temperatur absolut  pada kompartemen koneksi input","Kabel Phase S",""],
        ["c) Temperatur absolut  pada kompartemen koneksi input","Kabel Phase T",""],
        ["d) Temperatur absolut  pada kompartemen koneksi output","Kabel Phase R",""],
        ["e) Temperatur absolut  pada kompartemen koneksi output","Kabel Phase S",""],
        ["f) Temperatur absolut  pada kompartemen koneksi output","Kabel Phase T",""],
        ["g) Temperatur absolut  pada kompartemen Bus koneksi input","Bus Phase R",""],
        ["h) Temperatur absolut  pada kompartemen Bus koneksi input","Bus Phase S",""],
        ["i) Temperatur absolut  pada kompartemen Bus koneksi input","Bus Phase T",""],
        ["j) Temperatur absolut  pada kompartemen Bus koneksi output","Bus Phase R",""],
        ["k) Temperatur absolut  pada kompartemen Bus koneksi output","Bus Phase S",""],
        ["l) Temperatur absolut  pada kompartemen Bus koneksi output","Bus Phase T",""],
        ["m) Temperatur absolut  Breaker/Main Fuse/LBS","",""],
        ["n) Temperatur absolut  Surge Protection (Jika ada)","",""],
        ["o) Temperature absolut pada kompartemen LV (Tegangan auxiliary)","",""]
        // ["b) Suhu transformer  bagian atas (profil sirip/fin radiator)","C",""],
        // ["c) Suhu transformer  bagian bawah (profil sirip/fin radiator)","C",""],
        // ["Cable/Conductor","",""],
        // ["d) Suhu Tegangan Rendah Phase R","C",""],
        // ["e) Suhu Tegangan Rendah Phase S","C",""],
        // ["f) Suhu Tegangan Rendah Phase T","C",""]        
    ];

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
                colWidths: [850,120,100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
            // $('#my-spreadsheet2').html("");
            // $('#my-spreadsheet2').jexcel({
            //     data: data,
            //     allowInsertColumn: false,
            //     colHeaders: [
            //         "Name Tag Breaker",
            //         "Name Tag Panel",
            //         "Lokasi",
            //         "Max Temp (oC)",
            //         "Status",
            //     ],
            //     colWidths: [200,200,200,120,100,75,75,75,75,75,75,75,100],
            //     columns: [
            //         { type: 'text' },
            //         { type: 'text' },
            //         { type: 'text' },
            //         { type: 'text' },
            //         { type: 'text' },
            //     ],
            // });
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
                colWidths: [850,120,100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
            // $('#my-spreadsheet2').html("");
            // $('#my-spreadsheet2').jexcel({
            //     data: data,
            //     allowInsertColumn: false,
            //     colHeaders: [
            //         "Name Tag Breaker",
            //         "Name Tag Panel",
            //         "Lokasi",
            //         "Max Temp (oC)",
            //         "Status",
            //     ],
            //     colWidths: [200,200,200,120,100,75,75,75,75,75,75,75,100],
            //     columns: [
            //         { type: 'text' },
            //         { type: 'text' },
            //         { type: 'text' },
            //         { type: 'text' },
            //         { type: 'text' },
            //     ],
            // });
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
            url: SITE_URL+"job_aid/j18/a3_save",
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
        $("#equipment").load(SITE_URL + "attachment/list_attachment_dropdown/" + $("#pabrik").val() + "/J18" ,
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
            url: SITE_URL + "job_aid/j18/a3_load",
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
