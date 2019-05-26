
$(document).ready(function($){
	
	function goPage(page) {
		$('input[name="currentPage"]').val(page);
		$('form[name="mainForm"]').submit();
	}

	$('.page-link').on('click', function(){
		var page = $(this).attr('data-page');
		goPage(page);
	});

	$('.btn-detail').on('click', function(){
		var id = $(this).attr('data-msg-id');
		var token = $('form[name="mainForm"] input[name="_token"]').val();

		$.ajax({
			url : '/admin/invoice/detail',
			type : 'POST',
			data : {
				id : id,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				if (data.invoice) {
					$('#detailModal input[name="assessment_name"]').val(data.invoice.first_name + " " + data.invoice.last_name);

					var str_activity_type;
					var activity_type = data.invoice.activity_type;
					switch (activity_type) {
						case 0:
							str_activity_type = "Assessment";
							break;
						case 1:
							str_activity_type = "University";
							break;
						case 2:
							str_activity_type = "Payment";
							break;
						case 3:
							str_activity_type = "Upload Docs";
							break;
						case 4:
							str_activity_type = "Admission";
							break;
					}
					$('#detailModal input[name="activity_type"]').val(str_activity_type);

					var str_status;
					switch (data.invoice.status) {
						case 0:
							str_status = "Waiting";
							break;
						case 1:
							str_status = "Accept";
							break;
						case 2:
							str_status = "Reject";
							break;
					}
					$('#detailModal input[name="status"]').val(str_status);

					$('#detailModal input[name="msg_title"]').val(data.invoice.msg_title);
					$('#detailModal textarea[name="msg_content"]').val(data.invoice.msg_content);
					$('#detailModal input[name="created_at"]').val(data.invoice.created_at);
					$('#detailModal input[name="registrant"]').val(data.invoice.user_name);
				} else {
					$('#detailModal input[name="assessment_name"]').val();
					$('#detailModal input[name="activity_type"]').val();
					$('#detailModal input[name="status"]').val();
					$('#detailModal input[name="msg_title"]').val();
					$('#detailModal input[name="msg_content"]').val();
					$('#detailModal input[name="created_at"]').val();
					$('#detailModal input[name="registrant"]').val();
				}
				$('#detailModal').modal('show');
			}
		});
	});

	$('.btn-reply').on('click', function(){
		var msg_id = $(this).attr('data-msg-id');
		$('#replyModal input#inputMsgId').val(msg_id);

		$('#replyModal').modal('show');
	});

	$('.btn-send').on('click', function(){
		var msg_admin_id = $('#replyModal input#inputMsgId').val();
		var msg_title = $('#replyModal input#msg_title').val();
		var msg_content = $('#replyModal textarea#msg_content').val();
		var token = $('#replyModal input[name="_token"]').val();

		$.ajax({
			url : '/admin/invoice/reply',
			type : 'POST',
			data : {
				id : msg_admin_id,
				msg_title : msg_title,
				msg_content : msg_content,
				_token : token
			},
			dataType : 'json',
			success: function(data){
				if (data.result == 'success') {
					$('#replyModal').modal('hide');
					$('form[name="mainForm"]').submit();
				}
			}
		});
	});

});
