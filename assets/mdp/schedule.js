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
                id_sub_unit: $("#sub_unit").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            // refresh(data);
            init_fc_scheduler();
        });
    }

    // function refresh() {
    //     $.ajax({
    //         method: "POST",
    //         url: BASE_URL+"schedule/load",
    //         data: {
    //             id_pabrik: $("#pabrik").val(),
    //             id_station: $("#station").val(),
    //             id_unit: $("#unit").val(),
    //             id_sub_unit: $("#sub_unit").val(),
    //         }
    //     }).done(function (msg) {
    //         console.log(msg);
    //         data = JSON.parse(msg);
    //         if(data.length>0){}
    //         console.log(data);
    //     });
    // }

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

        // ajax_refresh();
        // init_scheduler();
        // init_fc_scheduler();

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

    station_refresh();

    function init_fc_scheduler(params) {

        var data_r = [{
            id: "",
            monitoring: "",
            title: ""
        }];
        console.log(data_r);
        $.ajax({
            method: "POST",
            url: BASE_URL + "schedule/get_monitoring_list",
            data: {
                id_pabrik: $("#pabrik").val(),
                id_station: $("#station").val(),
                id_unit: $("#unit").val(),
                id_sub_unit: $("#sub_unit").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            xdata_r = JSON.parse(msg);
            if(xdata_r != null){
                data_r = xdata_r;
                $('#dp').fullCalendar('destroy');
                $("#dp").show();
                $('#dp').fullCalendar({
                    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
                    contentHeight: 'auto',
                    header: {
                        left: 'today prev,next',
                        center: 'title',
                        right: 'timelineDay,timelineWeek,timelineMonth,timelineYear'
                    },
                    defaultView: 'timelineYear',
                    resourceGroupField: 'monitoring',
                    resources: data_r,

                    events: [{
                            resourceId: 'a',
                            title: 'Auditorium A',
                            start: '2020-01-17T01:00:00',
                            end: '2020-01-19T17:00:00'
                        },
                        {
                            resourceId: 'b',
                            title: 'Auditorium B',
                            start: '2020-01-17T07:00:00',
                            end: '2020-01-18T17:00:00'
                        }
                    ],

                    eventClick: function (calEvent, jsEvent, view) {
                        if (confirm("Anda Yakin Menghapus Ini ?")) {
                            $('#dp').fullCalendar('removeEvents', calEvent._id);
                        }
                    },

                    dayClick: function (date, jsEvent, view, resource) {
                        console.log('clicked ' + date.format() + ' on resource ' + resource.id);
                        // $(this).css('background-color', 'red');

                        // this.title = prompt('Event Title:');
                        // this.eventData;
                        // if (this.title) {
                        this.eventData = {
                            title: resource.title,
                            start: date.format(),
                            end: date.format(),//+ "T24:00:00",
                            // end: null,
                            resourceId: resource.id // Example  of resource ID
                        };
                        $('#dp').fullCalendar('getResources') // This loads the resources your events are associated with(you have toload your resources as well )
                        $('#dp').fullCalendar('renderEvent', this.eventData, true); // stick? = true
                        // }
                    },
                });
            }else{
                $("#dp").hide();
            }
        });
    }

});
