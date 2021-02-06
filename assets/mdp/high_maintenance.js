$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    function station_refresh() {
        $("#station").load(SITE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    unit_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function unit_refresh(){
        // console.log(SITE_URL + "unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()));
        $("#unit").load(SITE_URL + "unit/ajax_dropdown_all/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    // alert("success");
                    // ajax_refresh();
                    refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    function ajax_refresh() {
        refresh();
    }

    function refresh() {

        var id_pabrik = $("#pabrik").val();
        var id_station = $("#station").val();
        var id_unit = $("#unit").val();
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();

        console.log(SITE_URL + 'high_maintenance/loadcsv/' + id_pabrik + "/" + encodeURI(id_station) + "/" + encodeURI(id_unit) + "/" + tahun + "/" + bulan);

        // jexcel(document.getElementById('#my-spreadsheet'), {
        $("#my-spreadsheet").html("");
        jexcel(document.getElementById('my-spreadsheet'), {
            csv: SITE_URL + 'high_maintenance/loadcsv/' + id_pabrik + "/" + encodeURI(id_station) + "/" + encodeURI(id_unit) + "/" + tahun + "/" + bulan,
            csvHeaders: true,
            search: true,
            pagination: 10,
            columns: [
                { type: 'text', width: 150 },
                { type: 'text', width: 150 },
                { type: 'text', width: 250 },
                { type: 'text', width: 100 },
                { type: 'text', width: 100 },
                { type: 'text', width: 75 },
            ]
        }); 

        graph_refresh();

    }

    function graph_refresh() {
        $.ajax({
            method: "POST",
            url: SITE_URL + "high_maintenance/statistik",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                tahun: $("#tahun").val(),
                bulan: $("#bulan").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            try {
                refresh_pie(data.station_list);                
            } catch (error) {
                console.log(error.toString());
            }
        });
    }

    function refresh_pie(dx){
        var dt = [];

        console.log(dx);
        var i = 0;

        dx.forEach(element => {
            dt[i] = {
                label: element[0],
                data: parseInt(element[1])
            }
            i++;
        });

        try {
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
        } catch (error) {
            console.log(error.toString());
        }

    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"unit/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),

                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    $("#pabrik").change(function () {
        station_refresh();
    });

    $("#station").change(function () {
        unit_refresh();
    });

    $("#unit").change(function () {
        ajax_refresh();
    });

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

        // graph_refresh();
        refresh();
    });

    $("#bulan").change(function(){
        // graph_refresh();
        refresh();
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

    station_refresh();

    


});
