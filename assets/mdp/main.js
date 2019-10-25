$(function () {
    var breakdown_chart = $("#donut-chart");
    var unit_problem = $("#unit_problem");
    var wo_unfinished = $("#wo_unfinished");
    var wo_baru = $("#wo_baru");
    var mill_availibility = $("#mill_avaibility");

    var downtime = $("#downtime");
    var breakdown = $("#breakdown");
    var ol = $("#ol");
    var cpkrm = $("#cpkrm");
    var cporm = $("#cporm");
    var sg = $("#sg");


    function refresh(d){
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
            colWidths: [100, 100, 100, 90, 50, 100, 60, 100, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ],
        });

    }

    function pabrik_refresh(){
        downtime.load("main/downtime/" + $("#pabrik").val());
        breakdown.load("main/breakdown/" + $("#pabrik").val());
        ol.load("main/ol/" + $("#pabrik").val());
        cpkrm.load("main/cpkrm/" + $("#pabrik").val());
        cporm.load("main/cporm/" + $("#pabrik").val());
        sg.load("main/sg/" + $("#pabrik").val());
        
        $.ajax({
            method: "POST",
            url: BASE_URL + "main/statistik",
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

        $.ajax({
            method: "POST",
            url: BASE_URL + "main/bd_chart",
            data: {
                id_pabrik: $("#pabrik").val(),
            },
        }).done(function (msg) {
            // console.log(msg);
            var json = JSON.parse(msg);
            // console.log(json);
            var u = parseInt(json.unit);
            var l = parseInt(json.line);
            var p = parseInt(json.pabrik);
            var grp = [
                { label: "Breakdown Unit", data: u },
                { label: "Breakdown Line", data: l },
                { label: "Breakdown Pabrik", data: p }
            ];
            $.plot(breakdown_chart, grp, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 3 / 4,
                            // formatter: labelFormatter,
                            background: {
                                opacity: 0.5,
                                color: '#000'
                            }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });
        });
    }

    $("#pabrik").change(function(){
        pabrik_refresh();
    });

    document.querySelector("#tgl_job").valueAsDate = new Date();

    pabrik_refresh();

});