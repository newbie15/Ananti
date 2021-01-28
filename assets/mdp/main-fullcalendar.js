$(document).ready(function () {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,listDay,listWeek'
            
        },
        // defaultDate: '2018-03-12',
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
        eventLimit: true, // allow "more" link when too many events
        
        eventSources: [
            {
                url: SITE_URL+'/calendar/plan_schedule/'+$("#pabrik").val(), // use the `url` property
                color: 'yellow', // an option!
                textColor: 'black' // an option!
            }
        ],
        
    });

});