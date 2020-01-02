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

        var external_events = $('#external-events');
        var offset = external_events.offset();
        offset.right = external_events.width() + offset.left;
        offset.bottom = external_events.height() + offset.top;

        // Compare
        if (x >= offset.left
            && y >= offset.top
            && x <= offset.right
            && y <= offset.bottom) { return true; }
        return false;

    }


    function draw_calendar(){
        init_events($('#external-events div.external-event'))


        $('#calendar').fullCalendar('destroy');
        var bulan = tgl.getMonth()+1;
        var tanggal = tgl.getDate();
        var sbulan = "";
        if(bulan < 10){
            sbulan = "0"+bulan;
        }else{
            sbulan = bulan;
        }
        if (tanggal < 10) {
            stanggal = "0" + tanggal;
        } else {
            stanggal = tanggal;
        }
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
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove()
                }
                console.log("here");
                console.log(originalEventObject);
                console.log(copiedEventObject);


            },
            eventDrop: function (event, delta) {
                var start_date = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
                var stop_date = null;
                if(event.end != null){
                    stop_date = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm:ss");
                }
                // $.ajax({
                //     url: 'update_events.php',
                //     data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                //     type: "POST",
                //     success: function (json) {
                //         alert("Updated Successfully");
                //     }
                // });
                console.log("event.title " + event.title);
                console.log("event.id " + event._id);
                console.log("event.start " + start_date);
                console.log("event.stop " + stop_date);

                // console.log(event);
            },
            eventDragStart: function (){
                console.log("tampilkan tempat pembuangan");
            },
            eventDragStop: function (event, jsEvent, ui, view) {

                if (isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
                    $('#calendar').fullCalendar('removeEvents', event._id);
                    var el = $("<div class='fc-event'>").appendTo('#external-events-listing').text(event.title);
                    el.draggable({
                        zIndex: 999,
                        revert: true,
                        revertDuration: 0
                    });
                    el.data('event', { title: event.title, id: event.id, stick: true });
                }
            },
            eventResizeStop: function(){
                console.log("stop");
            },

            eventLimit: true, // allow "more" link when too many events
            events: {
                url: BASE_URL + 'pm/event/' + $("#pabrik").val() + "/" + $("#tahun").val(),
                type: 'POST', // Send post data
                error: function () {
                    alert('There was an error while fetching events.');
                }
            },
            // events: [{
            //         title: 'All Day Event',
            //         start: '2018-03-01'
            //     },
            //     {
            //         title: 'Long Event',
            //         start: '2018-03-07',
            //         end: '2018-03-10'
            //     },
            //     {
            //         id: 999,
            //         title: 'Repeating Event',
            //         start: '2018-03-09T16:00:00'
            //     },
            //     {
            //         id: 999,
            //         title: 'Repeating Event',
            //         start: '2018-03-16T16:00:00'
            //     },
            //     {
            //         title: 'Conference',
            //         start: '2018-03-11',
            //         end: '2018-03-13'
            //     },
            //     {
            //         title: 'Meeting',
            //         start: '2018-03-12T10:30:00',
            //         end: '2018-03-12T12:30:00'
            //     },
            //     {
            //         title: 'Lunch',
            //         start: '2018-03-12T12:00:00'
            //     },
            //     {
            //         title: 'Meeting',
            //         start: '2018-03-12T14:30:00'
            //     },
            //     {
            //         title: 'Happy Hour',
            //         start: '2018-03-12T17:30:00'
            //     },
            //     {
            //         title: 'Dinner',
            //         start: '2018-03-12T20:00:00'
            //     },
            //     {
            //         title: 'Birthday Party',
            //         start: '2018-03-13T07:00:00'
            //     },
            //     {
            //         title: 'Click for Google',
            //         url: 'http://google.com/',
            //         start: '2018-03-28'
            //     }
            // ]
        });
    }


    function station_refresh() {
        $("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
            function (responseTxt, statusTxt, xhr) {
                if (statusTxt == "success") {
                    unit_refresh();
                } else {
                }
            }
        );
    }

    function unit_refresh() {
        $("#unit").load(BASE_URL + "unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
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
            url: BASE_URL + "schedule/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                id_unit: $("#unit").val(),

            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
            update_list(data);
            init_events($('#external-events div.external-event'))

            // draw_calendar();
        });
    }

    function update_list(d){
        // console.log(d);
        $("#external-events").html("");

        d.forEach(element => {
            console.log(element);
            x = element[0]+"-"+$("#unit").val();
            out = "";
            if (element[3] == "Harian") {
                out = "<div class=\"external-event bg-red-active\">"+x+"</div>"
            }else if (element[3] == "Mingguan")  { 
                out = "<div class=\"external-event bg-maroon-active\">"+x+"</div>"
            }else if (element[3] == "2 Mingguan"){ 
                out = "<div class=\"external-event bg-orange-active\">"+x+"</div>"
            }else if (element[3] == "Bulanan")   { 
                out = "<div class=\"external-event bg-purple-active\">"+x+"</div>"
            }else if (element[3] == "2 Bulanan") { 
                out = "<div class=\"external-event bg-aqua-active\">"+x+"</div>"
            }else if (element[3] == "3 Bulanan") {
                out = "<div class=\"external-event bg-light-blue-active\">"+x+"</div>"
            }else if (element[3] == "4 Bulanan") {
                out = "<div class=\"external-event bg-teal-active\">"+x+"</div>"
            }else if (element[3] == "6 Bulanan") { 
                out = "<div class=\"external-event bg-navy\">"+x+"</div>"
            }else if (element[3] == "Tahunan")   { 
                out = "<div class=\"external-event bg-green-active\">"+x+"</div>"
            } 
            $("#external-events").append(out);
        });
    }


    function refresh() {
        // $.ajax({
        //     method: "POST",
        //     url: BASE_URL+"schedule/load",
        //     data: {
        //         id_pabrik: $("#pabrik").val(),
        //         id_station: $("#station").val(),
        //         id_unit: $("#unit").val(),
        //     }
        // }).done(function (msg) {
        //     console.log(msg);
        //     data = JSON.parse(msg);
        //     console.log(data);
        //     $('#my-spreadsheet').jexcel({
        //         data: data,
        //         allowInsertColumn: false,

        //         colHeaders: [
        //             'Monitoring Item',
        //             'Standard',
        //             'Parameter',
        //             'Frekuensi',
        //         ],

        //         colWidths: [300, 300, 200, 100],
        //         columns: [
        //             { type: 'text' },
        //             { type: 'text' },
        //             { type: 'text' },
        //             { type: 'dropdown', source: ['Harian', 'Mingguan', '2 Mingguan', 'Bulanan', '2 Bulanan', '3 Bulanan', '4 Bulanan', '6 Bulanan', 'Tahunan']},
        //         ]
        //     });
        // });
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
        unit_refresh();
    });
    $("#unit").change(function () {
        ajax_refresh();
    });

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
