$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    // console.log("tes");
    // data = [
    //     ['Google', '#542727'],
    //     ['Yahoo', '#724f4f'],
    //     ['Bing', '#b43131'],
    // ];

    // data = JSON.parse($.load("http://localhost/MDP/pabrik/load"));

    $.ajax({
        method: "GET",
        url: SITE_URL+"pabrik/load",
        // data: {
        //     data_json: JSON.stringify(data_j),
        // }
    }).done(function (msg) {
        console.log(msg);
        data = JSON.parse(msg);
        console.log(data);
        $('#my-spreadsheet').jexcel({
            data: data,
            colHeaders: [
                'Site',
                // 'Jenis',
                'Kapasitas',
                'Area',
            ],

            colWidths: [150, 150, 150, 100, 250, 250, 75, 75],
            columns: [
                { type: 'text' },
                { type: 'text' },
                // { type: 'dropdown', source: ['Mill 45 Tph', 'Mill 50 Tph', 'Mill 60 Tph', 'Mill 70 Tph', 'Mill 80 Tph', 'Refinery', 'NPK'] },
                { type: 'dropdown', source: ['Aceh', 'Riau', 'Jambi', 'Kalteng', 'Kaltim', 'Kalsel', 'Sulawesi']
                },
                // { type: 'dropdown', source: ['Crane', 'Tipper', 'CS','Horizontal','Vertical','Oblique'] },
                // { type: 'text' },
            ],
            onchange: handler,
        });
    });

    handler = function (obj, cell, val) {
        console.log('My table id: ' + $(obj).prop('id'));
        console.log('Cell changed: ' + $(cell).prop('id'));
        console.log('Value: ' + val);
    };

    $('#my-spreadsheet').jexcel({
        // url: "http://localhost/MDP/pabrik/load",
        colHeaders: [
            'Site',
            // 'Jenis',
            'Kapasitas',
            'Area',
        ],

        colWidths: [150,150,150,100,250,250,75,75],
        columns: [
            { type: 'text' },
            { type: 'text' },
            // { type: 'dropdown', source: ['Mill 45Tph', 'Mill 50Tph', 'Mill 60Tph', 'Mill 70Tph', 'Mill 80Tph', 'Refinery', 'NPK'] },
            { type: 'dropdown', source: ['Aceh', 'Riau', 'Jambi', 'Kalteng', 'Kaltim', 'Kalsel', 'Sulawesi'] }
            // { type: 'dropdown', source: ['Crane', 'Tipper', 'CS','Horizontal','Vertical','Oblique'] },
            // { type: 'text' },
        ],
        onchange: handler,
        allowInsertColumn: false,
    });

    $("#simpan").click(function(){
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"pabrik/simpan",
            success: sukses,
            data: {
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });
});
