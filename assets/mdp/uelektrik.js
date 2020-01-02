$(document).ready(function(){

    var starter = [];
    starter['kw0.25'] = ['DOL', '-', '-', '-', '-'];
    starter['kw0.37'] = ['DOL', '-', '-', '-', '-'];
    starter['kw0.56'] = ['DOL', '-', '-', '-', '-'];
    starter['kw0.75'] = ['DOL', '-', '-', '-', '-'];
    starter['kw1.1']  = ['DOL', '-', '-', '-', 'INV'];
    starter['kw1.5']  = ['DOL', '-', '-', '-', 'INV'];
    starter['kw1.85'] = ['DOL', '-', '-', '-', 'INV'];
    starter['kw2.2']  = ['DOL', '-', '-', '-', 'INV'];
    starter['kw3.0']  = ['DOL', '-', '-', '-', 'INV'];
    starter['kw3.7']  = ['DOL', '-', '-', '-', 'INV'];
    starter['kw4.0']  = ['DOL', '-', '-', '-', 'INV'];
    starter['kw5.5']  = ['DOL','SD', '-', '-', 'INV'];
    starter['kw7.5']  = ['-' , 'SD', '-', '-', 'INV'];
    starter['kw9.3']  = ['-' , 'SD', '-', '-', 'INV'];
    starter['kw10']   = ['-' , 'SD', '-', '-', 'INV'];
    starter['kw11']   = ['-' , 'SD', '-', '-', 'INV'];
    starter['kw15']   = ['-' , 'SD', '-', '-', 'INV'];
    starter['kw18.5'] = ['-' , 'SD', '-', 'SS', 'INV'];
    starter['kw22']   = ['-' , 'SD', '-', 'SS', 'INV'];
    starter['kw30']   = ['-' , 'SD', 'AT', 'SS', 'INV'];
    starter['kw37']   = ['-' , 'SD', 'AT', 'SS', 'INV'];
    starter['kw45']   = ['-' , 'SD', 'AT', 'SS', 'INV'];
    starter['kw55']   = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw75']   = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw90']   = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw110']  = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw132']  = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw160']  = ['-' , '-' , '-', 'SS', 'INV'];
    starter['kw200']  = ['-' , '-' , '-', 'SS', 'INV'];
    starter['kw250']  = ['-' , '-' , '-', 'SS', 'INV'];
    starter['kw315']  = ['-' , '-' , '-', '-' , 'INV'];

    var mccb = [];
    // mccb['0.25']        = ['3', '-', '-', '-', '-'];
    // mccb['0.37']        = ['4', '-', '-', '-', '-'];
    // mccb['0.56']        = ['4', '-', '-', '-', '-'];
    // mccb['0.75']        = ['6', '-', '-', '-', '-'];
    // mccb['1.1']         = ['6', '-', '-', '-', '6'];
    // mccb['1.5']         = ['9', '-', '-', '-', '9'];
    // mccb['1.85']        = ['9', '-', '-', '-', '9'];
    // mccb['2.2']         = ['10', '-', '-', '-', '10'];
    // mccb['3.0']         = ['14', '-', '-', '-', '14'];
    // mccb['3.7']         = ['14', '-', '-', '-', '14'];
    // mccb['4.0']         = ['14', '-', '-', '-', '14'];
    // mccb['5.5']         = ['16', '16', '-', '-', '16'];
    // mccb['7.5']         = ['-', '20', '-', '-', '20'];
    // mccb['9.3']         = ['-', '20', '-', '-', '20'];
    // mccb['10']          = ['-', '22', '-', '-', '22'];
    // mccb['11']          = ['-', '22', '-', '-', '22'];
    // mccb['15']          = ['-', '32', '-', '-', '32'];
    // mccb['18.5']        = ['-', '40', '-', '40', '40'];
    // mccb['22']          = ['-', '50', '-', '50', '50'];
    // mccb['30']          = ['-', '65', '65', '65', '65'];
    // mccb['37']          = ['-', '65', '65', '65', '65'];
    // mccb['45']          = ['-', '100', '100', '100', '100'];
    // mccb['55']          = ['-', '-', '100', '100', '100'];
    // mccb['75']          = ['-', '-', '150', '150', '150'];
    // mccb['90']          = ['-', '-', '220', '220', '250'];
    // mccb['110']         = ['-', '-', '250', '250', '250'];
    // mccb['132']         = ['-', '-', '250', '250', '250'];
    // mccb['160']         = ['-', '-', '-', '400', '400'];
    // mccb['200']         = ['-', '-', '-', '630', '630'];
    // mccb['250']         = ['-', '-', '-', '630', '630'];
    // mccb['315']         = ['-', '-', '-', '-', '630'];

    mccb['kw0.25']        = 3;
    mccb['kw0.37']        = 4;
    mccb['kw0.56']        = 4;
    mccb['kw0.75']        = 6;
    mccb['kw1.1']         = 6;
    mccb['kw1.5']         = 9;
    mccb['kw1.85']        = 9;
    mccb['kw2.2']         = 10;
    mccb['kw3.0']         = 14;
    mccb['kw3.7']         = 14;
    mccb['kw4.0']         = 14;
    mccb['kw5.5']         = 16;
    mccb['kw7.5']         = 20;
    mccb['kw9.3']         = 20;
    mccb['kw10']          = 22;
    mccb['kw11']          = 22;
    mccb['kw15']          = 32;
    mccb['kw18.5']        = 40;
    mccb['kw22']          = 50;
    mccb['kw30']          = 65;
    mccb['kw37']          = 65;
    mccb['kw45']          = 100;
    mccb['kw55']          = 100;
    mccb['kw75']          = 150;
    mccb['kw90']          = 250;
    mccb['kw110']         = 250;
    mccb['kw132']         = 250;
    mccb['kw160']         = 400;
    mccb['kw200']         = 630;
    mccb['kw250']         = 630;
    mccb['kw315']         = 630;

    var kw      = null;
    
    
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
                        // 'Station',
                        // 'Kode Asset',
                        '<br>Unit',
                        '<br>Merk',
                        '<br>KW',
                        '<br>class',
                        '<br>starter',
                        'MCCB<br>(Ampere)',
                        'Kontaktor<br>line<br>(Ampere)',
                        'Kontaktor<br>delta<br>(Ampere)',
                        'Kontaktor<br>star<br>(Ampere)',
                        'Kabel<br>(mm2)',
                        'Kabel<br>tiap<br>Fasa',
                    ],

                    colWidths: [300,100, 60, 50, 75, 75, 75, 100, 100, 100],
                    columns: [
                        { type: 'text' },
                        { type: 'text' },
                        // { type: 'autocomplete', url: BASE_URL + 'station/ajax/' + $("#pabrik").val() },
                        { type: 'dropdown', source: ['0.25', '0.37', '0.56', '0.75', '1.1', '1.5', '1.85', '2.2', '3.0', '3.7', '4.0', '5.5', '7.5', '9.3', '10', '11', '15', '18', '22', '30', '37', '45', '55', '75', '90', '110', '130', '150'] },
                        { type: 'dropdown', source: ['A', 'B', 'C'] },
                        { type: 'dropdown', source: ['DOL', 'Star-Delta', 'Autotrafo', 'Softstarter', 'Inverter'] },
                        { type: 'dropdown', source: ['1', '2', '3', '4', '6', '9', '10', '12', '14', '16', '18', '20', '22', '25', '30', '32', '40', '50', '60', '75', '80', '100', '125', '150', '160', '200', '225', '250', '320', '350', '400', '630', '800', '1000'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '16', '18', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '150', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '16', '18', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '150', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '16', '18', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '150', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['1.5', '2.5', '4', '6', '10', '16', '25', '35', '50', '70', '95', '120', '150', '185', '240', '300', '400', '500', '630'] },
                        { type: 'dropdown', source: ['1', '2', '3', '4', '5', '6'] },
                        // { type: 'text' },
                        // { type: 'text' },
                    ]
                });

                $('#my-spreadsheet').jexcel('updateSettings', {
                    table: function (instance, cell, col, row, val, id) {
                        console.log(cell);
                        console.log(col);
                        console.log(row);
                        console.log(val);
                        console.log(id);

                        if (col > 2 && col < 12) {
                            // if (val != "0") {
                            //     var a = 0;
                            //     var b = 0;
                            //     if (data == [] || data == null) {
                            //         a = 0;
                            //         b = 0;
                            //     } else {
                            //         try {
                            //             a = data[row];
                            //             b = parseInt(a[1]);
                            //             console.log(b);
                            //         } catch (error) {

                            //         }
                            //     }
                            //     if (val < ((b * 1000 / (1.73 * 380)) * 0.5)) {
                            //         $(cell).css('background-color', '#ff0000');
                            //         $(cell).css('color', '#fff');
                            //     } else if (val <= ((b * 1000 / (1.73 * 380)) * 0.75)) {
                            //         $(cell).css('background-color', '#ffff00');
                            //         $(cell).css('color', '#000');
                            //     } else {
                            //         $(cell).css('background-color', '#1aab68');
                            //         $(cell).css('color', '#fff');
                            //     }
                            // } else {
                            //     $(cell).css('background-color', '#ffffff');
                            // }
                        }
                    }
                });
            });

        }else{
            $.ajax({
                method: "POST",
                url: BASE_URL + "uelektrik/load",
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
                        // 'Station',
                        // 'Kode Asset',
                        '<br>Unit',
                        '<br>Merk',
                        '<br>KW',
                        '<br>class',
                        '<br>starter',
                        'MCCB<br>(Ampere)',
                        'Kontaktor<br>line<br>(Ampere)',
                        'Kontaktor<br>delta<br>(Ampere)',
                        'Kontaktor<br>star<br>(Ampere)',
                        'Kabel<br>(mm2)',
                        'Kabel<br>tiap<br>Fasa',

                    ],

                    colWidths: [300,100, 60, 50, 75, 75, 75, 100, 100, 100],
                    columns: [
                        { type: 'text' },
                        { type: 'text' },
                        // { type: 'autocomplete', url: BASE_URL + 'station/ajax/' + $("#pabrik").val() },
                        { type: 'dropdown', source: ['0.25', '0.37', '0.56', '0.75', '1.1', '1.5', '1.85', '2.2', '3.0', '3.7', '4.0', '5.5', '7.5', '9.3', '10', '11', '15', '18.5', '22', '30', '37', '45', '55', '75', '90', '110', '132', '160','200','250','315'] },
                        { type: 'dropdown', source: ['A', 'B', 'C'] },
                        { type: 'dropdown', source: ['DOL', 'Star-Delta', 'Autotrafo', 'Softstarter', 'Inverter'] },
                        { type: 'dropdown', source: ['1', '2', '3', '4', '6', '9', '10', '12', '14', '16', '18', '20', '22', '25', '30', '32', '40', '50', '60', '75', '80', '100', '125', '150', '160', '200', '225', '250', '320', '350', '400', '630', '800', '1000'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '15', '16', '18', '20', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '135', '150', '175', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '15', '16', '18', '20', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '135', '150', '175', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '15', '16', '18', '20', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '135', '150', '175', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['1.5', '2.5', '4', '6', '10', '16', '25', '35', '50', '70', '95', '120', '150', '185', '240', '300', '400', '500', '630'] },
                        { type: 'dropdown', source: ['1', '2', '3', '4', '5', '6'] },
                        // { type: 'text' },
                        // { type: 'text' },
                    ]
                });

                $('#my-spreadsheet').jexcel('updateSettings', {
                    table: function (instance, cell, col, row, val, id) {
                        // console.log(cell);
                        // console.log(col);
                        // console.log(row);
                        // console.log(val);
                        // console.log(id);
                        // var kw = null;
                        // console.log("col :"+ col +" row :"+ row);
                        if (col > 1 && col < 11) {
                            if(col==2){
                                kw = val;
                            }
                            if(col==4){
                                console.log(starter["kw"+kw]);
                                if(val == "DOL"){
                                    if (starter["kw" + kw][0] == "DOL") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                }else if (val == "Star-Delta") {
                                    if (starter["kw" + kw][1] == "SD") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                }else if (val == "Autotrafo") {
                                    if (starter["kw" + kw][2] == "AT") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                }else if (val == "Softstarter") {
                                    if (starter["kw" + kw][3] == "SS") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                }else if (val == "Inverter") {
                                    if (starter["kw" + kw][4] == "INV") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                }
                            }
                            if(col==5){
                                if (kw != undefined) {
                                    if (val >= mccb["kw" + kw]) {
                                        console.log(mccb["kw" + kw]);
                                        if (val >= 1.5 * (mccb["kw" + kw])){
                                            $(cell).css('background-color', '#ff0');
                                        }else{
                                            $(cell).css('background-color', '#1aab68');
                                        }
                                    } else {
                                        if(val>0){
                                            $(cell).css('background-color', '#ff0000');
                                        }
                                    }
                                }else{

                                }
                            }

                            // if (val != "0") {
                            //     var a = 0;
                            //     var b = 0;
                            //     if (data == [] || data == null) {
                            //         a = 0;
                            //         b = 0;
                            //     } else {
                            //         try {
                            //             a = data[row];
                            //             b = parseInt(a[1]);
                            //             console.log(b);
                            //         } catch (error) {

                            //         }
                            //     }
                            //     if (val < ((b * 1000 / (1.73 * 380)) * 0.5)) {
                            //         $(cell).css('background-color', '#ff0000');
                            //         $(cell).css('color', '#fff');
                            //     } else if (val <= ((b * 1000 / (1.73 * 380)) * 0.75)) {
                            //         $(cell).css('background-color', '#1aab68');
                            //         $(cell).css('color', '#000');
                            //     } else {
                            //         $(cell).css('background-color', '#1aab68');
                            //         $(cell).css('color', '#fff');
                            //     }
                            // } else {
                            //     $(cell).css('background-color', '#ffffff');
                            // }
                        }
                    }
                });


            });

        }
    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"uelektrik/simpan",
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

    // $('#my-spreadsheet').jexcel({
    //     // data: data,
    //     colHeaders: [
    //         'Station',
    //         'Kode Asset',
    //         'Unit',
    //     ],

    //     colWidths: [150,150,150,100,250,250,75,75],
    //     columns: [
    //         { type: 'autocomplete', url: 'http://localhost/MDP/station/ajax/'+$("#pabrik").val() },
    //         { type: 'text' },
    //         { type: 'text' },
    //     ]
    // });

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "uelektrik/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                // d: $("#tanggal").val(),
                // m: $("#bulan").val(),
                // y: $("#tahun").val(),
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
                    // alert("success");
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

    // $("#pabrik").change(function () {
    //     refresh();
    // });

});
