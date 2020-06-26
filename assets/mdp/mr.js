$(document).ready(function () {
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    data = [];

    unit =[
        ''
    ];

        
    function init_mr_input(params) {
    fdata = [];
    $('#mr-spreadsheet').jexcel({
        data: fdata,
        tableOverflow: true,
        tableHeight: '400px',
        colHeaders: [
            'Order No',
            'Line No',
            'Release No',
            'Order Line Status',
            'LocationNo',
            'Part No',
            'Part Description',
            'Spec 1',
            'U/M',
            'Qty Due',
            'Qty Reserved',
            'Qty Issued',
            'Qty Remaning',
            'Qty Returned',
            'Qty Short',
            'Qty On Order',
            'Cost',
            'Total Value',
            'Cost Center',
            'Cost Center Description',
            'Note',
            'Site',
            'Site Description',
            'Internal Customer',
            'Internal Customer Name',
            'Investment Code',
            'Description',
            'Nomor Referensi BPB',
            'Supply Code',
            'Date Entered',
            'Delivery Date',
            'Due Date',
            'Account',
            'Project',
            'FixedAsset'        
        ],
        colWidths: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100],
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
    }

    init_mr_input();

    function refresh(xdata){
        $('#my-spreadsheet').jexcel({
            data: xdata,
            tableOverflow: true,
            tableHeight: '450px',
            tableWidth: '500px',
            colHeaders: [
                'Part No', 'Part Description', 'Spec 1', 'U/M', 'Qty', 'Total Cost', 'Cost Center Desc', 'Kategori', 'No WO', 'Station', 'Unit', 'Sub Unit'
            ],
            colWidths: [80, 200, 150, 40, 40, 150, 250, 100, 100, 100, 100, 100],
            columns: [
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'dropdown' , source: ['Consumable', 'Maintenance', 'Process' ] },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
                { type: 'text' },
            ]
        });        
    }

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "mr/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                bulan: $("#bulan").val(),
                tahun: $("#tahun").val(),
                tanggal: $("#tanggal").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
            init_mr_input();
        });
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

    $("#tanggal").change(function(){
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

        ajax_refresh();
    });
    $("#bulan").change(function () {
        ajax_refresh();
    });

    $("#pabrik").change(function () {
        ajax_refresh();
        // station_refresh();
    });
    
    $("#station").change(function () {
        unit_refresh();
    });

    $("#unit").change(function () {
        sub_unit_refresh();
    });

    function add() {
        var sama = 0;
        var index = 0;
        dt = $('#mr-spreadsheet').jexcel('getData');
        dx = $('#my-spreadsheet').jexcel('getData');

        console.log(dx);
        console.log(dt);

        ix = 0;
        dt.forEach(element => {
            if (dx[0][0] == "") { // kosong
                dx[0][0] = dt[0][5];
                dx[0][1] = dt[0][6];
                dx[0][2] = dt[0][7];
                dx[0][3] = dt[0][8];
                dx[0][4] = dt[0][9];
                dx[0][5] = dt[0][17];
                dx[0][6] = dt[0][19];
            } else { // isi satu
                dx.push([dt[ix][5], dt[ix][6], dt[ix][7], dt[ix][8], dt[ix][9], dt[ix][17], dt[ix][19], "", "", "", "", ""]);
            }
            ix++;            
        });

        refresh(dx);

        // $("#wo").val("");
        $("#modal-default").modal("hide");
    }

    $("#simpan").click(function () {
        var data = $('#my-spreadsheet').jexcel('getData');
        console.log(data);

        $.ajax({
            method: "POST",
            url: BASE_URL + "mr/simpan",
            success: sukses,
            data: {
                id_pabrik: $("#pabrik").val(),
                bulan: $("#bulan").val(),
                tahun: $("#tahun").val(),
                tanggal: $("#tanggal").val(),
                data_json: JSON.stringify(data),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    ajax_refresh();
    
    $("#tambah").click(function(){
        // station_refresh();
    });

    $("#tplus").click(function () {
        add();
    });



});
