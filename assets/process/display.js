$(document).ready(function(){
    // var d1 = [];
    // for (var i = 0; i < 14; i += 0.5) {
    //     d1.push([i, Math.sin(i)]);
    // }
    var d1 = [
        [1, null],
        [2, null],
        [3, null],
        [4, null],
        [5, null],
        [6, null],
        [7, null],
        [8, null],
        [9, 13],
        [10, 13],
        [11, 13],
        [12, 13],
        [13, 13],
        [14, 13],
        [15, 13],
        [16, 13],
        [17, 13],
        [18, 13],
        [19, 13],
        [20, 13],
        [21, 13],
        [22, 13],
        [23, 13],
        [24, 13],
        [25, 13],
        [26, 13],
        [27, 13],
        [28, null],
        [29, null],
        [30, null],
        [31, null],
    ];
    // var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];
    var d2 = [
        [1, null],
        [2, null],
        [3, null],
        [4, null],
        [5, null],
        [6, null],
        [7, null],
        [8, null],
        [9, 13],
        [10, 13],
        [11, 13],
        [12, 13],
        [13, 13],
        [14, 13],
        [15, 13],
        [16, 13],
        [17, 13],
        [18, 13],
        [19, 13],
        [20, 13],
        [21, 13],
        [22, 13],
        [23, 13],
        [24, 13],
        [25, 13],
        [26, 13],
        [27, 13],
        [28, null],
        [29, null],
        [30, null],
        [31, null],
    ];
    // A null signifies separate line segments

    // var d3 = [[0, 12], [7, 12], null, [7, 2.5], [12, 2.5]];

    var d3 = [
        [1, null],
        [2, null],
        [3, null],
        [4, null],
        [5, null],
        [6, null],
        [7, null],
        [8, null],
        [9, 13],
        [10, 13],
        [11, 13],
        [12, 13],
        [13, 13],
        [14, 13],
        [15, 13],
        [16, 13],
        [17, 13],
        [18, 13],
        [19, 13],
        [20, 13],
        [21, 13],
        [22, 13],
        [23, 13],
        [24, 13],
        [25, 13],
        [26, 13],
        [27, 13],
        [28, null],
        [29, null],
        [30, null],
        [31, null],
    ];

    $.plot("#g1", [d1]);
    $.plot("#g2", [d2]);
    $.plot("#g3", [d3]);
    
    // $.plot("#g1", [d1, d2, d3]);


    var tgl = new Date();
    var bulan = [
        'januari',
        'februari',
        'maret',
        'april',
        'mei',
        'juni',
        'juli',
        'agustus',
        'september',
        'oktober',
        'november',
    ]
    var m = tgl.getMonth();
    var y = tgl.getFullYear();
    var d = tgl.getDate();

    var b = 0;
    if((m+1)<10){
        b = "0"+(m+1);
    }else{
        b = m+1;
    }

    tgl.setDate(tgl.getDate() - 1);
    
    var kemarin = tgl;
    
    var mk = kemarin.getMonth();
    var yk = kemarin.getFullYear();
    var dk = kemarin.getDate();

    $("#today").html(d + " " + bulan[m] + " " + y);
    $("#yesterday").html(dk + " " + bulan[mk] + " " + yk);

    $("#pabrik").val("GSDI");

    $.ajax({
        method: "POST",
        url: BASE_URL + "display/view",
        data: {
            pabrik: $("#pabrik").val(),
            tanggal: y+"/"+b+"/"+d,
        }
    }).done(function (msg) {
        console.log(msg);
        var dx = JSON.parse(msg);

        $("#ffa_hi").html(((dx['ffa'])*1.0).toFixed(2) + " %");
        $("#taksasi_y").html(dx['taksasi']);
        $("#taksasi_t").html(dx['taksasi_t']);

        $("#start_t").html("07:00");
        $("#jam_t").html((dx['taksasi_t']/80000.0).toFixed(2)+ " jam");

        $("#tbs_terima_hi ").html(dx['tbs_terima']);
        $("#tbs_olah_hi ").html(dx['tbs_olah']);
        $("#er_cpo_hi").html(((dx['er_cpo'])*1.0).toFixed(2) +" %");
        $("#er_kernel_hi ").html(((dx['er_kernel'])*1.0).toFixed(2) + " %");
        $("#er_pko_hi").html(((dx['er_pko'])*1.0).toFixed(2) + " %");
        $("#throughput_hi").html(dx['troughput_pom']);
        $("#taksasi_vs_real").html(((dx['tbs_terima'] / dx['taksasi'])*100.0).toFixed(2)+" %");

        $("#stok_cpo").html(((dx['s_cpo']) * 1.0).toFixed(2) + " kg");
        $("#stok_kernel ").html(((dx['s_kernel']) * 1.0).toFixed(2) + " kg");
        $("#stok_pko").html(((dx['s_pko']) * 1.0).toFixed(2) + " kg");
        $("#stok_pke").html(((dx['s_pke']) * 1.0).toFixed(2) + " kg");
        $("#breakdown_hi").html(((dx['breakdown']) * 1.0).toFixed(2) + " jam");

    });

    // $("#taksasi_t").load(BASE_URL + "display/taksasi_t");
    // $("#start_t").load(BASE_URL + "display/start_t");
    // $("#jam_t").load(BASE_URL + "display/jam_t");

    // $("#ffa_hi").load(BASE_URL + "display/");
    // $("#ffa_shi").load(BASE_URL + "display/");
    // $("#taksasi_y").load(BASE_URL + "display/");
    // $("#taksasi_vs_real").load(BASE_URL + "display/");

    // $("#er_cpo_hi").load(BASE_URL + "display/");
    // $("#er_cpo_shi").load(BASE_URL + "display/");

    // $("#tbs_terima_hi ").load(BASE_URL + "display/");
    // $("#tbs_terima_shi").load(BASE_URL + "display/");

    // $("#tbs_olah_hi ").load(BASE_URL + "display/");
    // $("#tbs_olah_shi").load(BASE_URL + "display/");

    // $("#er_kernel_hi ").load(BASE_URL + "display/");
    // $("#er_kernel_shi").load(BASE_URL + "display/");

    // $("#throughput_hi").load(BASE_URL + "display/");
    // $("#throughput_shi").load(BASE_URL + "display/");

    // $("#throughput_hi").load(BASE_URL + "display/");
    // $("#throughput_shi").load(BASE_URL + "display/");

    // $("#breakdown_hi").load(BASE_URL + "display/");
    // $("#breakdown_shi").load(BASE_URL + "display/");

    // $("#er_pko_hi").load(BASE_URL + "display/");
    // $("#er_pko_shi").load(BASE_URL + "display/");

    // $("#stok_cpo").load(BASE_URL + "display/");
    // $("#stok_kernel").load(BASE_URL + "display/");

    // $("#stok_pko").load(BASE_URL + "display/");
    // $("#stok_pke").load(BASE_URL + "display/");

});