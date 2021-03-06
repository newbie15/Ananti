$(function () {
    var problem_chart = $("#donut-chart");

    var breakdown = $("#breakdown");
    var unit_problem = $("#unit_problem");
    var wo_unfinished = $("#wo_unfinished");
    var wo_baru = $("#wo_baru");
    var mill_availibility = $("#mill_avaibility");

    function refresh(d){
        breakdown.html(d['breakdown']);
        unit_problem.html(d['unit_problem']);
        wo_unfinished.html(d['wo_unfinished']);
        wo_baru.html(d['wo_baru']);
        mill_availibility.html(d['mill_avaibility']);

        $('#j_today').jexcel({
            data: d['job_today'],
            allowInsertColumn: false,
            colHeaders: [
                'Station',
                'Unit',
                'Pekerjaan',
                'MPP',
            ],
            colWidths: [100, 150, 225, 75, 50, 100, 60, 100, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ],
        });

        d['problem_chart'] = [];
        var dt = [];

        console.log(d['station_list']);
        var i = 0;

        d['station_list'].forEach(element => {
            dt[i] = {
                label: element[0],
                data: parseInt(element[1])
            }
            i++;
        });

        $.plot('#donut-chart', dt, {
            series: {
                pie: {
                    show: true,
                    // radius: 1,
                    // label: {
                    //     show: true,
                    //     radius: 3 / 4,
                    //     // formatter: labelFormatter,
                    //     background: {
                    //         opacity: 0.5,
                    //         color: '#000'
                    //     }
                    // }
                }
            },
            legend: {
                show: false
            }
        });

        try {
            $("#n1").html(d['high_maintenance_unit'][0][0]);
            $("#v1").html(d['high_maintenance_unit'][0][1]);
            $("#n2").html(d['high_maintenance_unit'][1][0]);
            $("#v2").html(d['high_maintenance_unit'][1][1]);
            $("#n3").html(d['high_maintenance_unit'][2][0]);
            $("#v3").html(d['high_maintenance_unit'][2][1]);
        }
        catch (err) {
            console.log(err.message);
        }


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

        // ajax_refresh();
        ho_stat_refresh();
    });

    $("#bulan").change(function () {
        ho_stat_refresh();
    });

    function pabrik_refresh(){
        $("#per-site").show();
        $("#all-site").hide();

        $.ajax({
            method: "POST",
            url: SITE_URL + "main/statistik",
            data: {
                id_pabrik: $("#pabrik").val(),
                tanggal: $("#tgl_job").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }

    function wo_all_site_refresh(){
        w = [];

        $.ajax({
            method: "POST",
            url: SITE_URL + "main/wo_statistik_all",
            data: {
                id_pabrik: $("#pabrik").val(),
                tanggal: $("#tgl_job").val(),
                tahun: $("#tahun").val(),
                bulan: $("#bulan").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            dataw = JSON.parse(msg);
            // console.log(data);
            // refresh(data);

            $('#wo-all-site').jexcel({
                data: dataw,
                allowInsertColumn: false,
                colHeaders: [
                    'Site / Pabrik',
                    'Total WO',
                    'WO Open',
                    'WO Close',
                    'WO Unknown',
                ],
                colWidths: [100, 100, 100, 100, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        });

    }

    function bdt_all_site_refresh(){
        $.ajax({
            method: "POST",
            url: SITE_URL + "main/bd_statistik_all",
            data: {
                id_pabrik: $("#pabrik").val(),
                tanggal: $("#tgl_job").val(),
                tahun: $("#tahun").val(),
                bulan: $("#bulan").val(),
                jenis : "total"
            }
        }).done(function (msg) {
            console.log(msg);
            bdt = JSON.parse(msg);

            $('#bdt-all-site').jexcel({
                data: bdt,
                allowInsertColumn: false,
                colHeaders: [
                    'Site / Pabrik',
                    'Total BD',
                    'BD PROSES<br>POGEN',
                    'BD PROSES<br>NON POGEN',
                    'BD MTC<br>POGEN',
                    'BD MTC<br>NON POGEN',
                ],
                colWidths: [100, 100, 100, 100, 100, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        });
    }

    function bdl_all_site_refresh(){
        $.ajax({
            method: "POST",
            url: SITE_URL + "main/bd_statistik_all",
            data: {
                id_pabrik: $("#pabrik").val(),
                tanggal: $("#tgl_job").val(),
                tahun: $("#tahun").val(),
                bulan: $("#bulan").val(),
                jenis : "line"
            }
        }).done(function (msg) {
            console.log(msg);
            bdl = JSON.parse(msg);

            $('#bdl-all-site').jexcel({
                data: bdl,
                allowInsertColumn: false,
                colHeaders: [
                    'Site / Pabrik',
                    'Total BD',
                    'BD PROSES<br>POGEN',
                    'BD PROSES<br>NON POGEN',
                    'BD MTC<br>POGEN',
                    'BD MTC<br>NON POGEN',
                ],
                colWidths: [100, 100, 100, 100, 100, 100],
                columns: [
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                    { type: 'text' },
                ],
            });
        });
    }

    function wo_planing_refresh(){
        $.ajax({
            method: "POST",
            url: SITE_URL + "main/wo_planing",
            data: {
                tahun: $("#tahun").val(),
                bulan: $("#bulan").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            dtwp = JSON.parse(msg);

            $('#wo_planing').jexcel({
                data: dtwp,
                allowInsertColumn: false,
                colHeaders: [
                    'Site / Pabrik',
                    'Total WO Plan',
                    "1","2","3","4","5","6","7","8","9","10",
                    "11","12","13","14","15","16","17","18","19","20",
                    "21","22","23","24","25","26","27","28","29","30","31",            
                ],
                colWidths: [100, 100, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, ],
                columns: [
                    { type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },
                    { type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },
                    { type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },
                    { type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },
                    { type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },
                    { type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },{ type: 'text' },
                    { type: 'text' },{ type: 'text' },{ type: 'text' }
                ]
            });

            $('#wo_planing').jexcel('updateSettings', {
                table: function (instance, cell, col, row, val, id) {
                    if (col > 1 ) {
                        var nilai = parseFloat(val);
                        if (!isNaN(nilai)) {
                            $(cell).css('background-color', '#00ff00');
                        } else {
                            $(cell).css('background-color', '#ff0000');
                        }
                    }
                }
            });

        });
    }

    function ho_stat_refresh(){
        $("#per-site").hide();
        $("#all-site").show();
        wo_all_site_refresh();
        bdt_all_site_refresh();
        bdl_all_site_refresh();
        wo_planing_refresh();
        // bdu_all_site_refresh();
    }

    $("#pabrik").change(function(){
        document.querySelector("#tgl_job").valueAsDate = new Date();
        if($("#pabrik").val()!=="ALL SITE"){
            pabrik_refresh();
        }else{
            ho_stat_refresh();
        }
    });

    document.querySelector("#tgl_job").valueAsDate = new Date();

    if($("#pabrik").val()!=="ALL SITE"){
        pabrik_refresh();
    }else{
        ho_stat_refresh();
    }

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

});