$(document).ready(function(){
    $.ajax({
        method: "POST",
        url: BASE_URL + "ik/list_ik/" + $("#pabrik").val(),
        data: {
            id_pabrik: $("#pabrik").val(),
        }
    }).done(function (msg) {
        x = [];
        y = [];
        data = JSON.parse(msg);

        for (i in data) {
            // console.log(data[i].daftar);
            // ct = "2";
            x.push(data[i], data[i]);
            y[i] = x;
            x = [];
        }
        var table = $('#d-datasheet').DataTable({
            destroy: true,
            data: y,
            columns: [{
                title: "Daftar Instruksi Kerja",
            }, ],
            columnDefs: [
                {
                    targets: 0,
                    // width: "50px",
                    render: function (data, type, row, meta) {
                        if (type === 'display') {
                            var link = BASE_URL + "ik/load/" + encodeURIComponent(data);
                            data = '<a target="_blank" href="' + link + '">' + data + '</a > ';
                        }
                        return data;
                    }
                },
                {
                    targets: 1,
                    width: "50px",
                    render: function (data, type, row, meta) {
                        if (type === 'display') {
                            var link = BASE_URL + "ik/delete/" + encodeURIComponent(data);
                            data = '<a href="'+ link + '" onclick="return confirm(\'anda yakin menghapus ini ?\')">' + '<i class="fa fa-fw fa-trash-o"></i> delete' + '</a > ';
                        }
                        return data;
                    }
                }
            ]
        });
    });
});
