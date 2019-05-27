
$(document).ready(function($){
	function goPage(page) {
		$('input[name="currentPage"]').val(page);
		$('form[name="mainForm"]').submit();
	}

	$('.page-link').on('click', function(){
		var page = $(this).attr('data-page');
		goPage(page);
	});

	function initVisaModal(activity) {
		$('#acceptVisaModal .modal-title').text('Accept - ' + activity.first_name + ' ' + activity.last_name);
		$('#acceptVisaModal input#activity_id').val(activity.id);
	}

	function initStudyModal(activity) {
		$('#acceptStudyModal .modal-title').text('Accept - ' + activity.first_name + ' ' + activity.last_name);
		$('#acceptStudyModal select#selectFilter').val(0);
		$('#acceptStudyModal input#inputMsgTitle').val('');
		$('#acceptStudyModal textarea#txtMsgContent').val('');
		$('#acceptStudyModal #tableUniversity tbody').html('');
		
		$('#acceptStudyModal input#inputActivityId').val(activity.id);
	}
	function updateUniversityTable(type) {
		var token = $('form[name="mainForm"] input[name="_token"]').val();
		$.ajax({
			url : '/admin/assessment/universities',
			type : 'POST',
			data : {
				type : type,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				var tr = '';
				for (i = 0; i < data.universities.length; i++) {
					tr += '<tr>';
					tr += '<td>' + parseInt(i + 1) + '</td>';
					tr += '<td>' + data.universities[i].name + '</td>';
					tr += '<td>' + data.universities[i].tuition + '</td>';
					tr += '<td>' + data.universities[i].start_date + '</td>';
					if (data.universities[i].type == 0)
						tr += '<td>' + 'University' + '</td>';
					else if (data.universities[i].type == 1)
						tr += '<td>' + 'College' + '</td>';
					else if (data.universities[i].type == 2)
						tr += '<td>' + 'School' + '</td>';
					tr += '<td><input name="checkUniversity" type="checkbox" class="form-control" value="' + data.universities[i].id + '"></td>';
					tr += '</tr>';
				}
				$('#acceptStudyModal #tableUniversity tbody').html(tr);
			}
		});
	}

	$('#acceptStudyModal select#selectFilter').on('change', function(){
		var type = $(this).val();
		updateUniversityTable(type);
	});

	$('.btn-open-accept').on('click', function() {
		var activity_id = $(this).attr('data-activity-id');
		var token = $('form[name="mainForm"] input[name="_token"]').val();

		$.ajax({
			url : '/admin/assessment/view',
			type : 'POST',
			data : {
				activity_id : activity_id,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					if ((data.activity.activity_type == 0) && (data.activity.status == 0)) {
						if (data.activity.assessment_type == 0) {	// Visa
							initVisaModal(data.activity);
							$('#acceptVisaModal').modal('show');
						} else {	// Study
							initStudyModal(data.activity);
							updateUniversityTable(0);
							$('#acceptStudyModal').modal('show');
						}
					} else {
						
					}
				} else {
					
				}
			}
		});
	});

	$('#accept_study_form').submit(function () {
        var checkUniversity = $('#acceptStudyModal input[name="checkUniversity"]:checked');
        if (checkUniversity.length == 0) {
            toastr.warning('Please, select more than one university!', 'Assessment');
            return false;
        }

        var activity_id = $('#acceptStudyModal input#inputActivityId').val();
        var start_date = $('#acceptStudyModal input#inputStartDate').val();
        var university = [];
        for (i = 0; i < checkUniversity.length; i++) {
            university[i] = $(checkUniversity[i]).val();
        }
        var msg_title = $('#acceptStudyModal input#inputMsgTitle').val();
        var msg_content = $('#acceptStudyModal textarea#txtMsgContent').val();
        var token = $('form[name="mainForm"] input[name="_token"]').val();

        $.ajax({
            url : '/admin/assessment/accept',
            type : 'POST',
            data : {
                activity_id : activity_id,
                start_date : start_date,
                university : university,
                msg_title : msg_title,
                msg_content : msg_content,
                _token : token
            },
            dataType : 'json',
            success: function(data){
                if (data.result == 'success') {
                    $('#acceptStudyModal').modal('hide');
                    toastr.success('Successfully Accept!', 'Assessment');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error('An error occurred while accepting!', 'Assessment');
                }
            }
        });

        return false;
    });

	$('.btn-open-reject').on('click', function() {
		var activity_id = $(this).attr('data-activity-id');
		$('#rejectModal input#inputActivityId').val(activity_id);

		$('#rejectModal').modal('show');
	});

	$('#rejectForm').submit(function () {
        var activity_id = $('#rejectModal input#inputActivityId').val();
        var msg_title = $('#rejectModal input#inputMsgTitle').val().trim();
        var msg_content = $('#rejectModal textarea#txtMsgContent').val().trim();
        var token = $('form[name="mainForm"] input[name="_token"]').val();

        $.ajax({
            url : '/admin/assessment/reject',
            type : 'POST',
            data : {
                activity_id : activity_id,
                msg_title : msg_title,
                msg_content : msg_content,
                _token : token
            },
            dataType : 'json',
            success: function(data){
                if (data.result == 'success') {
                    $('#rejectModal').modal('hide');
                    toastr.success('A reject message has been sent successfully', 'Assessment');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error('An error occurred while sending', 'Assessment');
                }
            }
        });

        return false;
    });

	$('#rejectModal input#inputMsgTitle').keypress(function () {
		if($(this).val().trim() === ""){
			$('#rejectModal input#inputMsgTitle').attr('style','border-color:red');
		}else{
			$('#rejectModal input#inputMsgTitle').attr('style','border-color:green');
		}
	});

	$('#rejectModal textarea#txtMsgContent').keypress(function(){

	});


	$('.btn-new-fee').on('click', function() {
		var tr = '';
		tr += '<tr>';
		tr += '<td>' + '<input type="text" class="tbl-row-name form-control" name="fee_name[]">' + '</td>';
		tr += '<td>' + '<input type="text" class="tbl-row-price form-control" name="price[]">' + '</td>';
		tr += '<td>' + '<input type="text" class="tbl-row-quantity form-control" name="quantity[]">' + '</td>';
		tr += '<td>' + '<input type="text" class="tbl-row-total form-control" readonly name="total[]">' + '</td>';
		tr += '<td>' + '<button type="button" class="btn tbl-remove-row"><i class="fa fa-window-close fa-lg"></i></button>' + '</td>';
		tr += '</tr>';

		$('#acceptVisaModal #tableFee tbody').append(tr);

		$('.tbl-remove-row').click(function(){
			$(this).parent().parent().remove();
			sumPrice();
		});

		$('.tbl-row-price').keypress(function(e){
			var price = $(this).val();
			var quantity = $(this).parent().next().children().val();
			var $total = $(this).parent().next().next().children();
			if(e.keyCode === 13){
				if(quantity === ""){
					$total.val("0");
				}else{
					$total.val(quantity * price);
				}
				sumPrice();
			}
		});

		$('.tbl-row-quantity').keypress(function(e){
			var quantity = $(this).val();
			var price = $(this).parent().prev().children().val();
			var $total = $(this).parent().next().children();
			if(e.keyCode === 13){
				if(quantity === ""){
					$total.val("0");
				}else{
					$total.val(quantity * price);
				}
				sumPrice();
			}
		});
	});

	$('#accept_visa_form').submit(function () {
		var sumPrice = $('#accept_visa_form input#sumPrice').val();
		if (sumPrice === "") {
			toastr.warning('Please, insert fee information correctly!', 'Fee Information');
			return false;
		}

		$.ajax({
			url : '/admin/assessment/accept_visa',
			type : 'POST',
			data : $('#accept_visa_form').serialize(),
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					$('#rejectModal').modal('hide');
					toastr.success('Successfully Accept!', 'Assessment');
					setTimeout(function() {
						location.reload();
					}, 1000);
				} else {
					toastr.error('An error occurred while accepting!', 'Assessment');
				}
			}
		});

		return false;
	});

	function sumPrice(){
		var sum = 0;
		$('.tbl-row-total').each(function(){
			if($(this).val() !== ""){
				sum += parseFloat($(this).val());
			}
		});

		$('#sumPrice').val(parseFloat(sum));

		totalPrice();
	}

	function totalPrice() {
		if ($('#sumPrice').val() === "" || $('#hst').val() === "") {
			$('#pay_price').val(0);
		} else {
			var sumPrice = $('#sumPrice').val();
			var	hst = $('#hst').val();
			$('#pay_price').val(parseFloat(sumPrice) + parseFloat(sumPrice * hst/100));
		}
	}

	$('#hst').keypress(function(e) {
		if(e.keyCode === 13) {
			totalPrice();
		}
	});
});
