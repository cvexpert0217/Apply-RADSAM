
$(document).ready(function($){
	
	function goPage(page) {
		$('input[name="currentPage"]').val(page);
		$('form[name="mainForm"]').submit();
	}

	$('.page-link').on('click', function(){
		var page = $(this).attr('data-page');
		goPage(page);
	});

	$('.btn-status').on('click', function(){
		var btn = this;
		var badge = $(this).closest('tr').find('span.badge');
		var id = $(this).attr('data-id');
		var status = $(this).attr('data-status');
		var token = $('input[name="_token"]').val();
		$.ajax({
			url : '/admin/user/status',
			type : 'POST',
			data : {
				id : id,
				use_status : status,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					if (status == 1) {
						$(btn).removeClass('btn-success').addClass('btn-danger').attr('data-status', 0).text('Disable');
						$(badge).removeClass('badge-secondary').addClass('badge-success').text('Active');
					} else {
						$(btn).removeClass('btn-danger').addClass('btn-success').attr('data-status', 1).text('Enable');
						$(badge).removeClass('badge-success').addClass('badge-secondary').text('Inactive');
					}
				}
			}
		});
	});

	$('.btn-delete').on('click', function(){
		var id = $(this).attr('data-id');
		$('input[name="id"]').val(id);
		$('#deleteModal').modal('show');
	});

	$('.btn-confirm-delete').on('click', function(){
		var id = $('input[name="id"]').val();
		var token = $('input[name="_token"]').val();
		$.ajax({
			url : '/admin/user/delete',
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
