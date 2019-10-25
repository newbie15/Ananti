$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }


    var stations = [];
    var units = [];
    var perunits = [];

    var tasks = {
        data: [
            {
                id: 1, text: "Project #2", start_date: "01-01-2019", duration: 18, order: 10,
                progress: 0.4, open: true
            },
            {
                id: 2, text: "Task #1", start_date: "02-01-2019", duration: 8, order: 10,
                progress: 0.6, parent: 1
            },
            {
                id: 3, text: "Task #2", start_date: "11-01-2019", duration: 8, order: 20,
                progress: 0.6, parent: 1
            }
        ],
        links: [
            { id: 1, source: 1, target: 2, type: "1" },
            { id: 2, source: 2, target: 3, type: "0" }
        ]
    };

    gantt.templates.progress_text = function (start, end, task) {
        return "<span style='text-align:left;'>" + Math.round(task.progress * 100) + "% </span>";
    };

    gantt.templates.scale_cell_class = function (date) {
        if (date.getDay() == 0) {
            return "weekend";
        }
    };
    gantt.templates.task_cell_class = function (item, date) {
        if (date.getDay() == 0) {
            return "weekend"
        }
    };

    // var today = new Date();
    // gantt.addMarker({
    //     start_date: today,
    //     css: "today",
    //     text: "Today",
    //     title: "Today: " //+ date_to_str(today)
    // });

    // gantt.config.columns = [
    //     { name: "text", tree: true, width: 200, resize: true, editor: textEditor },
    //     { name: "start_date", align: "center", width: 90, resize: true, editor: dateEditor },
    //     { name: "duration", align: "center", width: 90, resize: true, editor: durationEditor },
    //     { name: "priority", label: "Priority", width: 80, align: "center", resize: true, editor: priority, template: priorityLabel },
    //     { name: "add", width: 44 }
    // ];

    var users = [// resources
        { key: '0', label: "" },
        { key: '1', label: "John" },
        { key: '2', label: "Mike" },
        { key: '3', label: "Anna" }
    ];

    function userLabelById(id) {
        for (var i = 0; i < users.length; i++) {
            if (users[i].key == id) {
                return users[i].label;
            }
        }
        return "";
    }

    gantt.config.columns = [
        { name: "add", width: 28 },
		{name: "text", label: "Task name", tree: true, min_width: 180, width: 200, resize:true},
		{name: "start_date", label:"Start", align: "center", width: 100, resize:true},
		{name: "mpp", label:"Man Power",  align: "center", template: function(task){
				return userLabelById(task.user);
			}, width: 100, resize:true},
        {name: "duration", align: "center", width: 80, resize:true},
    ];
    
    gantt.config.layout = {
		css: "gantt_container",
		cols: [
			{
				width:400,
				min_width: 300,
				rows:[
					{view: "grid", scrollX: "gridScroll", scrollable: true, scrollY: "scrollVer"},
					{view: "scrollbar", id: "gridScroll", group:"horizontal"}
				]
			},
			{resizer: true, width: 1},
			{
				rows:[
					{view: "timeline", scrollX: "scrollHor", scrollY: "scrollVer"},
					{view: "scrollbar", id: "scrollHor", group:"horizontal"}
				]
			},
			{view: "scrollbar", id: "scrollVer"}
		]
	};


    // reordering tasks within the whole gantt
    gantt.config.order_branch = true;
    gantt.config.order_branch_free = true;

    gantt.init("gantt_here", new Date(2019, 00, 01), new Date(2019, 01, 01));


    gantt.parse(tasks);

});