$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
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
                    // ajax_refresh();
                    sub_unit_refresh();
                } else {

                }
            }
        );
    }

    function sub_unit_refresh() {
        $("#sub_unit").load(BASE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val() + "/" + $("#unit").val()),
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

    function ajax_refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL + "schedule/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                id_unit: $("#unit").val(),
                id_sub_unit: $("#sub_unit").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            refresh(data);
        });
    }

    function refresh() {
        $.ajax({
            method: "POST",
            url: BASE_URL+"schedule/load",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                id_unit: $("#unit").val(),
                id_sub_unit: $("#sub_unit").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            // $('#my-spreadsheet').jexcel({
            //     data: data,
            //     allowInsertColumn: false,

            //     colHeaders: [
            //         'Monitoring Item',
            //         'Standard',
            //         'Parameter',
            //         'Waktu<br>(menit)',
            //         'Frekuensi',
            //     ],

            //     colWidths: [300, 300, 200, 100, 100],
            //     columns: [
            //         { type: 'text' },
            //         { type: 'text' },
            //         { type: 'text' },
            //         { type: 'number' },
            //         { type: 'dropdown', source: ['Harian', 'Mingguan', '2 Mingguan', 'Bulanan', '2 Bulanan', '3 Bulanan', '4 Bulanan', '6 Bulanan', 'Tahunan']},
            //     ]
            // });
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
                sub_unit: $("#sub_unit").val(),

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
        sub_unit_refresh();
    });

    $("#sub_unit").change(function () {
        ajax_refresh();
    });

    station_refresh();

    var dp = new DayPilot.Scheduler("dp");

    dp.theme = "scheduler_traditional";

    dp.startDate = "2020-01-01";
    dp.days = 366;
    dp.scale = "Day";
    dp.timeHeaders = [
        { groupBy: "Month", format: "MMMM yyyy" },
        { groupBy: "Day", format: "d" }
    ];

    dp.contextMenu = new DayPilot.Menu({items: [
        {text:"Edit", onClick: function(args) { dp.events.edit(args.source); } },
        {text:"Delete", onClick: function(args) { dp.events.remove(args.source); } },
        {text:"-"},
        {text:"Select", onClick: function(args) { dp.multiselect.add(args.source); } },
    ]});

    dp.treeEnabled = true;
    dp.treePreventParentUsage = true;
    dp.resources = [
        { name: "Locations", id: "G1", expanded: true, children:[
                { name : "Room 1", id : "A" },
                { name : "Room 2", id : "B" },
                { name : "Room 3", id : "C" },
                { name : "Room 4", id : "D" }
                ]
        },
        { name: "People", id: "G2", expanded: true, children:[
                { name : "Person 1", id : "E" },
                { name : "Person 2", id : "F" },
                { name : "Person 3", id : "G" },
                { name : "Person 4", id : "H" }
                ]
        },
        { name: "Tools", id: "G3", expanded: true, children:[
                { name : "Tool 1", id : "I" },
                { name : "Tool 2", id : "J" },
                { name : "Tool 3", id : "K" },
                { name : "Tool 4", id : "L" }
                ]
        },
        { name: "Other Resources", id: "G4", expanded: true, children:[
                { name : "Resource 1", id : "R1" },
                { name : "Resource 2", id : "R2" },
                { name : "Resource 3", id : "R3" },
                { name : "Resource 4", id : "R4" }
                ]
        },
    ];

    dp.heightSpec = "Max";
    dp.height = 450;

    dp.events.list = [];

    for (var i = 0; i < 12; i++) {
        var duration = Math.floor(Math.random() * 6) + 1; // 1 to 6
        var durationDays = Math.floor(Math.random() * 6) + 1; // 1 to 6
        var start = Math.floor(Math.random() * 6) + 2; // 2 to 7

        var e = {
            start: new DayPilot.Date("2020-02-05T12:00:00").addDays(start),
            end: new DayPilot.Date("2020-02-05T12:00:00").addDays(start).addDays(durationDays).addHours(duration),
            id: DayPilot.guid(),
            resource: String.fromCharCode(65+i),
            text: "Event " + (i + 1),
            bubbleHtml: "Event " + (i + 1),
            barColor: barColor(i),
            barBackColor: barBackColor(i)
        };

        dp.events.list.push(e);
    }

    dp.eventMovingStartEndEnabled = true;
    dp.eventResizingStartEndEnabled = true;
    dp.timeRangeSelectingStartEndEnabled = true;

    // event moving
    dp.onEventMoved = function (args) {
        dp.message("Moved: " + args.e.text());
    };

    dp.onEventMoving = function(args) {
        if (args.e.resource() === "A" && args.resource === "B") {  // don't allow moving from A to B
            args.left.enabled = false;
            args.right.html = "You can't move an event from Room 1 to Room 2";

            args.allowed = false;
        }
        else if (args.resource === "B") {  // must start on a working day, maximum length one day
            while (args.start.getDayOfWeek() === 0 || args.start.getDayOfWeek() === 6) {
                args.start = args.start.addDays(1);
            }
            args.end = args.start.addDays(1);  // fixed duration
            args.left.enabled = false;
            args.right.html = "Events in Room 2 must start on a workday and are limited to 1 day.";
        }

        if (args.resource === "C") {
            var except = args.e.data;
            var events = dp.rows.find(args.resource).events.all();

            var start = args.start;
            var end = args.end;
            var overlaps = events.some(function(item) {
                return item.data !== except && DayPilot.Util.overlaps(item.start(), item.end(), start, end);
            });

            while (overlaps) {
                start = start.addDays(1);
                end = end.addDays(1);

                overlaps = events.some(function(item) {
                    return item.data !== except && DayPilot.Util.overlaps(item.start(), item.end(), start, end);
                });
            }

            if (args.start !== start) {
                args.start = start;
                args.end = end;

                args.left.enabled = false;
                args.right.html = "Start automatically moved to " + args.start.toString("d MMMM, yyyy");
            }

        }
    };

    // event resizing
    dp.onEventResized = function (args) {
        dp.message("Resized: " + args.e.text());
    };

    // event creating
    dp.onTimeRangeSelected = function (args) {
        DayPilot.Modal.prompt("New event name:", "New Event").then(function(modal) {
            dp.clearSelection();
            var name = modal.result;
            if (!name) return;
            var e = new DayPilot.Event({
                start: args.start,
                end: args.end,
                id: DayPilot.guid(),
                resource: args.resource,
                text: name
            });
            dp.events.add(e);
            dp.message("Created");
        });
    };

    dp.onEventMove = function(args) {
        if (args.ctrl) {
            var newEvent = new DayPilot.Event({
                start: args.newStart,
                end: args.newEnd,
                text: "Copy of " + args.e.text(),
                resource: args.newResource,
                id: DayPilot.guid()  // generate random id
            });
            dp.events.add(newEvent);

            // notify the server about the action here

            args.preventDefault(); // prevent the default action - moving event to the new location
        }
    };

    dp.init();

    dp.scrollTo("2020-02-01");

    function barColor(i) {
        var colors = ["#3c78d8", "#6aa84f", "#f1c232", "#cc0000"];
        return colors[i % 4];
    }
    function barBackColor(i) {
        var colors = ["#a4c2f4", "#b6d7a8", "#ffe599", "#ea9999"];
        return colors[i % 4];
    }


});
