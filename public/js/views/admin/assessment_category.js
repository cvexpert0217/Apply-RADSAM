
$(document).ready(function($){
	function goPage(page) {
		$('input[name="currentPage"]').val(page);
		$('form[name="mainForm"]').submit();
	}

	$('.page-link').on('click', function(){
		var page = $(this).attr('data-page');
		goPage(page);
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
			url : '/admin/assessment_category/delete',
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

});
