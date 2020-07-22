$(document).ready(function () {
	var sukses = function () {
		$(".n_success").show();
		$(".n_success").fadeOut(3000);
	}

	function station_refresh() {
		$("#station").load(BASE_URL + "station/ajax_dropdown/" + $("#pabrik").val(),
			function (responseTxt, statusTxt, xhr) {
				if (statusTxt == "success") {
					// alert("success");
					unit_refresh();
				} else {
					// alert("gaagal");
				}
			}
		);
	}

	function unit_refresh() {
		$("#unit").load(BASE_URL + "unit/ajax_dropdown_sub/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()),
			function (responseTxt, statusTxt, xhr) {
				if (statusTxt == "success") {
					// alert("success");
					sub_unit_refresh();
				} else {
					// alert("gaagal");
				}
			}
		);
	}

	function sub_unit_refresh() {
		$("#sub_unit").load(BASE_URL + "sub_unit/ajax_dropdown/" + $("#pabrik").val() + "/" + encodeURI($("#station").val()) + "/" + encodeURI($("#unit").val()),
			function (responseTxt, statusTxt, xhr) {
				if (statusTxt == "success") {
					// alert("success");
					// ajax_refresh();
				} else {
					// alert("gaagal");
				}
			}
		);
	}

	handler = function (obj, cell, val) {
		data_detail = $('#my-spreadsheet').jexcel('getData');

		pos = $(cell).prop('id').split("-");

		console.log(pos);

		dt_start = data_detail[pos[1]][6];
		dt_stop = data_detail[pos[1]][7];

		if (dt_start != "" && dt_stop != "" && (pos[0] == 6 || pos[0] == 7)) {
			var date1 = new Date("08/05/2015 " + dt_start + ":00");
			var date2 = new Date("08/05/2015 " + dt_stop + ":00");

			var diff = date2.getTime() - date1.getTime();
			if (diff < 0) {
				date2 = new Date("08/06/2015 " + dt_stop + ":00");
				diff = date2.getTime() - date1.getTime();
			}

			console.log("diff =" + diff);
			var msec = diff;
			var hh = Math.floor(msec / 1000 / 60 / 60);
			console.log(hh);
			msec -= hh * 1000 * 60 * 60;
			var mm = Math.floor(msec / 1000 / 60);
			console.log(mm);
			msec -= mm * 1000 * 60;
			var ss = Math.floor(msec / 1000);
			msec -= ss * 1000;
			hour = "";
			min = "";

			if (hh < 10) {
				hour = "0" + hh.toString();
			} else {
				hour = hh.toString();
			}
			if (mm < 10) {
				min = "0" + mm.toString();
			} else {
				min = mm.toString();
			}

			console.log(hour + ':' + min);
			console.log(hh + ':' + mm);

			$("#my-spreadsheet").jexcel('setValue', 'I' + (parseInt(pos[1]) + 1).toString(), hour + ':' + min);
		}

	};


    function ambil_dari_plan(){
        // getplan
        $.ajax({
            method: "POST",
            url: BASE_URL + "projectplan/get_plan",
            data: {
                id_pabrik: $("#pabrik").val(),
                d: $("#tanggal").val(),
                m: $("#bulan").val(),
                y: $("#tahun").val(),
            }
        }).done(function (msg) {
            console.log(msg);
            var data = JSON.parse(msg);
            console.log(data);
            if(data.length==0){
                alert("anda tidak punya plan untuk hari ini\ntolong buat plan dahulu");
                $('#my-spreadsheet').html("");
            }else{
                $('#my-spreadsheet').html("");
                $('#my-spreadsheet').jexcel({
                    data: data,
                    allowInsertColumn: false,
                    colHeaders: ['Project ID', 'PT', 'Nama Project','Activity','Keterangan','Man Power', 'Start', 'Stop', 'Total time'],
					colWidths: [150, 100, 200, 150, 250, 150, 75, 75, 75, 100, 100, 80],
					columns: [
						{ type: 'text', readOnly: true },
						{ type: 'text', readOnly: true },
						{ type: 'text', readOnly: true },
						{
							type: 'dropdown',
							source: ['marking', 'cutting', 'machining', 'assembly', 'welding', 'painting', 'balancing', 'finishing', 'install']
						},
						{ type: 'text' },
						{ type: 'autocomplete', url: BASE_URL + 'karyawan/ajax/' + $("#pabrik").val() },
						{ type: 'text', mask: '##:##' },
						{ type: 'text', mask: '##:##' },
						{ type: 'text' },
					],
                    onchange: handler,
                    // onselection:selection,
                });
            }        
        });
    }

	function refresh(data) {
		var nama_pt = $("#pabrik").val();
		var tahun = $("#tahun").val();
		var bulan = $("#bulan").val();
		var tanggal = $("#tanggal").val();


		var no_wo = nama_pt + "-" + tahun + "-" + bulan + "-" + tanggal;

		var arr_no_wo = [];

		var no_last_wo = 1;
		var no_max_wo = no_last_wo + 100;
		if (no_max_wo > 9999) {
			no_max_wo = 9999;
		}
		var j = 0;
		for (var i = no_last_wo; i < no_max_wo; i++) {
			if (i < 10) {
				arr_no_wo[j++] = no_wo + "-0" + i.toString();
			} else if (i < 100) {
				arr_no_wo[j++] = no_wo + "-" + i.toString();
			}
		}


		if (data == undefined) {
			data = [];
		}

		$('#my-spreadsheet').jexcel({
			data: data,
			allowInsertColumn: false,
			// tableOverflow: true,
			// tableHeight: '400px',
			onchange: handler,
			// colHeaders: ['Tanggal', 'No WO', 'Station', 'Equipment', 'Problem', 'Penjelasan<br>Masalah', 'HM', 'Kategori', 'status'],
			colHeaders: ['Project ID', 'PT', 'Nama Project','Activity','Keterangan','Man Power', 'Start', 'Stop', 'Total time'],
			// colWidths: [140, 140, 140, 140, 250, 250, 100, 75, 80, 80],
			colWidths: [150, 100, 200, 150, 250, 150, 75, 75, 75, 100, 100, 80],
			columns: [
                { type: 'text', readOnly: true },
                { type: 'text', readOnly: true },
                { type: 'text', readOnly: true },
				{
					type: 'dropdown',
					source: ['marking', 'cutting', 'machining', 'assembly', 'welding', 'painting', 'balancing', 'finishing', 'install']
				},
                { type: 'text' },
                { type: 'autocomplete', url: BASE_URL + 'karyawan/ajax/' + $("#pabrik").val() },
				{ type: 'text', mask: '##:##' },
				{ type: 'text', mask: '##:##' },
				{ type: 'text' },
				// { type: 'dropdown', source: ['plan', 'unplan'] },
				// { type: 'dropdown',source: ['M', 'E'] },
				// { type: 'calendar', option: { format: 'DD/MM/YYYY HH24:MI',	time: 1	} },
                // { type: 'dropdown',source: ['open', 'close'] },
				// { type: 'calendar', option: { format: 'DD/MM/YYYY HH24:MI',	time: 1	} },
			]
		});

		$('#my-spreadsheet').jexcel('updateSettings', {
			table: function (instance, cell, col, row, val, id) {
				if (col == 7) {
					if (val == "open") {
						$(cell).css('color', '#000000');
						$(cell).css('background-color', '#ff0000');
					} else if (val == "close") {
						$(cell).css('color', '#000000');
						$(cell).css('background-color', '#00ff00');
					}
				}
			}
		});

	}

	$("#pabrik").change(function () {
		ajax_refresh();
	});
	// $("#tahun").change(function () {
	//     ajax_refresh();
	// });
	$("#bulan").change(function () {
		ajax_refresh();
	});
	$("#tanggal").change(function () {
		ajax_refresh();
	});

	$("#station").change(function () {
		unit_refresh();
	});

	$("#unit").change(function () {
		sub_unit_refresh();
	});

	function refresh_modal() {
		$.ajax({
			method: "POST",
			url: BASE_URL + "project/list_open/" + $("#pabrik").val(),
			data: {
				id_pabrik: $("#pabrik").val(),
			}
		}).done(function (msg) {
			x = [];
			y = [];
			data = JSON.parse(msg);

			for (i in data) {
				console.log(data[i].daftar);
				x.push(data[i].daftar);
				y[i] = x;
				x = [];
			}
			var table = $('#dt-table').DataTable({
				destroy: true,
				data: y,
				columns: [{
					title: "Daftar"
				}, ]
			});

			$('.dataTable tbody').on('click', 'tr', function () {
				if (table.row(this).data() != undefined) {
					console.log('API row values : ', table.row(this).data());
					var sp = table.row(this).data();
					sp = sp[0].split(" - ");
					add(sp[0],sp[1],sp[2]);
					$('#modal-default').modal('toggle');
				}
			});
		});
	}


	function add(no, sx, ux, su) {
		var sama = 0;
		var index = 0;
		dx = $('#my-spreadsheet').jexcel('getData');
		console.log(dx);
		if (dx[0][0] == "") { // kosong
			dx[0][0] = no;
			dx[0][1] = sx; // + "\n" + ux + "\n" + su;
			dx[0][2] = ux;
			// dx[0][3] = su;
		} else { // isi satu
			dx.push([no, sx, ux, "", "", "", "", "", ""]);
		}

		refresh(dx);

		// $("#wo").val("");
		$("#modal-default").modal("hide");

		updatescroll();
	}

	function updatescroll() {
		var el = document.getElementById("scrll");
		el.scrollTop = el.scrollHeight;
	}

	$("#simpan").click(function () {
		var data_j = $('#my-spreadsheet').jexcel('getData');
		console.log(data_j);

		$.ajax({
			method: "POST",
			url: BASE_URL + "projectactivity/simpan",
			success: sukses,
			data: {
				pabrik: $("#pabrik").val(),
				d: $("#tanggal").val(),
				m: $("#bulan").val(),
				y: $("#tahun").val(),
				data_json: JSON.stringify(data_j),
			}
		}).done(function (msg) {
			console.log(msg);
		});
	});

	var tgl = new Date();
	var m = tgl.getMonth() + 1;
	if (m < 10) {
		$("#bulan").val("0" + m.toString());
	} else {
		$("#bulan").val(m.toString());
	}

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

		ajax_refresh();
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



	// var y = tgl.getFullYear();
	// $("#tahun").val(y.toString());

	var d = tgl.getDate();
	if (d < 10) {
		$("#tanggal").val("0" + d.toString());
	} else {
		$("#tanggal").val(d.toString());
	}

	// refresh();
	function ajax_refresh() {
		$.ajax({
			method: "POST",
			url: BASE_URL + "projectactivity/load",
			data: {
				id_pabrik: $("#pabrik").val(),
				d: $("#tanggal").val(),
				m: $("#bulan").val(),
				y: $("#tahun").val(),
			}
		}).done(function (msg) {
			console.log(msg);
			data = JSON.parse(msg);
			console.log(data);

			if (data.length == 0) {
				alert("anda belum punya data");
				if (confirm("ambil data dari plan ?")) {
					ambil_dari_plan();
				} else {

				}
			} else {
				refresh(data);
			}
		});
	}

	ajax_refresh();
    refresh_modal();

	// $("#tambah").click(function () {
	// 	// station_refresh();
	// 	auto_wo_number();
	// 	setTimeout(function () {
	// 		$("#search").val("");
	// 		$("#search").focus();
	// 	}, 500);

	// 	var list = {
	// 		url: BASE_URL + "index.php/sub_unit/listing/" + $("#pabrik").val(),
	// 		getValue: "list",
	// 		requestDelay: 500,
	// 		list: {
	// 			match: {
	// 				enabled: true
	// 			}
	// 		}
	// 	};

	// 	$("#search").easyAutocomplete(list);
	// 	$("#search").parent().css("width", "100%");

	// 	$("#search").keypress(function (e) {
	// 		if (e.which == 13 && $(this).val() != "") {
	// 			var txt = $(this).val();
	// 			var item = txt.split("-");
	// 			add($("#no_wo_auto").val(), item[0], item[1], item[2]);
	// 		}
	// 		console.log(e);
	// 	});

	// });



	$("#tplus").click(function () {
		// console.log($("#no_wo_auto").val()+"-"+$("#station").val()+"-"+$("#unit").val()+"-"+$("#sub_unit").val())
		add($("#no_wo_auto").val(), $("#station").val(), $("#unit").val(), $("#sub_unit").val());
	});

	// function auto_wo_number() {
	// 	var nama_pt = $("#pabrik").val();
	// 	var tahun = $("#tahun").val();
	// 	var bulan = $("#bulan").val();
	// 	var tanggal = $("#tanggal").val();

	// 	var no_wo = nama_pt + "-" + tahun + "-" + bulan + "-" + tanggal;

	// 	dx = $('#my-spreadsheet').jexcel('getData');
	// 	console.log(dx);
	// 	// if (dx[0][0] == "") { // kosong
	// 	//     dx[0][0] = no;
	// 	//     dx[0][0] = sx;
	// 	//     dx[0][1] = ux;
	// 	//     dx[0][2] = su;
	// 	// } else { // isi satu
	// 	console.log(dx.length);
	// 	// if(dx.length){}
	// 	var auto_number = null;
	// 	var last = dx[dx.length - 1][0];
	// 	if (last == "" && dx.length == 1) {
	// 		auto_number = 1;
	// 	} else if (last != "") {
	// 		d = last.split("-");
	// 		last_number = parseInt(d[4]);
	// 		auto_number = last_number + 1;
	// 	}
	// 	if (auto_number < 10) {
	// 		auto_number = "0" + auto_number;
	// 	}

	// 	no_wo += "-" + auto_number;

	// 	$("#no_wo_auto").val(no_wo);
	// }
});
