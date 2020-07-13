function validasinik(id_nik) {
	var nik = $("#"+id_nik).val();
	if (nik == "") {
		alert("NIK harus diisi..!!");
	} else {
		$.ajax({
		    type: "POST",
		    data: {nik: nik},
		    url: base_url+"index.php/sid_core/cek_nik",
		    beforeSend: function(){
					$("#detil_nik").html("Sedang mencari NIK...");
				},
		    success: function(r, textStatus, jqXHR) {	
		    	if (r.status == false) {
		    		$("#"+id_nik).val('');
		    		$("#"+id_nik).focus();
		    	} 

		    	$("#detil_nik").html(r.htm);
		    },
		    error: function(xhr) {
					console.log(xhr);
		    }
		});
	}

	return false;
}

function simpan_yang_ada_niknya(id_nik) {
	var nik = $("#"+id_nik).val();
	if (nik == "") {
		alert("NIK harus diisi..!!");
	} else {
		$.ajax({
		    type: "POST",
		    data: {nik: nik},
		    url: base_url+"index.php/sid_core/cek_nik",
		    success: function(r, textStatus, jqXHR) {	
		    	$("#detil_nik").html(r.htm);
		    },
		    error: function(xhr) {
					console.log(xhr);
		    }
		});
	}

	return false;
}