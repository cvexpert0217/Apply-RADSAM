
$(document).ready(function($){
	
	function goPage(page) {
		$('input[name="currentPage"]').val(page);
		$('form[name="mainForm"]').submit();
	}

	$('.page-link').on('click', function(){
		var page = $(this).attr('data-page');
		goPage(page);
	});

	$('.btn-edit').on('click', function(){
		var id = $(this).attr('data-id');
		var token = $('form[name="mainForm"] input[name="_token"]').val();
		$.ajax({
			url : '/admin/university_category/edit',
			type : 'POST',
			data : {
				id : id,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				if (data.category) {
					$('form[name="editForm"] input[name="id"]').val(data.category.id);
					$('form[name="editForm"] input[name="name"]').val(data.category.name);
					$('form[name="editForm"] input[name="start_date"]').val(data.category.start_date);
					$('form[name="editForm"] input[name="tuition"]').val(data.category.tuition);
					$('form[name="editForm"] select[name="type"]').val(data.category.type);
				} else {
					$('form[name="editForm"] input[name="id"]').val('');
					$('form[name="editForm"] input[name="name"]').val('');
					$('form[name="editForm"] input[name="start_date"]').val('');
					$('form[name="editForm"] input[name="tuition"]').val('');
					$('form[name="editForm"] select[name="type"]').val('');
				}
				$('#editModal').modal('show');
			}
		});
	});

	$('.btn-save').on('click', function(){
		var form = document.getElementById('editForm');
		if (form.checkValidity() === false) {
			form.classList.add('was-validated');
		} else {
			form.classList.add('was-validated');

			var token = $('form[name="editForm"] input[name="_token"]').val();
			$.ajax({
				url : '/admin/university_category/save',
				type : 'POST',
				data : {
					_token : token,
					'id' : $('form[name="editForm"] input[name="id"]').val(),
					'name' : $('form[name="editForm"] input[name="name"]').val(),
					'start_date' : $('form[name="editForm"] input[name="start_date"]').val(),
					'tuition' : $('form[name="editForm"] input[name="tuition"]').val(),
					'type' : $('form[name="editForm"] select[name="type"]').val()
				},
				dataType : 'json',
				success: function(data){
					if (data.result == 'success') {
						$('#editModal').modal('hide');
						$('form[name="mainForm"]').submit();
					}
				}
			});
		}
	});

	$('.btn-delete').on('click', function(){
		var id = $(this).attr('data-id');
		$('form[name="mainForm"] input[name="id"]').val(id);
		$('#deleteModal').modal('show');
	});

	$('.btn-confirm-delete').on('click', function(){
		var id = $('input[name="id"]').val();
		var token = $('input[name="_token"]').val();
		$.ajax({
			url : '/admin/university_category/delete',
			type : 'POST',
			data : {
				id : id,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					$('#deleteModal').modal('hide');
					$('form[name="mainForm"]').submit();
				}
			}
		});
	});

	$('.btn-docs').on('click', function() {
		var assessment_id = $(this).attr('data-id');
		var token = $('form[name="mainForm"] input[name="_token"]').val();

		$.ajax({
			url : '/admin/uploaddocs/detail',
			type : 'POST',
			data : {
				assessment_id : assessment_id,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				if (data.result == 'success' && data.docs_list && data.name_dir) {
					$('#docsModal #tableDocs tbody').html("");
					for (var i=0; i<data.docs_list.length; i++) {
						var docs_info = data.docs_list[i];

						var type = docs_info.docs_type;
						var req_id = docs_info.docs_req_id;
						var doc_name = docs_info.docs_name;
						var doc_realname = docs_info.docs_realname;

						createDocInfo(type, req_id, doc_name, doc_realname, data.name_dir);
					}

					alert('success');
					$('#docsModal').modal('show');
				}
			}
		});
	});

	function createDocInfo(type, req_id, doc_name, doc_realname, name_dir) {
		var req_str = "";
		switch (type) {
			case 0:
			case 1:
				req_str = university_require_list[req_id];
				break;
			case 2:
				req_str = school_require_list[req_id];
				break;
			case 3:
				req_str = visa_require_list[req_id];
				break;
			default:
				return;
		}

		var tr = '<tr>';
		tr += '<td>' + req_str + '</td>';
		tr += '<td>' + '<a href="' + name_dir + '/' + doc_realname + '" download>' + doc_name + '</a>' + '</td>';
		tr += '</tr>';

		$('#docsModal #tableDocs tbody').append(tr);
	}

	var university_require_list = [
		"All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca",
		"The birth certificate and national ID of student and all family members",
		"Scan of the current and previous passport of the student and all family members",
		"The High School diploma and transcripts",
		"Bachelor degree and transcripts",
		"Resume(CV) of the Student in English",
		"IELTS Academic certificate (if applicable)",
		"The Police clearance certificate of the student and all family members.",
		"The residential and commercial property ownership certificates.",
		"The residential and commercial lease agreements.",
		"The vehicle ownership certificates.",
		"Bank statement letter for four past months.",
		"The article of incorporation and/or business license for self-employed applicants.",
		"The employment letter verification and two last pay stubs for employed applicants.",
		"Colorful photography of the student, 3.5 cm * 4.5 cm with white background.",
		"The military certificate for male applicants.",
		"An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.",
		"An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.",
		"Previous visa refusal letters of Canada or the Unites States of America."
	];

	var school_require_list = [
		"All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca",
		"The birth certificate and national ID card of student parents.",
		"Scan of the current and previous passport of the student and parents.",
		"Two latest school transcripts.",
		"Vaccination card.",
		"Resume(CV) of the Student in English with the scan of all certificates",
		"The Police clearance certificate of the student and parents.",
		"The residential and commercial property ownership certificates under the name the name of student and parents.",
		"The residential and commercial lease agreements under the name the name of student and parents.",
		"The vehicle ownership certificates under the name the name of student and parents.",
		"Bank statement letter for four past months.",
		"The article of incorporation and/or business license for self-employed parents.",
		"The employment letter verification and two last pay stubs for employed parents.",
		"The student and parents Colorful photography of the student, 3.5 cm * 4.5 cm with white background.",
		"An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.",
		"An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.",
		"Previous visa refusal letters of Canada or the Unites States of America."
	];

	var visa_require_list = [
		"All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca",
		"The official invitation letter or the full information of the inviter who is a Canadian permanent resident or citizen.",
		"The Police clearance certificate of the student and all family members.",
		"The residential and commercial property ownership certificates.",
		"The residential and commercial lease agreements.",
		"The vehicle ownership certificates.",
		"Bank statement letter for four past months.",
		"The article of incorporation and/or business license for self-employed applicants.",
		"The employment letter verification and two last pay stubs for employed applicants.",
		"Colorful photography of the student, 3.5 cm * 4.5 cm with white background.",
		"The military certificate for male applicants.",
		"An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.",
		"An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.",
		"Previous visa refusal letters of Canada or the Unites States of America."
	];

});
