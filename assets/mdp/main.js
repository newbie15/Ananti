$(function () {
    var breakdown_chart = $("#donut-chart");

    var unit_problem = $("#unit_problem");
    var wo_unfinished = $("#wo_unfinished");
    var wo_baru = $("#wo_baru");
    var mill_availibility = $("#mill_avaibility");

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
            colWidths: [100, 150, 225, 75, 50, 100, 60, 100, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ],
        });
    }

    function pabrik_refresh(){
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
    }

    $("#pabrik").change(function(){
        document.querySelector("#tgl_job").valueAsDate = new Date();
        pabrik_refresh();
    });

    document.querySelector("#tgl_job").valueAsDate = new Date();

    pabrik_refresh();

});