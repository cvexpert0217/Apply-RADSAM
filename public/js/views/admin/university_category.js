
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

	$('#editForm').submit(function() {

		if (isNaN($('form[name="editForm"] input[name="tuition"]').val())) {
			$('form[name="editForm"] input[name="tuition"]').focus().select();
			toastr.error('Please enter valid amount.', 'University');
		}
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
					//$('form[name="mainForm"]').submit();
					toastr.success('A new university has been added successfully!', 'University Category');
					setTimeout(function() {
						location.reload();
					}, 1000);
				} else {
					toastr.error('An error occurred while adding university!', 'University Category');
				}
			}
		});

		return false;
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

});
