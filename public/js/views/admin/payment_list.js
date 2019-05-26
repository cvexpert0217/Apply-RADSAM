
$(document).ready(function($){

	$("#check_group_college").hide();
	$("#check_group_school").hide();
	$("#check_group_visa").hide();

	$("#doc_type").change(function(e){
		var doc_type = $("#doc_type").val();
		if(doc_type == 0){
			$("#check_group_university").show();
			$("#check_group_college").hide();
			$("#check_group_school").hide();
			$("#check_group_visa").hide();
		} else if (doc_type == 1) {
			$("#check_group_college").show();
			$("#check_group_university").hide();
			$("#check_group_school").hide();
			$("#check_group_visa").hide();
		} else if (doc_type == 2) {
			$("#check_group_college").hide();
			$("#check_group_university").hide();
			$("#check_group_school").show();
			$("#check_group_visa").hide();
		} else if (doc_type == 3) {
			$("#check_group_college").hide();
			$("#check_group_university").hide();
			$("#check_group_school").hide();
			$("#check_group_visa").show();
		}
	});

	function goPage(page) {
		$('input[name="currentPage"]').val(page);
		$('form[name="mainForm"]').submit();
	}

	$('.page-link').on('click', function(){
		var page = $(this).attr('data-page');
		goPage(page);
	});

	$('.btn-edit').on('click', function(){
		var activity_id = $(this).attr('activity-id');
		var assessment_id = $(this).attr('assessment-id');

		$('form[name="editForm"] input[name="activity_id"]').val(activity_id);
		$('form[name="editForm"] input[name="assessment_id"]').val(assessment_id);
		$('#editModal').modal('show');
	});

	$('#editForm').submit(function() {
		var token = $('form[name="editForm"] input[name="_token"]').val();
		$.ajax({
			url : '/admin/payment/accept',
			type : 'POST',
			data : $('#editForm').serialize(),
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					$('#editModal').modal('hide');
					$('form[name="mainForm"]').submit();
				}
			}
		});

		return false;
	});

	$('.btn-delete').on('click', function(){
		var activity_id = $(this).attr('activity-id');
		$('form[name="rejectForm"] input[name="activity_id"]').val(activity_id);

		$('#rejectModal').modal('show');
	});

	$('#rejectForm').submit(function () {
		$.ajax({
			url : '/admin/payment/reject',
			type : 'POST',
			data : $('#rejectForm').serialize(),
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					$('#rejectModal').modal('hide');
					toastr.success('Successfully Accept!', 'Payment');
					setTimeout(function() {
						location.reload();
					}, 1000);
				} else {
					toastr.error('An error occurred while rejecting!', 'Payment');
				}
			}
		});

		return false;
	});

});
