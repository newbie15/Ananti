$(document).ready(function(){
    $('#my').jexcel({
        data: data,
        colHeaders: ['Model', 'Date', 'Price', 'Date'],
        colWidths: [300, 80, 100, 100],
        columns: [
            { type: 'text' },
            { type: 'numeric' },
            { type: 'numeric' },
            { type: 'calendar', options: { format: 'DD/MM/YYYY' } },
        ]
    });
});
