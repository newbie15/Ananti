$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }


    var stations = [];
    var units = [];
    var perunits = [];

    // var stations = [
    //     // { key: 1, label: 'None' },
    //     // { key: 2, label: 'On start date' },
    //     // { key: 3, label: '1 day before' }
    // ];

    // var units = [
    //     { key: 1, label: 'None' },
    //     { key: 2, label: 'On start date' },
    //     { key: 3, label: '1 day before' }
    // ];


    function reinit_calendar(){
        scheduler.resetLightbox();

        scheduler.config.first_hour = 6; // oke
        scheduler.config.last_hour = 22; // oke
        scheduler.config.start_on_monday = false; // oke

        // console.log(stations);

        scheduler.locale.labels.section_station = 'Station';
        scheduler.locale.labels.section_unit = 'Unit';

        scheduler.config.lightbox.sections = [
            { name: "station", height: 40, map_to: "station", type: "select", options: stations },
            { name: "unit", height: 40, map_to: "unit", type: "select", options: units },
            { name: "Deskripsi", height: 100, map_to: "desc", type: "textarea", focus: true },
            { name: "time", height: 72, type: "time", map_to: "auto" }
        ];

        scheduler.templates.event_text = function (start, end, ev) {
            return 'Subject:\n' + ev.text + '\nStation:\n' + ev.station + '\nUnit:\n' + ev.unit;
        };

        scheduler.init('scheduler_here', new Date(), "month");
    }

    function update_stations(s){
        var a = {};
        stations = [];
        s.forEach(element => {
            // console.log(element);
            a.key = element;
            a.label = element;
            stations.push(a);
            a = {};
        });
        // console.log(stations);
    }

    function update_units(u) {
        var a = {};
        units = [];
        var u = [];
        var count = 0;
        var nama_station = "";
        u.forEach(element => {
            // console.log(element);
            a.key = element;
            a.label = element;
            units.push(a);
            a = {};

            if(element.includes("= =")){
                if(nama_station!=""){
                    perunits[nama_station] = u;
                }
                nama_station = element.replace("=","").replace(" ","");
                count = 0;
                u = [];
            }else{
                u.push(element);
            }
            console.log(perunits);

        });

    }


    $("#pabrik").change(function () {
        pabrik_refresh()
    });

    function pabrik_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "station/dhtmlx/" + $("#pabrik").val(),
            data: {}
        }).done(function (msg) {
            // console.log(msg);
            data = JSON.parse(msg);
            // console.log(data);
            update_stations(data);
            reinit_calendar();

        });

        $.ajax({
            method: "POST",
            url: BASE_URL + "unit/dhtmlx/" + $("#pabrik").val(),
            data: {}
        }).done(function (msg) {
            // console.log(msg);
            data = JSON.parse(msg);
            // console.log(data);
            update_units(data);
        });
    }

    pabrik_refresh();

    // $(".dhx_cal_larea").click(function(e){
    //     console.log($(this).attr('id'));
    //     alert("");
    // });

    $(document).on("click", ".dhx_cal_larea select", function (e) {
        // Do something when button is clicked
        // alert("ini select");
        // console.log(e.target);
        // console.log($(e.target).prev());
        // console.log($(e.target).parent());
        // console.log($(e.target).parent().prev());
        
        // console.log($(e.target).parent().parent().next().children().next().children().html());

        // $(e.target).parent()

        if ($(e.target).parent().prev().html().includes('Station')){
            var s = $(e.target).val();

        }else{
            alert("salah");
        }
        
    });
});
