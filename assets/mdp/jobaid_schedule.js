$(document).ready(function(){
    var sukses = function () {
        $(".n_success").show();
        $(".n_success").fadeOut(3000);
    }
    function refresh(){
        $.ajax({
            method: "POST",
            url: SITE_URL+"jobaid_schedule/load",
            data: {
                jobaid: $("#jobaid").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            data = JSON.parse(msg);
            console.log(data);
            $('#my-spreadsheet').jexcel({
                data: data,
                colHeaders: [
                    'Work Execution',
                    'Frequency<br>For CTP',
                    'Current Compliance<br>For CTP',
                    'Scope<br>For CTP',
                ],
                allowInsertColumn: false,
                tableOverflow: true,
                tableHeight: '400px',
                colWidths: [650,200,150,150,250,250,75,75],
                columns: [
                    { type: 'autocomplete', url: SITE_URL + 'workexecution/ajax/' , autocomplete:true, multiple:false},
                    { type: 'dropdown', source: ['Cek Sebelum Digunakan','Tes Sebelum Digunakan','1 Bulanan', '3 Bulanan', '6 Bulanan', '1 Tahunan', '2 Tahunan']},
                    { type: 'dropdown', source: ['Yes', 'No']},
                    { type: 'dropdown', source: ['Internal', 'External']}
                ]
            });
        });
    }

    refresh();

    $('#my-spreadsheet').jexcel({
        colHeaders: [
            'Work Execution',
            'Frequency<br>For CTP',
            'Current Compliance<br>For CTP',
            'Scope<br>For CTP',
        ],
        allowInsertColumn: false,
        tableOverflow: true,
        tableHeight: '400px',
        colWidths: [650,200,150,150,250,250,75,75],
        columns: [
            { type: 'autocomplete', url: SITE_URL + 'workexecution/ajax/' , autocomplete:true, multiple:false},
            { type: 'dropdown', source: ['Cek Sebelum Digunakan','1 Bulanan', '3 Bulanan', '6 Bulanan', '1 Tahunan', '2 Tahunan']},
            { type: 'dropdown', source: ['Yes', 'No']},
            { type: 'dropdown', source: ['Internal', 'External']}
        ]
    });

    $("#simpan").click(function () {
        var data_j = $('#my-spreadsheet').jexcel('getData');
        console.log(data_j);

        $.ajax({
            method: "POST",
            url: SITE_URL+"jobaid_schedule/simpan",
            success: sukses,
            data: {
                jobaid : $("#jobaid").val(),
                data_json: JSON.stringify(data_j),
            }
        }).done(function (msg) {
            console.log(msg);
        });
    });

    $("#jobaid").change(function(){
        refresh();
    });
});
