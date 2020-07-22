$(document).ready(function(){

    var starter = [];
    starter['kw0.25']   = ['DOL', '-', '-',  '-',    '-'];
    starter['kw0.37']   = ['DOL', '-', '-',  '-',    '-'];
    starter['kw0.56']   = ['DOL', '-', '-',  '-',    '-'];
    starter['kw0.75']   = ['DOL', '-', '-',  '-',    '-'];
    starter['kw1.1']    = ['DOL', '-', '-',  '-',  'INV'];
    starter['kw1.5']    = ['DOL', '-', '-',  '-',  'INV'];
    starter['kw1.85']   = ['DOL', '-', '-',  '-',  'INV'];
    starter['kw2.2']    = ['DOL', '-', '-',  '-',  'INV'];
    starter['kw3']      = ['DOL', '-', '-',  '-',  'INV'];
    starter['kw3.7']    = ['DOL', '-', '-',  '-',  'INV'];
    starter['kw4']      = ['DOL', '-', '-',  '-',  'INV'];
    starter['kw5.5']    = ['DOL','SD', '-',  '-',  'INV'];
    starter['kw7.5']    = ['-' , 'SD', '-',  '-',  'INV'];
    starter['kw9.3']    = ['-' , 'SD', '-',  '-',  'INV'];
    starter['kw10']     = ['-' , 'SD', '-',  '-',  'INV'];
    starter['kw11']     = ['-' , 'SD', '-',  '-',  'INV'];
    starter['kw15']     = ['-' , 'SD', '-',  '-',  'INV'];
    starter['kw18.5']   = ['-' , 'SD', '-',  'SS', 'INV'];
    starter['kw22']     = ['-' , 'SD', '-',  'SS', 'INV'];
    starter['kw30']     = ['-' , 'SD', 'AT', 'SS', 'INV'];
    starter['kw37']     = ['-' , 'SD', 'AT', 'SS', 'INV'];
    starter['kw45']     = ['-' , 'SD', 'AT', 'SS', 'INV'];
    starter['kw55']     = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw75']     = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw90']     = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw110']    = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw132']    = ['-' , '-' , 'AT', 'SS', 'INV'];
    starter['kw160']    = ['-' , '-' , '-',  'SS', 'INV'];
    starter['kw200']    = ['-' , '-' , '-',  'SS', 'INV'];
    starter['kw250']    = ['-' , '-' , '-',  'SS', 'INV'];
    starter['kw315']    = ['-' , '-' , '-',  '-' , 'INV'];


    var kntkr = [];
    //                 DOL   Star delta       Autotrafo        SS     INV
    kntkr['kw0.25']	=	[ [6]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw0.37']	=	[ [6]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw0.56']	=	[ [6]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw0.75']	=	[ [6]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw1.1']	=	[ [6]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw1.5']	=	[ [6]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw1.85']	=	[ [6]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw2.2']	=	[ [6]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw3']	=	[ [9]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw3.7']	=	[ [9]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw4']	=	[ [9]   , ['','','']    , ['','','']    , ['']  , [''] ];
    kntkr['kw5.5']	=	[ [12]  , [6,6,6]       , ['','','']    , ['']  , [12] ];
    kntkr['kw7.5']	=	[ ['']  , [9,9,6]       , ['','','']    , ['']  , [20] ];
    kntkr['kw9.3']	=	[ ['']  , [12,12,9]     , ['','','']    , ['']  , [25] ];
    kntkr['kw10']	=	[ ['']  , [12,12,9]     , ['','','']    , ['']  , [25] ];
    kntkr['kw11']	=	[ ['']  , [12,12,9]     , ['','','']    , ['']  , [25] ];
    kntkr['kw15']	=	[ ['']  , [18,18,12]    , ['','','']    , ['']  , [32] ];
    kntkr['kw18.5']	=	[ ['']  , [18,18,12]    , ['','','']    , [40]  , [40] ];
    kntkr['kw22']	=	[ ['']  , [32,32,15]    , ['','','']    , [50]  , [50] ];
    kntkr['kw30']	=	[ ['']  , [32,32,25]    , [18,32,65]    , [65]  , [65] ];
    kntkr['kw37']	=	[ ['']  , [40,40,25]    , [40,60,85]    , [85]  , [85] ];
    kntkr['kw45']	=	[ ['']  , [50,50,32]    , [50,60,85]    , [85]  , [85] ];
    kntkr['kw55']	=	[ ['']  , ['','','']    , [50,85,115]   , [115] , [115] ];
    kntkr['kw75']	=	[ ['']  , ['','','']    , [85,115,150]  , [150] , [150] ];
    kntkr['kw90']	=	[ ['']  , ['','','']    , [115,150,185] , [185] , [185] ];
    kntkr['kw110']	=	[ ['']  , ['','','']    , [115,185,225] , [225] , [225] ];
    kntkr['kw132']	=	[ ['']  , ['','','']    , [150,185,265] , [265] , [265] ];
    kntkr['kw160']	=	[ ['']  , ['','','']    , ['','','']    , [330] , [330] ];
    kntkr['kw200']	=	[ ['']  , ['','','']    , ['','','']    , [400] , [400] ];
    kntkr['kw220']	=	[ ['']  , ['','','']    , ['','','']    , [400] , [400] ];
    kntkr['kw250']	=	[ ['']  , ['','','']    , ['','','']    , [500] , [500] ];
    kntkr['kw315']	=	[ ['']  , ['','','']    , ['','','']    , ['']  , [600] ];

    var mccb = [];
    mccb['kw0.25']        = 3;
    mccb['kw0.37']        = 4;
    mccb['kw0.56']        = 4;
    mccb['kw0.75']        = 6;
    mccb['kw1.1']         = 6;
    mccb['kw1.5']         = 9;
    mccb['kw1.85']        = 9;
    mccb['kw2.2']         = 10;
    mccb['kw3']           = 14;
    mccb['kw3.7']         = 14;
    mccb['kw4']           = 14;
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

    var kabel = [];
    kabel['kw0.25'] = 1.5;
    kabel['kw0.37'] = 1.5;
    kabel['kw0.56'] = 1.5;
    kabel['kw0.75'] = 1.5;
    kabel['kw1.1'] = 1.5;
    kabel['kw1.5'] = 1.5;
    kabel['kw1.85'] = 1.5;
    kabel['kw2.2'] = 1.5;
    kabel['kw3'] = 1.5;
    kabel['kw3.7'] = 1.5;
    kabel['kw4'] = 2.5;
    kabel['kw5.5'] = 2.5;
    kabel['kw7.5'] = 2.5;
    kabel['kw9.3'] = 2.5;
    kabel['kw10'] = 4;
    kabel['kw11'] = 4;
    kabel['kw15'] = 4;
    kabel['kw18.5'] = 4;
    kabel['kw22'] = 6;
    kabel['kw30'] = 10;
    kabel['kw37'] = 16;
    kabel['kw45'] = 16;
    kabel['kw55'] = 35;
    kabel['kw75'] = 70;
    kabel['kw90'] = 70;
    kabel['kw110'] = 120;
    kabel['kw132'] = 150;
    kabel['kw160'] = 240;
    kabel['kw200'] = 300;
    kabel['kw220'] = 185;
    kabel['kw250'] = 185;
    kabel['kw315'] = 185;

    var jml_kabel = [];
    jml_kabel['kw0.25']     = 1;
    jml_kabel['kw0.37']     = 1;
    jml_kabel['kw0.56']     = 1;
    jml_kabel['kw0.75']     = 1;
    jml_kabel['kw1.1']      = 1;
    jml_kabel['kw1.5']      = 1;
    jml_kabel['kw1.85']     = 1;
    jml_kabel['kw2.2']      = 1;
    jml_kabel['kw3']        = 1;
    jml_kabel['kw3.7']      = 1;
    jml_kabel['kw4']        = 1;
    jml_kabel['kw5.5']      = 1;
    jml_kabel['kw7.5']      = 1;
    jml_kabel['kw9.3']      = 1;
    jml_kabel['kw10']       = 1;
    jml_kabel['kw11']       = 1;
    jml_kabel['kw15']       = 1;
    jml_kabel['kw18.5']     = 1;
    jml_kabel['kw22']       = 1;
    jml_kabel['kw30']       = 1;
    jml_kabel['kw37']       = 1;
    jml_kabel['kw45']       = 1;
    jml_kabel['kw55']       = 1;
    jml_kabel['kw75']       = 1;
    jml_kabel['kw90']       = 1;
    jml_kabel['kw110']      = 1;
    jml_kabel['kw132']      = 1;
    jml_kabel['kw160']      = 1;
    jml_kabel['kw200']      = 1;
    jml_kabel['kw220']      = 2;
    jml_kabel['kw250']      = 2;
    jml_kabel['kw315']      = 2;


    var kw      = null;
    var starterx = null;
    
    
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }

    function refresh(data) {
        if (data.length < 1){
            $.ajax({
                method: "POST",
                url: BASE_URL + "uelektrik/ajax_default_list",
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
                        '<br>Sub Unit',
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

                    colWidths: [300,300,100, 60, 50, 75, 75, 75, 100, 100, 100],
                    columns: [
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        // { type: 'autocomplete', url: BASE_URL + 'station/ajax/' + $("#pabrik").val() },
                        { type: 'dropdown', source: ['0.25', '0.37', '0.56', '0.75', '1.1', '1.5', '1.85', '2.2', '3', '3.7', '4', '5.5', '7.5', '9.3', '10', '11', '15', '18', '22', '30', '37', '45', '55', '75', '90', '110', '132', '160', '200', '220', '250', '315'] },
                        { type: 'dropdown', source: ['A', 'B', 'C'] },
                        { type: 'dropdown', source: ['DOL', 'Star-Delta', 'Autotrafo', 'Softstarter', 'Inverter'] },
                        { type: 'dropdown', source: ['1', '2', '3', '4', '6', '9', '10', '12', '14', '16', '18', '20', '22', '25', '30', '32', '40', '50', '60', '75', '80', '100', '125', '150', '160', '200', '225', '250', '320', '350', '400', '630', '800', '1000'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '16', '18', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '150', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '16', '18', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '150', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['0', '6', '9', '12', '16', '18', '25', '32', '38', '40', '50', '65', '80', '95', '100', '115', '125', '150', '185', '225', '265', '330', '400', '500', '630', '800'] },
                        { type: 'dropdown', source: ['1.5', '2.5', '4', '6', '10', '16', '25', '35', '50', '70', '95', '120', '150', '185', '240', '300', '400', '500', '630'] },
                        { type: 'dropdown', source: ['1', '2', '3', '4', '5', '6'] },
                    ]
                });

                $('#my-spreadsheet').jexcel('updateSettings', {
                    table: function (instance, cell, col, row, val, id) {
                        console.log(cell);
                        console.log(col);
                        console.log(row);
                        console.log(val);
                        console.log(id);

                        if (col > 3 && col < 13) {
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
                        '<br>Sub Unit',
                        '<br>Merk',
                        '<br>KW',
                        '<br>class',
                        '<br>starter',
                        'MCCB<br>(Ampere)',
                        'Kontaktor<br>line / 50%<br>(Ampere)',
                        'Kontaktor<br>delta / 75%<br>(Ampere)',
                        'Kontaktor<br>star / 100%<br>(Ampere)',
                        'Kabel<br>(mm2)',
                        'Kabel<br>tiap<br>Fasa',

                    ],

                    colWidths: [300, 300,100, 60, 50, 75, 75, 75, 100, 100, 100],
                    columns: [
                        { type: 'text' },
                        { type: 'text' },
                        { type: 'text' },
                        // { type: 'autocomplete', url: BASE_URL + 'station/ajax/' + $("#pabrik").val() },
                        { type: 'dropdown', source: ['0.25', '0.37', '0.56', '0.75', '1.1', '1.5', '1.85', '2.2', '3', '3.7', '4', '5.5', '7.5', '9.3', '10', '11', '15', '18', '22', '30', '37', '45', '55', '75', '90', '110', '132', '160', '200', '220', '250', '315'] },
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
                        if (col > 2 && col < 12) {
                            if(col==3){
                                kw = val;
                            }
                            if(col==5){
                                console.log(starter["kw"+kw]);
                                if(val == "DOL"){
                                    if (starter["kw" + kw][0] == "DOL") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                    starterx = 0;
                                }else if (val == "Star-Delta") {
                                    if (starter["kw" + kw][1] == "SD") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                    starterx = 1;

                                }else if (val == "Autotrafo") {
                                    if (starter["kw" + kw][2] == "AT") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                    starterx = 2;

                                }else if (val == "Softstarter") {
                                    if (starter["kw" + kw][3] == "SS") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                    starterx = 3;

                                }else if (val == "Inverter") {
                                    if (starter["kw" + kw][4] == "INV") {
                                        $(cell).css('background-color', '#1aab68');
                                    }else{
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                    starterx = 4;

                                }
                            }
                            if(col==6){
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

                            if (col == 7) {
                                // console.log(val);
                                if (kw != undefined) {
                                    if(starterx == 0){
                                        console.log("val line = " + val);
                                        console.log("k line  = " + kntkr["kw" + kw][starterx]);
                                        if (parseInt(val) >= parseInt(kntkr["kw" + kw][starterx])){
                                            if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx])){
                                                $(cell).css('background-color', '#ff0');
                                            }else{
                                                $(cell).css('background-color', '#1aab68');
                                            }
                                        }else{
                                            $(cell).css('background-color', '#ff0000');
                                        }
                                    }

                                    if (starterx == 1) {
                                        console.log("val line = " + val);
                                        console.log("k line  = " + kntkr["kw" + kw][starterx][0]);
                                        if (val >= parseInt(kntkr["kw" + kw][starterx][0])) {
                                            if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx][0])) {
                                                $(cell).css('background-color', '#ff0');
                                            } else {
                                                $(cell).css('background-color', '#1aab68');
                                            }
                                        } else {
                                            $(cell).css('background-color', '#ff0000');
                                        }
                                    }
                                    
                                    if (starterx == 2) {
                                        console.log("val line = " + val);
                                        console.log("k line  = " + kntkr["kw" + kw][starterx][0]);
                                        if (val >= parseInt(kntkr["kw" + kw][starterx][0])) {
                                            if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx][0])) {
                                                $(cell).css('background-color', '#ff0');
                                            } else {
                                                $(cell).css('background-color', '#1aab68');
                                            }
                                        } else {
                                            $(cell).css('background-color', '#ff0000');
                                        }
                                    }

                                    if (starterx == 3) {
                                        console.log("val line = " + val);
                                        console.log("k line  = " + kntkr["kw" + kw][starterx][0]);
                                        if (val >= parseInt(kntkr["kw" + kw][starterx][0])) {
                                            if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx][0])) {
                                                $(cell).css('background-color', '#ff0');
                                            } else {
                                                $(cell).css('background-color', '#1aab68');
                                            }
                                        } else {
                                            $(cell).css('background-color', '#ff0000');
                                        }
                                    }                                
                                    
                                    if (starterx == 4) {
                                        console.log("val line = " + val);
                                        console.log("k line  = " + kntkr["kw" + kw][starterx][0]);
                                        if (val >= parseInt(kntkr["kw" + kw][starterx][0])) {
                                            if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx][0])) {
                                                $(cell).css('background-color', '#ff0');
                                            } else {
                                                $(cell).css('background-color', '#1aab68');
                                            }
                                        } else {
                                            $(cell).css('background-color', '#ff0000');
                                        }
                                    }                

                                } else {

                                }
                            }

                            if (col == 8){
                                if (starterx == 0){
                                    $(cell).css('background-color', '#000000');
                                }

                                if (starterx == 3) {
                                    $(cell).css('background-color', '#000000');
                                }
                                
                                if (starterx == 4) {
                                    $(cell).css('background-color', '#000000');
                                }
                                
                                if (starterx == 1){
                                    console.log("val delta = " + val);
                                    console.log("k delta  = " + kntkr["kw" + kw][starterx][1]);
                                    if (val >= parseInt(kntkr["kw" + kw][starterx][1])) {
                                        if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx][1])) {
                                            $(cell).css('background-color', '#ff0');
                                        } else {
                                            $(cell).css('background-color', '#1aab68');
                                        }
                                    } else {
                                        $(cell).css('background-color', '#ff0000');
                                    }                                    
                                }

                                if (starterx == 2) {
                                    console.log("val delta = " + val);
                                    console.log("k delta  = " + kntkr["kw" + kw][starterx][1]);
                                    if (val >= parseInt(kntkr["kw" + kw][starterx][1])) {
                                        if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx][1])) {
                                            $(cell).css('background-color', '#ff0');
                                        } else {
                                            $(cell).css('background-color', '#1aab68');
                                        }
                                    } else {
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                }

                            }

                            if (col == 9) {
                                if (starterx == 0) {
                                    $(cell).css('background-color', '#000000');
                                }

                                if (starterx == 3) {
                                    $(cell).css('background-color', '#000000');
                                }

                                if (starterx == 4) {
                                    $(cell).css('background-color', '#000000');
                                }

                                if (starterx == 1) {
                                    console.log("val delta = " + val);
                                    console.log("k delta  = " + kntkr["kw" + kw][starterx][2]);
                                    if (val >= parseInt(kntkr["kw" + kw][starterx][2])) {
                                        if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx][2])) {
                                            $(cell).css('background-color', '#ff0');
                                        } else {
                                            $(cell).css('background-color', '#1aab68');
                                        }
                                    } else {
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                }

                                if (starterx == 2) {
                                    console.log("val delta = " + val);
                                    console.log("k delta  = " + kntkr["kw" + kw][starterx][2]);
                                    if (val >= parseInt(kntkr["kw" + kw][starterx][2])) {
                                        if (val >= 1.5 * parseInt(kntkr["kw" + kw][starterx][2])) {
                                            $(cell).css('background-color', '#ff0');
                                        } else {
                                            $(cell).css('background-color', '#1aab68');
                                        }
                                    } else {
                                        $(cell).css('background-color', '#ff0000');
                                    }
                                }
                            }

                            if (col == 10) {
                                if (kw != undefined) {
                                    if (val >= kabel["kw" + kw]) {
                                        console.log(kabel["kw" + kw]);
                                        if (val >= 1.5 * (kabel["kw" + kw])) {
                                            $(cell).css('background-color', '#ff0');
                                        } else {
                                            $(cell).css('background-color', '#1aab68');
                                        }
                                    } else {
                                        if (val > 0) {
                                            $(cell).css('background-color', '#ff0000');
                                        }
                                    }
                                } else {

                                }                                
                            }

                            if (col == 11) {
                                if (kw != undefined) {
                                    if (val >= jml_kabel["kw" + kw]) {
                                        console.log(jml_kabel["kw" + kw]);
                                        if (val >= 1.5 * (jml_kabel["kw" + kw])) {
                                            $(cell).css('background-color', '#ff0');
                                        } else {
                                            $(cell).css('background-color', '#1aab68');
                                        }
                                    } else {
                                        if (val > 0) {
                                            $(cell).css('background-color', '#ff0000');
                                        }
                                    }
                                } else {

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

    function ajax_refresh() {
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
});
