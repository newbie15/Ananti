$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh(data){

        var id_pabrik = $("#pabrik").val();
        var tahun = $("#tahun").val();
        var id_unit = $("#unit").val();
        console.log(SITE_URL + 'wo/loadcsv/' + id_pabrik + "/" + tahun, );

        // jexcel(document.getElementById('#my-spreadsheet'), {
        $("#my-spreadsheet").html("");
        jexcel(document.getElementById('my-spreadsheet'), {
            csv: SITE_URL + 'wo/loadcsv/' + id_pabrik + "/" + tahun,
            csvHeaders: true,
            search: true,
            lazyLoading: true,
            loadingSpin: true,
            pagination: 20,
            columns: [
                { type: 'text', width: 140 },
                { type: 'text', width: 200 },
                { type: 'text', width: 200 },
                { type: 'text', width: 200 },
                { type: 'text', width: 200 },
                { type: 'text', width: 75 },
                { type: 'text', width: 75 },
                { type: 'text', width: 40 },
                { type: 'text', width: 75 },
                // { type: 'text', width: 50 },
                // { type: 'text', width: 25 },
                // { type: 'text', width: 75 },
            ]
        });
    }

    $("#downloadcsv").click(function () {
        window.open(SITE_URL + "wo/download/" + $("#pabrik").val() + "/" + $("#tahun").val());
    });

    $("#pabrik").change(function () {
        refresh();
    });

    $("#tahun").change(function () {
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

    refresh();
});
