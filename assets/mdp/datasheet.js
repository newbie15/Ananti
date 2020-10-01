$(document).ready(function(){
    $("#modal-default").on('hide.bs.modal', function () {
        ajax_refresh();
    });
    
    function ajax_refresh(){
        $.ajax({
            method: "POST",
            url: BASE_URL + "datasheet/list_datasheet/" + $("#pabrik").val(),
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
                    title: "Daftar Datasheet",
                }, ],
                columnDefs: [{
                        targets: 0,
                        // width: "50px",
                        render: function (data, type, row, meta) {
                            if (type === 'display') {
                                var link = BASE_URL + "datasheet/load/" + encodeURIComponent(data);
                                data = '<a href="' + link + '" onclick="window.open(\'' + link + '\', \'_blank\', \'fullscreen=yes\');return false;">' + data + '</a > ';
                            }
                            return data;
                        }
                    },
                    {
                        targets: 1,
                        width: "50px",
                        render: function (data, type, row, meta) {
                            if (type === 'display') {
                                var link = BASE_URL + "datasheet/delete/" + encodeURIComponent(data);
                                data = '<a href="' + link + '" onclick="return confirm(\'anda yakin menghapus ini ?\')">' + '<i class="fa fa-fw fa-trash-o"></i> delete' + '</a > ';
                            }
                            return data;
                        }
                    }
                ]
            });
        });
    }

    ajax_refresh();
});
