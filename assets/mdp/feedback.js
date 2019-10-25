$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];
    d_process = [
        ["USB", "", "Maks 1"],
        ["Tankos", "Oil Wet Basis", "≤ 0,80"],
        ["USB Recyciling", "Efficiensi", "≤ 95"],
        ["Press Cake", "Oil Wet Basis", "Maks 3.6"],
        ["Press Cake", "Oil Dry Basis", "Maks 6"],
        ["Press Cake", "B.Nut/Tot Nut", "Maks 18"],
        ["Nut", "Oil Wet Basis", "≤ 0.5"],
        ["Riple Mill", "BROKEN KERNEL", "Maks 14"],
        ["Riple Mill", "Efficiensi", "&gt;95"],
        ["Fibre Cyclone", "Kernel Losses", "Maks 1"],
        ["LTDS 1", "Kernel Losses", "Maks 1"],
        ["LTDS 2", "Kernel Losses", "Maks 1"],
        ["Dekstoner", "Kernel Losses", "Maks 1"],
        ["Shell Exs HDC", "Kernel Losses", "Maks 2"],
        ["Kernel Exs HDC", "Dirty", "Maks 7.5"],
        ["Kernel Exs LTDS 1", "Dirty", "Maks 7.5"],
        ["Kernel Exs LTDS 2", "Dirty", "Maks 7.5"],
        ["Kernel Gabungan", "Dirty", "Maks 7.5"],
        ["Kernel Produksi", "Dirty", "Maks 5,0"],
        ["Kernel Produksi", "Moisture", "5,0 - 6,0"],
        ["Kernel Produksi", "Kernel Pecah", "Maks 15"],
        ["Condensate", "Oil Wet Basis", "Maks 1"],
        ["Condensate", "Oil Dry Basis", "12.0 - 14.0"],
        ["Sludge Under flow", "Moisture", "> 85"],
        ["Sludge Under flow", "Oil Wet Basis", "Maks 6.0"],
        ["Sludge Sparator", "Oil Wet Basis", "Maks 0.7"],
        ["Sludge Sparator", "Oil Dry Basis", "Maks 10"],
        ["Sludge Pit", "Oil Wet Basis", "Maks 1"],
        ["Sludge Pit", "Oil Dry Basis", "Maks 14"],
        ["Feed Purifier", "Moisture", "≤ 0.90"],
        ["Feed Purifier", "Dirty", "≤ 0.06"],
        ["After Purifier", "Moisture", "≤ 0.50"],
        ["After Purifier", "Dirty", "≤ 0.02"],
        ["CPO Produksi", "FFA", "Maks 3.0"],
        ["CPO Produksi", "Moisture", "≤ 0.20"],
        ["CPO Produksi", "Dirty", "≤ 0.02"],
        ["CPO Produksi", "DOBI", "Min 2.5"],
        ["CPO Produksi", "CAROTEN", "± 500"],
        ["Storage Tank", "FFA", "Maks 3.0"],
        ["Storage Tank", "Moisture", "≤ 0.20"],
        ["Storage Tank", "Dirty", "≤ 0.02"],
    ];

    d_kcp = [
        ["Kernel Olah", "Dirty", "Maks 6"],
        ["Kernel Olah", "Moisture", "Maks 6"],
        ["Kernel Olah", "Kernel Pecah", "Maks 15"],
        ["First Press", "Moisture", "Maks 7.0"],
        ["First Press", "Oil losses", "12.0-14.0"],
        ["Second Press", "Moisture", "Maks 7.0"],
        ["Second Press", "Oil losses", "Maks 7.0"],
        ["PKO After Filter", "FFA", "Maks 2.0"],
        ["PKO After Filter", "Moisture", "Maks 0.20"],
        ["PKO After Filter", "Dirty", "Maks 0.020"],
        ["Storage Tank", "FFA", "Maks 2.0"],
        ["Storage Tank", "Moisture", "Maks 0.20"],
        ["Storage Tank", "Dirty", "Maks 0.020"],
    ];

    d_effluent = [
        ["pH", "7.0 - 7.4"],
        ["VFA", "< 1000"],
        ["Alkalinity", "> 4000"],
        ["VFA/Alk", "< 0.25"],
        ["Feeding", ""],
        ["HRD", ""]
    ];

    d_boiler = [
        ["pH"           , "", "", "7.0-8.0", "", "10.5-11.5", "", "", "", "", ],
        ["Cond/TDS"     , "", "", "Maks 100", "", "Maks 2000", "", "", "", "", ],
        ["P.Alk"        , "", "", "", "", "", "", "", "", "", ],
        ["C.Alk"        , "", "", "", "", "Min 2.5XSiO3", "", "", "", "", ],
        ["M.Alk"        , "", "", "", "", "Maks 700", "", "", "", "", ],
        ["Tot.Hardnes"  , "", "", "trace", "", "trace", "", "", "", "", ],
        ["Sulfite"      , "", "", "", "", "30 - 50", "", "", "", "", ],
        ["Silica"       , "", "", "Maks 5", "", "Maks 150", "", "", "", "", ],
        ["Phospate"     , "", "", "", "", "20 - 30", "", "", "", "", ],
        ["Fe / Iron"    , "", "", "", "", "", "", "", "", "", ],
        ["Turbidity"    , "", "", "Maks 1", "", "", "", "", "", "", ],
    ];

    d_absloss = [
        ["USB",""],
        ["PRESS CAKE",""],
        ["TANDAN KOSONG",""],
        ["HEAVY PHASE",""],
        ["WET NUT",""],
        ["TOTAL",""],
    ];

    md_absloss = [
        ["USB", ""],
        ["PRESS CAKE", ""],
        ["TANDAN KOSONG", ""],
        ["HEAVY PHASE", ""],
        ["WET NUT", ""],
        ["TOTAL", ""],
    ];

    d_abskloss = [
        ["DESTONER",""],
        ["FIBER CYCLONE",""],
        ["LTDS-1",""],
        ["LTDS-2",""],
        ["HYDROCYCLONE",""],
        ["TOTAL KERNEL LOSSES",""],
    ];

    md_abskloss = [
        ["DESTONER", ""],
        ["FIBER CYCLONE", ""],
        ["LTDS-1", ""],
        ["LTDS-2", ""],
        ["HYDROCYCLONE", ""],
        ["TOTAL KERNEL LOSSES", ""],
    ];

    d_olah = [
        ["TBS Olah",""],
        ["TBS Terima",""],
        ["Taksasi",""],
        ["Rata-Rata Lori",""],
        ["ER CPO",""],
        ["ER KERNEL",""],
        ["ER PKO",""],
        ["Troughput POM",""],
        ["Troughput KCP",""],
        ["Pemakaian Air/TBS Olah(Maks 1M³/T)",""],
        ["Oil Content Kernel Olah",""],
        ["Sludge ter olah/produksi sludge ",""],
        ["Stock CPO (kg)", ""],
        ["Stock PKO (kg)", ""],
        ["Stock Kernel (kg)", ""],
        ["Stock PKE (kg)", ""],
        ["Breakdown (jam)", ""],


    ];

    md_olah = [
        ["TBS Olah", ""],
        ["TBS Terima", ""],
        ["Taksasi", ""],
        ["Rata-Rata Lori", ""],
        ["ER CPO", ""],
        ["ER KERNEL", ""],
        ["ER PKO", ""],
        ["Troughput POM", ""],
        ["Troughput KCP", ""],
        ["Pemakaian Air/TBS Olah(Maks 1M³/T)", ""],
        ["Oil Content Kernel Olah", ""],
        ["Sludge ter olah/produksi sludge ", ""],
        ["Stock CPO (kg)", ""],
        ["Stock PKO (kg)", ""],
        ["Stock Kernel (kg)", ""],
        ["Stock PKE (kg)", ""],
        ["Breakdown (jam)", ""],
    ];

    data_detail = [];
    keterangan_detail = [];
    data_detailnya = "";

    function refresh(data) {
        var dt_olah = data.olah;
        var dt_pks = data.pks;
        var dt_kcp = data.kcp;
        var dt_eff = data.eff;
        var dt_boiler = data.boiler;

        console.log(dt_olah);

        if(dt_olah.length<1){
            $('#my-absloss').jexcel({
                data: md_absloss,
                allowInsertColumn: false,
                colHeaders: [
                    'Parameter',
                    'Nilai',
                ],
                colWidths: [175, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

            $('#my-abskloss').jexcel({
                data: md_abskloss,
                allowInsertColumn: false,
                colHeaders: [
                    'Parameter',
                    'Nilai',
                ],
                colWidths: [175, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

            $('#my-olah').jexcel({
                data: md_olah,
                allowInsertColumn: false,
                colHeaders: [
                    'Parameter',
                    'Nilai',
                ],
                colWidths: [250, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        }else{
            var dtx_olah = d_olah;
            var dtx_absloss = d_absloss;
            var dtx_abskloss = d_abskloss;
            var i = 0;

            var a = 0;
            console.log("i="+i);
            dtx_olah.forEach(element => {
                console.log(element[0]);
                dtx_olah[a++][1] = dt_olah[0][i++];
            });
            console.log("i=" + i);

            $('#my-olah').jexcel({
                data: dtx_olah,
                allowInsertColumn: false,
                colHeaders: [
                    'Parameter',
                    'Nilai',
                ],
                colWidths: [250, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

            console.log("i=" + i);
            a = 0;
            dtx_absloss.forEach(element => {
                console.log(element[0]);
                dtx_absloss[a++][1] = dt_olah[0][i++];
            });
            console.log("i=" + i);

            $('#my-absloss').jexcel({
                data: dtx_absloss,
                allowInsertColumn: false,
                colHeaders: [
                    'Parameter',
                    'Nilai',
                ],
                colWidths: [250, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                ],
            });            

            console.log("i=" + i);
            a = 0;
            dtx_abskloss.forEach(element => {
                console.log(element[0]);
                dtx_abskloss[a++][1] = dt_olah[0][i++];
            });
            console.log("i=" + i);


            $('#my-abskloss').jexcel({
                data: dtx_abskloss,
                allowInsertColumn: false,
                colHeaders: [
                    'Parameter',
                    'Nilai',
                ],
                colWidths: [250, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                ],
            });            

        }

        if (dt_pks.length < 1) {
            $('#my-spreadsheet').jexcel({
                data: d_process,
                allowInsertColumn: false,
                colHeaders: [
                    'Item',
                    'Deskripsi',
                    'Standard',
                    'Unit 1',
                    'Unit 2',
                    'Unit 3',
                    'Unit 4',
                    'Unit 5',
                    'Unit 6',
                    'Unit 7',
                    'Unit 8',
                    'Unit 9',
                    'Unit 10',
                    'Rata-Rata',
                ],
                colWidths: [125, 125, 150, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75],
                columns: [
                    { type: 'text' },
                    // { type: 'checkbox' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        } else { 
            $('#my-spreadsheet').jexcel({
                data: dt_pks,
                allowInsertColumn: false,
                colHeaders: [
                    'Item',
                    'Deskripsi',
                    'Standard',
                    'Unit 1',
                    'Unit 2',
                    'Unit 3',
                    'Unit 4',
                    'Unit 5',
                    'Unit 6',
                    'Unit 7',
                    'Unit 8',
                    'Unit 9',
                    'Unit 10',
                    'Rata-Rata',
                ],
                colWidths: [125, 125, 150, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75],
                columns: [
                    { type: 'text' },
                    // { type: 'checkbox' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

        }
        if (dt_kcp.length < 1) {
            $('#my-kcp').jexcel({
                data: d_kcp,
                allowInsertColumn: false,
                colHeaders: [
                    'Item',
                    'Deskripsi',
                    'Standard',
                    'Unit 1',
                    'Unit 2',
                    'Unit 3',
                    'Unit 4',
                    'Unit 5',
                    'Unit 6',
                    'Unit 7',
                    'Unit 8',
                    'Unit 9',
                    'Unit 10',
                    'Rata-Rata',
                ],
                colWidths: [125, 125, 150, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        } else {
            $('#my-kcp').jexcel({
                data: dt_kcp,
                allowInsertColumn: false,
                colHeaders: [
                    'Item',
                    'Deskripsi',
                    'Standard',
                    'Unit 1',
                    'Unit 2',
                    'Unit 3',
                    'Unit 4',
                    'Unit 5',
                    'Unit 6',
                    'Unit 7',
                    'Unit 8',
                    'Unit 9',
                    'Unit 10',
                    'Rata-Rata',
                ],
                colWidths: [125, 125, 150, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75, 75],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

        }
        if (dt_eff.length < 1) {
            $('#my-effluent').jexcel({
                data: d_effluent,
                allowInsertColumn: false,
                colHeaders: [
                    'Item',
                    'Standard',
                    'Anaerobic 1',
                    'Anaerobic 2',
                    'Anaerobic 3',
                    'Anaerobic 4',
                    'Rata-Rata',
                ],
                colWidths: [125, 125, 100, 100, 100, 100, 100, 75, 75, 75, 75, 75, 75],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

        } else { 
            $('#my-effluent').jexcel({
                data: dt_eff,
                allowInsertColumn: false,
                colHeaders: [
                    'Item',
                    'Standard',
                    'Anaerobic 1',
                    'Anaerobic 2',
                    'Anaerobic 3',
                    'Anaerobic 4',
                    'Rata-Rata',
                ],
                colWidths: [125, 125, 100, 100, 100, 100, 100, 75, 75, 75, 75, 75, 75],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });

        }
        if (dt_boiler.length < 1) {
            $('#my-boiler').jexcel({
                data: d_boiler,
                allowInsertColumn: false,
                colHeaders: [
                    'Parameter',
                    'Softener 1',
                    'Softener 2',

                    'Std Feed',
                    'Feed 1',

                    'Std Boiler',
                    'Boiler 1',
                    'Boiler 2',
                    'Boiler 3',
                    'Boiler 4',

                ],
                colWidths: [125, 125, 100, 100, 100, 100, 100, 75, 75, 75, 75, 75, 75],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        } else {
            $('#my-boiler').jexcel({
                data: dt_boiler,
                allowInsertColumn: false,
                colHeaders: [
                    'Parameter',
                    'Softener 1',
                    'Softener 2',

                    'Std Feed',
                    'Feed 1',

                    'Std Boiler',
                    'Boiler 1',
                    'Boiler 2',
                    'Boiler 3',
                    'Boiler 4',

                ],
                colWidths: [125, 125, 100, 100, 100, 100, 100, 75, 75, 75, 75, 75, 75],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        }

    }

    $("#pabrik").change(function () {
        ajax_refresh();
    });
    $("#tahun").change(function () {
        ajax_refresh();
    });
    $("#bulan").change(function () {
        ajax_refresh();
    });
    $("#tanggal").change(function () {
        ajax_refresh();
    });

    $("#simpan").click(function () {
        alert("simpan");

        var j_olah = $('#my-olah').jexcel('getData');
        var j_absloss = $('#my-absloss').jexcel('getData');
        var j_abskloss = $('#my-abskloss').jexcel('getData');
        var j_pks = $('#my-spreadsheet').jexcel('getData');
        var j_kcp = $('#my-kcp').jexcel('getData');
        var j_effluent = $('#my-effluent').jexcel('getData');
        var j_boiler = $('#my-boiler').jexcel('getData');

        // console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"feedback/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
                data_olah: JSON.stringify(j_olah),
                data_absloss: JSON.stringify(j_absloss),
                data_abskloss: JSON.stringify(j_abskloss),
                data_pks: JSON.stringify(j_pks),
                data_kcp: JSON.stringify(j_kcp),
                data_effluent: JSON.stringify(j_effluent),
                data_boiler: JSON.stringify(j_boiler),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "feedback/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                // id_station: $("#station").val(),
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

    var tgl = new Date();
    var m = tgl.getMonth() + 1;
    if (m < 10) {
        $("#bulan").val("0" + m.toString());
    } else {
        $("#bulan").val(m.toString());
    }
    var y = tgl.getFullYear();
    $("#tahun").val(y.toString());
    var d = tgl.getDate();
    if (d < 10) {
        $("#tanggal").val("0" + d.toString());
    } else {
        $("#tanggal").val(d.toString());
    }

    ajax_refresh();

});
