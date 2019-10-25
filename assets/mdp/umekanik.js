$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh(data) {
        if (data.length < 1){
            $.ajax({
                method: "POST",
                url: BASE_URL + "unit/ajax_default_list",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    id_station: $("#station").val(),
                }
            }).done(function (msg) {
                console.log(msg);
                data = JSON.parse(msg);
                console.log(data);
                x = data;
                $('#my-spreadsheet').jexcel({
                    data: data,
                    allowInsertColumn: false,

                    colHeaders: [
                        '<br>Unit',
                        'Merk<br>Gearbox',
                        'Kapasitas<br>Gearbox',
                        'Rasio<br>Gearbox',
                        'Type<br>Gearbox',
                        'Pulley<br>Motor',
                        'Pulley<br>Driven',
                        'Pulley<br>Type',
                        'Merk<br>Pompa',
                        'Type<br>Pompa',
                        'Kapasitas<br>Pompa',
                    ],

                    colWidths: [300, 75, 75, 75, 75, 75, 75, 75, 100,100,100],
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
                        { type: 'text' },
                    ]
                });
            });
        }else{
            $.ajax({
                method: "POST",
                url: BASE_URL + "umekanik/load",
                data: {
                    id_pabrik: $("#pabrik").val(),
                    id_station: $("#station").val(),
                }
            }).done(function (msg) {
                console.log(msg);
                data = JSON.parse(msg);
                console.log(data);
                $('#my-spreadsheet').jexcel({
                    data: data,
                    allowInsertColumn: false,
                    colHeaders: [
                        '<br>Unit',
                        'Merk<br>Gearbox',
                        'Kapasitas<br>Gearbox',
                        'Rasio<br>Gearbox',
                        'Type<br>Gearbox',
                        'Pulley<br>Motor',
                        'Pulley<br>Driven',
                        'Pulley<br>Type',
                        'Merk<br>Pompa',
                        'Type<br>Pompa',
                        'Kapasitas<br>Pompa',
                    ],
                    colWidths: [300, 75, 75, 75, 75, 75, 75, 75, 100, 100, 100],
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
                        { type: 'text' },
                    ]
                });
            });
        }
    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);
        $.ajax({
            method: "POST",
            url: BASE_URL+"umekanik/simpan",
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

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "umekanik/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }


    function station_refresh() {
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    ajax_refresh();
                } else {
                    // alert("gaagal");
                }
            }
        );
    }

    $("#pabrik").change(function () {
        station_refresh();
    });

    $("#station").change(function () {
        ajax_refresh();
    });
    
    station_refresh();

});
