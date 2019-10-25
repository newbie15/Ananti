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


    handler = function (obj, cell, val) {
        r = $(cell).prop('id').split('-');
        row = parseInt(r[1]);
        r = row+1;

        if (val == "Project Id Release") {
            $('#my-PI').jexcel('setValue', 'L' + r, "10%");
        } else if (val == "Fabrikasi") {
            $('#my-PI').jexcel('setValue', 'L' + r, "40%");
        } else if (val == "Mesin On Site") {
            $('#my-PI').jexcel('setValue', 'L' + r, "70%");
        } else if (val == "Install") {
            $('#my-PI').jexcel('setValue', 'L' + r, "95%");
        } else if (val == "Testing Commisioning") {
            $('#my-PI').jexcel('setValue', 'L' + r, "100%");
        }

    };

    function refreshPI(){
        if (dataPI == undefined) {
            dataPI = [];
        }

        $('#my-PI').jexcel({
            data: dataPI,
            colHeaders: [
                'Project ID', 'Tipe', 'Desc', 'Qty', 'u/m', 'Budget', 'PK/PO', 'Status<br>PI', 'Due Date', 'PIC', 'Kategori<br>Progress', 'Progress<br>%'],
            colWidths: [100, 100, 250, 80, 50, 100, 50, 60, 100, 50, 200, 100],
            columns: [
                // { type: 'autocomplete', source: ['loading ramp', 'sterilizer', 'thresher', 'press', 'bunch press', 'kernel', 'klarifikasi', 'boiler', 'effluent', 'dispatch'] },
                { type: 'text' },
                { type: 'dropdown', source: ['Mill Replacement', 'HO Project'] },
                { type: 'text' },
                { type: 'text' },
                { type: 'dropdown', source: ['Pcs', 'Lot', 'Unit', 'Meter'] },
                { type: 'text' },
                { type: 'dropdown', source: ['PK', 'PO'] },
                { type: 'dropdown', source: ['Process', 'Approve', 'Cancel', 'Dialihkan'] },
                { type: 'calendar', option: { format: 'MM/YYYY', time: 0 } },
                { type: 'dropdown', source: ['Site', 'WSC', 'HO'] },
                { type: 'dropdown', source: ['Project Id Release', 'Fabrikasi', 'Mesin On Site', 'Install', 'Testing Commisioning'] },
                // 10%,40%,70%,95%,100% 
                { type: 'text', wordWrap: true },
            ],
            onchange: handler,
            allowInsertColumn: false,	
        });

        $('#my-PI').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col == 5) {
                    txt = numeral(val).format('0,0');
                    $(cell).html(' ' + txt);
                }
            }
        });

    }
    function refreshPRPO(dataPRPO){
        if (dataPRPO == undefined) {
            dataPRPO = [];
        }

        $('#my-PRPO').jexcel({
            data: dataPRPO,
            allowInsertColumn: false,	
            colHeaders: [
                'Project ID', 'No PR', 'Nominal<br>PR', 'Status', 'No<br>PO', 'Nominal<br>PO', 'Vendor/<br>Supplier', 'Keterangan'],
            colWidths: [100, 100, 100, 130, 100, 100, 200, 350],
            columns: [
                { type: 'autocomplete', url: BASE_URL + 'capex/ajaxPI/' + $("#pabrik").val() +'/'+ $("#tahun").val() },
                { type: 'text' },
                { type: 'text' },
                { type: 'dropdown', source: ['Planned', 'Released', 'Partially Authorized', 'Authorized'] },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ]
        });
        $('#my-PRPO').jexcel('updateSettings', {
            table: function (instance, cell, col, row, val, id) {
                if (col == 2) {
                    txt = numeral(val).format('0,0');
                    $(cell).html(' ' + txt);
                }
                if (col == 5) {
                    txt = numeral(val).format('0,0');
                    $(cell).html(' ' + txt);
                }
            }
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
        var data_PI = $('#my-PI').jexcel('getData');
        console.log(data_PI);

        $.ajax({
            method: "POST",
            url: BASE_URL + "capex/simpanPI",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                bulan: $("#bulan").val(),
                tahun: $("#tahun").val(),
                data_json: JSON.stringify(data_PI),
            }
        }).done(function (msg) {
            console.log(msg);
        });

        var data_PRPO = $('#my-PRPO').jexcel('getData');
        console.log(data_PRPO);

        $.ajax({
            method: "POST",
            url: BASE_URL + "capex/simpanPRPO",
            data: {
                pabrik: $("#pabrik").val(),
                tahun: $("#tahun").val(),
                data_json: JSON.stringify(data_PRPO),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "capex/loadPI",
            data: {
                id_pabrik: $("#pabrik").val(),
                tahun: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            dataPI = JSON.parse(msg);
            console.log(data);
            refreshPI(dataPI);
        });

        $.ajax({
            method: "POST",
            url: BASE_URL + "capex/loadPRPO",
            data: {
                id_pabrik: $("#pabrik").val(),
                tahun: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            dataPRPO = JSON.parse(msg);
            console.log(data);
            refreshPRPO(dataPRPO);
        });
    }

    ajax_refresh();
});
