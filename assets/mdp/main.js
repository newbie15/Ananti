$(function () {
    var problem_chart = $("#donut-chart");

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


        // d['high_maintenance_unit'].forEach(element =>{
            
        // });
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