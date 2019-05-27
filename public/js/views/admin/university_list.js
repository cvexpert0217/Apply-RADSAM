
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
		$('#acceptModal .modal-title').text('Accept - ' + activity.first_name + ' ' + activity.last_name);
		$('#acceptModal input#activity_id').val(activity.id);
	}

	$('.btn-accept').on('click', function(){
		var id = $(this).attr('data-id');
		var token = $('form[name="mainForm"] input[name="_token"]').val();

		$.ajax({
			url : '/admin/assessment/view',
			type : 'POST',
			data : {
				activity_id : id,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					if ((data.activity.activity_type == 1) && (data.activity.status == 0)) {
						if (data.activity.assessment_type == 1) {
							initVisaModal(data.activity);
							$('#acceptModal').modal('show');
						}
					}
				}
			}
		});
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

		$('#acceptModal #tableFee tbody').append(tr);

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

	$('#accept_form').submit(function () {
		var sumPrice = $('#accept_form input#sumPrice').val();
		if (sumPrice === "") {
			toastr.warning('Please, insert fee information correctly!', 'Fee Information');
			return false;
		}

		$.ajax({
			url : '/admin/university/accept',
			type : 'POST',
			data : $('#accept_form').serialize(),
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					$('#accept_form').modal('hide');
					toastr.success('Successfully Accept!', 'University');
					setTimeout(function() {
						location.reload();
					}, 1000);
				} else {
					toastr.error('An error occurred while accepting!', 'University');
				}
			}
		});

		return false;
	});

	$('.btn-reject').on('click', function(){
		var activity_id = $(this).attr('data-id');
		$('#rejectModal input#inputActivityId').val(activity_id);
		$('#rejectModal').modal('show');
	});

	$('#rejectForm').submit(function () {
		var activity_id = $('#rejectModal input#inputActivityId').val();
		var msg_title = $('#rejectModal input#inputMsgTitle').val();
		var msg_content = $('#rejectModal textarea#txtMsgContent').val();
		var token = $('form[name="mainForm"] input[name="_token"]').val();

		$.ajax({
			url : '/admin/university/reject',
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
					toastr.success('Successfully Reject!', 'University');
					setTimeout(function() {
						location.reload();
					}, 1000);
				} else {
					toastr.error('An error occurred while rejecting!', 'Universitys');
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
