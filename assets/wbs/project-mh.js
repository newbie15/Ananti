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

	function refresh(data) {
		var nama_pt = $("#pabrik").val();
		var tahun = $("#tahun").val();
		var bulan = $("#bulan").val();
		var tanggal = $("#tanggal").val();

		if (data == undefined) {
			data = [];
		}

		$('#my-spreadsheet').jexcel({
			data: data,
			allowInsertColumn: false,
			// tableOverflow: true,
			// tableHeight: '400px',
			// onchange: handler,
			// colHeaders: ['Tanggal', 'No WO', 'Station', 'Equipment', 'Problem', 'Penjelasan<br>Masalah', 'HM', 'Kategori', 'status'],
			colHeaders: ['No WO', 'Project ID', 'PT', 'Nama', 'Desc', 'Plan MH', 'Real MH'],
			// colWidths: [140, 140, 140, 140, 250, 250, 100, 75, 80, 80],
			colWidths: [140, 140, 100, 250, 250, 100, 100, 100, 80],
			columns: [
                { type: 'text', },
				{ type: 'text', },
				{ type: 'text', },
				{ type: 'text', },
				{ type: 'text', },
			]
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

	function add(no, sx, ux, su) {
		var sama = 0;
		var index = 0;
		dx = $('#my-spreadsheet').jexcel('getData');
		console.log(dx);
		if (dx[0][0] == "") { // kosong
			dx[0][0] = no;
			dx[0][1] = sx + "\n" + ux + "\n" + su;
			// dx[0][2] = ux;
			// dx[0][3] = su;
		} else { // isi satu
			dx.push([no, sx + "\n" + ux + "\n" + su, "", "", "", "", "", "", "", "", ""]);
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

	// $("#simpan").click(function () {
	// 	var data_j = $('#my-spreadsheet').jexcel('getData');
	// 	console.log(data_j);

	// 	$.ajax({
	// 		method: "POST",
	// 		url: BASE_URL + "project/simpan",
	// 		success: sukses,
	// 		data: {
	// 			pabrik: $("#pabrik").val(),
	// 			d: $("#tanggal").val(),
	// 			m: $("#bulan").val(),
	// 			y: $("#tahun").val(),
	// 			data_json: JSON.stringify(data_j),
	// 		}
	// 	}).done(function (msg) {
	// 		console.log(msg);
	// 	});
	// });

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
			url: BASE_URL + "projectmanhour/load_mh",
			data: {
                id_pabrik: $("#pabrik").val(),                
				tanggal: $("#tanggal").val(),
				bulan: $("#bulan").val(),
				tahun: $("#tahun").val(),
			}
		}).done(function (msg) {
			console.log(msg);
			data = JSON.parse(msg);
			console.log(data);
			refresh(data);
		});
	}

	ajax_refresh();

	$("#tambah").click(function () {
		station_refresh();
		auto_wo_number();
		setTimeout(function () {
			$("#search").val("");
			$("#search").focus();
		}, 500);

		var list = {
			url: BASE_URL + "index.php/sub_unit/listing/" + $("#pabrik").val(),
			getValue: "list",
			requestDelay: 500,
			list: {
				match: {
					enabled: true
				}
			}
		};

		$("#search").easyAutocomplete(list);
		$("#search").parent().css("width", "100%");

		$("#search").keypress(function (e) {
			if (e.which == 13 && $(this).val() != "") {
				var txt = $(this).val();
				var item = txt.split("-");
				add($("#no_wo_auto").val(), item[0], item[1], item[2]);
			}
			console.log(e);
		});

	});



	$("#tplus").click(function () {
		// console.log($("#no_wo_auto").val()+"-"+$("#station").val()+"-"+$("#unit").val()+"-"+$("#sub_unit").val())
		add($("#no_wo_auto").val(), $("#station").val(), $("#unit").val(), $("#sub_unit").val());
	});

	function auto_wo_number() {
		var nama_pt = $("#pabrik").val();
		var tahun = $("#tahun").val();
		var bulan = $("#bulan").val();
		var tanggal = $("#tanggal").val();

		var no_wo = nama_pt + "-" + tahun + "-" + bulan + "-" + tanggal;

		dx = $('#my-spreadsheet').jexcel('getData');
		console.log(dx);
		// if (dx[0][0] == "") { // kosong
		//     dx[0][0] = no;
		//     dx[0][0] = sx;
		//     dx[0][1] = ux;
		//     dx[0][2] = su;
		// } else { // isi satu
		console.log(dx.length);
		// if(dx.length){}
		var auto_number = null;
		var last = dx[dx.length - 1][0];
		if (last == "" && dx.length == 1) {
			auto_number = 1;
		} else if (last != "") {
			d = last.split("-");
			last_number = parseInt(d[4]);
			auto_number = last_number + 1;
		}
		if (auto_number < 10) {
			auto_number = "0" + auto_number;
		}

		no_wo += "-" + auto_number;

		$("#no_wo_auto").val(no_wo);
	}
});
