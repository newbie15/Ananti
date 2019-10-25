$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];

    // load a locale
    numeral.register('locale', 'id', {
        delimiters: {
            thousands: '.',
            decimal: ','
        },
        abbreviations: {
            thousand: 'rb',
            million: 'jt',
            billion: 'M',
            trillion: 'T'
        },
        ordinal: function (number) {
            return number === 1 ? 'er' : 'ème';
        },
        currency: {
            symbol: 'Rp'
        }
    });

    // switch between locales
    numeral.locale('id');

    data = [
        ['Januari'],
        ['Februari'],
        ['Maret'],
        ['April'],
        ['Mei'],
        ['Juni'],
        ['Juli'],
        ['Agustus'],
        ['September'],
        ['Oktober'],
        ['November'],
        ['Desember'],
    ];

    function refresh(data){
        // alert(data.length);
        if (data.length < 1) {
            data = [
                ['Januari'],
                ['Februari'],
                ['Maret'],
                ['April'],
                ['Mei'],
                ['Juni'],
                ['Juli'],
                ['Agustus'],
                ['September'],
                ['Oktober'],
                ['November'],
                ['Desember'],
            ];
        }

        $('#my-spreadsheet').jexcel({
            data: data,
            colHeaders: [
                'Bulan',
                'Norma Min',
                'Norma Max',
                'Nilai Stok',
                'Shortage',
                'Normal',
                'Excess',
                'Undefined',
            ],
            colWidths: [100, 250, 250, 250, 100, 100, 100, 100, 100, 100],
            columns: [
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
    }



    $("#pabrik").change(function () {
        ajax_refresh();
    });
    $("#tahun").change(function () {
        ajax_refresh();
    });

    var tgl = new Date();
    var y = tgl.getFullYear();
    $("#tahun").val(y.toString());


    $("#simpan").click(function () {
        var data = $('#my-spreadsheet').jexcel('getData');
        console.log(data);

        $.ajax({
            method: "POST",
            url: BASE_URL + "inventory/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                tahun: $("#tahun").val(),
                data_json: JSON.stringify(data),
            }
        }).done(function (msg) {
            console.log(msg);
        });

    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "inventory/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                tahun: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }

    ajax_refresh();

});
