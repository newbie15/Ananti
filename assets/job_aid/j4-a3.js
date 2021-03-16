$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    var BASE_UPLOAD = $("form.dropzone").attr("action");
    
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
        ["Casing dan fin radiator transformer","",""],
        ["a) Level Oli pada Conservator Tank (>= 50% batas atas radiator)","%",""],
        ["b) Suhu transformer  bagian atas (profil sirip/fin radiator)","C",""],
        ["c) Suhu transformer  bagian bawah (profil sirip/fin radiator)","C",""],
        ["Cable/Conductor","",""],
        ["a) Suhu Tegangan Tinggi phase R","C",""],
        ["b) Suhu Tegangan Tinggi phase S","C",""],
        ["c) Suhu Tegangan Tinggi phase T","C",""],
        ["d) Suhu Tegangan Rendah Phase R","C",""],
        ["e) Suhu Tegangan Rendah Phase S","C",""],
        ["f) Suhu Tegangan Rendah Phase T","C",""]        
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
            //         id_equipment: $("#equipment").val(),
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
                        { A9: 'text-align:left;' },
                        { A10: 'text-align:left;' },
                        { A11: 'font-weight: bold;background-color: yellow' },
                        { B11: 'font-weight: bold;background-color: yellow' },
                        { C11: 'font-weight: bold;background-color: yellow' },
                        { A12: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { B12: 'text-align:left;font-weight: bold;background-color: yellow' },
                        { C12: 'text-align:left;font-weight: bold;background-color: yellow' },
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
                        { A21: 'text-align:left;' },
                        { A22: 'text-align:left;' },
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
                    { A9: 'text-align:left;' },
                    { A10: 'text-align:left;' },
                    { A11: 'font-weight: bold;background-color: yellow' },
                    { B11: 'font-weight: bold;background-color: yellow' },
                    { C11: 'font-weight: bold;background-color: yellow' },
                    { A12: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { B12: 'text-align:left;font-weight: bold;background-color: yellow' },
                    { C12: 'text-align:left;font-weight: bold;background-color: yellow' },
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
                    { A21: 'text-align:left;' },
                    { A22: 'text-align:left;' },
                ]
            );
        }
    }

    function update_session(){
        $.ajax({
            method: "POST",
            url: SITE_URL+"job_aid/j4/a3_session",
            data: {
                pabrik: $("#pabrik").val(),
                equipment: $("#equipment").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    }

    function update_picture(){        
        var equipments = $("#pabrik").val()+"/"+$("#equipment").val()+"/"+$("#tahun").val()+"/"+$("#bulan").val()+"/"+$("#tanggal").val();
        $("#images-area").load(SITE_URL + "job_aid/j4/a3_images/"+equipments);
    }

    $("#modal-upload").on('hide.bs.modal', function () {
        update_picture();
    });

    $( "#images-area" ).on( "click", "button", function( event ) {
        event.preventDefault();
        console.log( $( this ).text() );
        console.log( $(this).attr('value') );
        var dtx = $(this).attr('value').split("/");
        console.log(dtx);
        if(confirm("Anda yakin menghapus ini ?")){
            $.ajax({
                method: "POST",
                url: SITE_URL+"job_aid/j4/a3_delete_image",
                success: update_picture,
                data: {
                    pabrik: $("#pabrik").val(),
                    equipment: $("#equipment").val(),
                    d: $("#tanggal").val(),
                    m: $("#bulan").val(),
                    y: $("#tahun").val(),
                    f: dtx[14],
                    // data_json: JSON.stringify(data_j),
                }
            }).done(function (msg) {
                console.log(msg);
            });
        }
    });

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

    $("#imageupload").click(function () {
        update_session();
    });

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"job_aid/j4/a3_save",
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
        // update_session();

        $.ajax({
            method: "POST",
            url: SITE_URL + "job_aid/j4/a3_load",
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

        setTimeout(() => {
            update_picture();
        },1000);
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
