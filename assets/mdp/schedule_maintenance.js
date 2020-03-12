$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
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

    function init_events(ele) {
        ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1070,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            })

        })
    }

    var isEventOverDiv = function (x, y) {

        console.log(x,y);
        var delete_area = $('#delete_area');
        var offset = delete_area.offset();
        offset.right = delete_area.width() + offset.left;
        offset.bottom = delete_area.height() + offset.top;
        console.table(offset);

        console.log(offset.left, x, offset.right);
        console.log(offset.top-90, y, offset.bottom);
        // Compare
        if (
                x >= offset.left
            &&  y >= (offset.top - 90)
            &&  x <= offset.right
            &&  y <= offset.bottom
        ) { return true; }
        return false;
    }


    function draw_calendar(){
        init_events($('#external-events div.external-event'))

        $('#calendar').fullCalendar('destroy');
        var bulan = tgl.getMonth()+1;
        var tanggal = tgl.getDate();
        var sbulan = "";

        (bulan < 10) ? sbulan = "0"+bulan : sbulan = bulan;
        (tanggal < 10) ? stanggal = "0" + tanggal : stanggal = tanggal;
        
        console.log(bulan+" "+tanggal);
        var default_date = $("#tahun").val() + '-' + sbulan + '-' + stanggal;
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,listDay,listWeek'
            },
            defaultDate: default_date,
            locale: 'id',
            views: {
                listDay: {
                    buttonText: 'harian'
                },
                listWeek: {
                    buttonText: 'mingguan'
                }
            },
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            disableResizing: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped
                // console.log(date);
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject')

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject)

                // assign it the date that was reported
                copiedEventObject.start = date
                copiedEventObject.allDay = allDay
                copiedEventObject.backgroundColor = $(this).css('background-color')
                copiedEventObject.borderColor = $(this).css('border-color')

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                // $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                // is the "remove after drop" checkbox checked?
                // if ($('#drop-remove').is(':checked')) {

                if(true){
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove()
                }
                console.log(date._i);
                console.log("here");
                console.log(allDay);
                console.log(originalEventObject);
                console.log(copiedEventObject);

                tambah(originalEventObject.title,date._i/1000);

                $('#calendar').fullCalendar('refetchEvents');


            },
            eventDrop: function (event, delta) {
                var start_date = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
                var stop_date = null;
                if(event.end != null){
                    stop_date = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm:ss");
                }
                console.log("event.title " + event.title);
                console.log("event.id " + event._id);
                console.log("event.start " + start_date);
                console.log("event.stop " + stop_date);

                // console.log(event.);
                // console.log(delta);
                console.log(event.tgl_lama, event.tgl_baru);

                event.tgl_lama == null ? event.tgl_lama = event.start._i : null;
                event.tgl_baru == null ? event.tgl_baru = start_date : null;

                console.log(event.tgl_lama,event.tgl_baru);

                // update(event.title, event.start._i, start_date);
                update(event.title, event.tgl_lama, event.tgl_baru);
                // event.start = start_date;

                // event.tgl_lama = event.tgl_baru;
                // event.tgl_baru = null;

                // console.log(event.tgl_lama, event.tgl_baru);
                $('#calendar').fullCalendar('refetchEvents');


            },
            eventDragStart: function (){
                console.log("tampilkan tempat pembuangan");
                $("#list_wo").hide();
                $("#delete_area").show();
            },
            eventDragStop: function (event, jsEvent, ui, view) {

                if (isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
                    // if (confirm("anda yakin ingin menghapus plan ini\n", event.title)) {

                        console.log("deleted");
                        $('#calendar').fullCalendar('removeEvents', event._id);
                        var el = $("<div class='fc-event'>").appendTo('#external-events-listing').text(event.title);
                        el.draggable({
                            zIndex: 999,
                            revert: true,
                            revertDuration: 0
                        });
                        el.data('event', { title: event.title, id: event.id, stick: true });
                        console.log(event);
                            hapus(event.title, event.start._i);                        
                    }else{
                        console.log("undeleted");
                    // }
                }
                $("#list_wo").show();
                $("#delete_area").hide();

            },
            eventResizeStop: function (event, delta, revertFunc, jsEvent, ui, view) {
                console.log("stop");
                console.log(event);
                console.log(delta);

                // var xstart = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                // var xend = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                // console.log(xstart);
                // console.log(xend);
            },

            eventClick: function (event) {
                alert(event.title);
            },

            eventLimit: true, // allow "more" link when too many events
            events: {
                url: BASE_URL + '/calendar/plan_schedule/' + $("#pabrik").val(), // use the `url` property
                color: 'yellow', // an option!
                textColor: 'black' // an option!
                // url: BASE_URL + 'schedule_maintenance/event/' + $("#pabrik").val() + "/" + $("#tahun").val(),
                // type: 'POST', // Send post data
                // error: function () {
                //     alert('There was an error while fetching events.');
                // }
            },
        });
    }


    function station_refresh() {
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    ajax_refresh();
                } else {
                }
            }
        );
    }

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "schedule_maintenance/load_wo_unfinished",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                // id_unit: $("#unit").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            // refresh(data);
            update_list(data);
            init_events($('#external-events div.external-event'))

            draw_calendar();
        });
    }

    function update_list(d){
        // console.log(d);
        $("#external-events").html("");

        d.forEach(element => {
            console.log(element);
            x = element[0] + " / " + element[1];
            a = element[2]==element[3] ? " | "+element[2] : " | "+element[2]+" | "+element[3];
            x+=a;
            x+= "\n"+element[4];

            // Fruit Reception 
            // Sterilizer
            // Thresher 
            // Press
            // Klarifikasi 
            // Kernel
            // Empty Bunch Treatment 
            // Boiler
            // Power House 
            // Effluent
            // Laboratorium 
            // Maintenance
            // Water Treatment Plant
            // General
            // out = "";
            if (element[1] == "Fruit Reception") {
                out = "<div class=\"external-event bg-red-active\">"+x+"</div>"
            }else if (element[3] == "Sterilizer")  { 
                out = "<div class=\"external-event bg-maroon-active\">"+x+"</div>"
            }else if (element[3] == "Thresher"){ 
                out = "<div class=\"external-event bg-orange-active\">"+x+"</div>"
            }else if (element[3] == "Press")   { 
                out = "<div class=\"external-event bg-purple-active\">"+x+"</div>"
            }else if (element[3] == "Klarifikasi") { 
                out = "<div class=\"external-event bg-aqua-active\">"+x+"</div>"
            }else if (element[3] == "Kernel") {
                out = "<div class=\"external-event bg-light-blue-active\">"+x+"</div>"
            }else if (element[3] == "Empty Bunch Treatment") {
                out = "<div class=\"external-event bg-teal-active\">"+x+"</div>"
            }else if (element[3] == "Boiler") { 
                out = "<div class=\"external-event bg-navy\">"+x+"</div>"
            }else if (element[3] == "Effluent")   { 
                out = "<div class=\"external-event bg-green-active\">"+x+"</div>"
            }else{
                out = "<div class=\"external-event bg-green-active\">" + x + "</div>"
            } 
            $("#external-events").append(out);
        });
    }

    function update(title,date_old,date_new){
        var x = title.split(" / ");
        var no_wo = x[0];

        $.ajax({
            method: "POST",
            url: BASE_URL + "planing/update",
            data: {
                no_wo: no_wo,
                tanggal: date_old,
                tanggal_baru: date_new,
                id_pabrik: $("#pabrik").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
        });
    }

    function hapus(title,date){
        var x = title.split(" / ");
        var no_wo = x[0];
        
        $.ajax({
            method: "POST",
            url: BASE_URL + "planing/hapus",
            data: {
                no_wo: no_wo,
                tanggal: date,
                id_pabrik: $("#pabrik").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
        });
    }

    function tambah(title,epoch) {
        
        // var utcSeconds = 1234567890;
        var ep = new Date(0); // The 0 there is the key, which sets the date to the epoch
        ep.setUTCSeconds(epoch);

        var y = ep.getFullYear();
        var m = ep.getMonth()+1;
        var d = ep.getDate();

        m < 10 ? m = "0" + m : null;
        d < 10 ? d = "0" + d : null;
        // console.log(y+"-"+m+"-"+d);

        var tanggal = y + "-" + m + "-" + d;

        console.log(title);

        var dt = title.split("/");
        var no_wo = dt[0].trim();

        dt = dt[1].split("\n");
        var problem = "";
        dt[1] == null ? problem = "" : problem = dt[1].trim();

        dt = dt[0].split("|");

        var station = dt[0].trim();
        var unit = dt[1].trim();
        var sub_unit = "";

        dt[2]==null ? sub_unit = dt[1].trim() : sub_unit = dt[2].trim();

        console.log(BASE_URL + "planing/tambah");

        $.ajax({
            method: "POST",
            url: BASE_URL+"planing/tambah",
            data: {
                no_wo: no_wo,
                tanggal: tanggal,
                id_pabrik: $("#pabrik").val(),
                id_station: station,
                id_unit: unit,
                id_sub_unit: sub_unit,
                problem: problem,
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
        });
    }

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: BASE_URL+"schedule/simpan",
            success: sukses,
            data: {
                pabrik: $("#pabrik").val(),
                station: $("#station").val(),
                unit: $("#unit").val(),

                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });


    $("#pabrik").change(function () {
        station_refresh();
    });
    $("#station").change(function () {
        ajax_refresh();
    });
    // $("#unit").change(function () {
    //     ajax_refresh();
    // });

    station_refresh();

    $("#tahun").change(function(){
        var syear = parseInt($("#tahun").val());
        var shtml = null; //"<option>"++"</option>"
        var start_year = syear - 2;
        var stop_year = syear + 2;
        for (var i = start_year; i <= stop_year; i++) {
            shtml += "<option>" + i + "</option>";
        }
        $("#tahun").html(shtml);
        $("#tahun").val(syear.toString());

        // alert("change");
        // $("#calendar").html("");
        draw_calendar();
    });

    draw_calendar();

});
