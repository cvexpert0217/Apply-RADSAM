
$(document).ready(function($){
    jQuery(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "/recent/message/count",
            success: function(response){
                if (response > 0)
                    $('#alarm').html(response);
                else
                    $('#alarm').attr('hidden', true);
            },
            error: function(response){
                console.log("alarm get error");
            }
        });
        setTimer();
    });

    function setTimer(){
        setTimeout(function(){
            $.ajax({
                type: "GET",
                url: "/recent/message/count",
                success: function(response){
                    $('#alarm').html(response);
                },
                error: function(response){
                    console.log("alarm get error");
                }
            });
            setTimer();
        }, 30000);
    }

    $('.btn-reply').on('click', function(){
        var messageId = $(this).attr('data-id');
        var activityId = $(this).attr('data-activity-id');
        $('input[name="id"]').val(messageId);        
        $('input[name="activity_id"]').val(activityId);
        messageBrowsed(messageId);
        $('.reply-message-title').val("");
        $('.reply-message-title').css("border", "1px solid rgb(169, 169, 169)");
        $('.reply-message-title-invalid').text("");
        $('.reply-message-content').val("");
        $('.reply-message-content').css("border", "1px solid rgb(169, 169, 169)");
        $('.reply-message-content-invalid').text("");
        $('#replyModal').modal('show');
    });

    $('.btn-confirm-reply').on('click', function(){
        var messageId = $('input[name="id"]').val();
        var activityId = $('input[name="activity_id"]').val();
        if ($('.reply-message-title').val() != "" && $('.reply-message-content').val() != "") {
            var message = {
                'activity_id': activityId,
                'user_message_id': messageId,
                'msg_title': $('.reply-message-title').val(),
                'msg_content': $('.reply-message-content').val(),
                'deleted': 0
            };

            replyMessage(message);
            deleteMessage(messageId);
            $('#replyModal').modal('hide');
        } else {
            if ($('.reply-message-title').val() == "") {
                $('.reply-message-title-invalid').text("Message title is empty.");
                $('.reply-message-title').css("border", "2px solid red");
            } else {
                $('.reply-message-content-invalid').text("Message content is empty.");
                $('.reply-message-content').css("border", "2px solid red");
            }
        }

    });

    $('.btn-next').on('click', function(){
        var messageId = $(this).attr('data-id');
        var activityId = $(this).attr('data-activity-id');
        var activityType = $(this).attr('data-type');
        var assessmentType = $(this).attr('data-assessment-type');
        $('input[name="id"]').val(messageId);
        $('input[name="activity_id"]').val(activityId);
        $('input[name="activity_type"]').val(activityType);
        $('input[name="assessment_type"]').val(assessmentType);
        messageBrowsed(messageId);
        $('.next-message-title').val("");
        $('.next-message-title').css("border", "1px solid rgb(169, 169, 169)");
        $('.next-message-title-invalid').text("");
        $('.next-message-content').val("");
        $('.next-message-content').css("border", "1px solid rgb(169, 169, 169)");
        $('.next-message-content-invalid').text("");
        if (activityType == 0) {
            if (assessmentType == 0)
                $('#show-next-step').text('Next step is Pay. Please click "Next" button to next step.');
            else
                $('#show-next-step').text('Next step is University. Please click "Next" button to next step.');
        }
        else if (activityType == 1)
            $('#show-next-step').text('Next step is Pay. Please click "Next" button to next step.');
        else if(activityType == 2)
            $('#show-next-step').text('Next step is Upload Doc. Please click "Next" button to next step.');
        else if(activityType == 3)
            $('#show-next-step').text('Next step is Admission. Please click "Next" button to next step.');
        else if(activityType == 4)
            $('#show-next-step').text('Next step is Finish. Please click "Next" button to next step.');

        $('#nextReplyModal').modal('show');
    });

    $('.btn-reply-next').on('click', function(){
        var messageId = $('input[name="id"]').val();
        var activityId = $('input[name="activity_id"]').val();
        if ($('.next-message-title').val() != "" && $('.next-message-content').val() != "") {
            var message = {
                'activity_id': activityId,
                'user_message_id': messageId,
                'msg_title': $('.next-message-title').val(),
                'msg_content': $('.next-message-content').val(),
                'deleted': 0
            };

            replyMessage(message);

            $('#nextReplyModal').modal('hide');
            $('#nextModal').modal('show');
        } else {
            if ($('.next-message-title').val() == "") {
                $('.next-message-title-invalid').text("Message title is empty.");
                $('.next-message-title').css("border", "2px solid red");
            } else {
                $('.next-message-content-invalid').text("Message content is empty.");
                $('.next-message-content').css("border", "2px solid red");
            }
        }
    });

    $('.btn-reply-next-cancel').on('click', function () {
        $('#nextReplyModal').modal('hide');
        $('#nextModal').modal('show');
    });

    $('.btn-confirm-next').on('click', function(){
        var activityId = $('input[name="activity_id"]').val();
        var activityType = $('input[name="activity_type"]').val();
        var assessmentType = $('input[name="assessment_type"]').val();
        nextAction(activityId, activityType, assessmentType);
    });

    function messageBrowsed(messageId) {
        $.ajax({
            type: "GET",
            url: "/messageBrowsed",
            data: messageId,
            dataType : 'text',
            success: function(response){
                console.log(response);
                $('#nextModal').modal('hide');
            },
            error: function(response){
                console.log("network error");
            }
        });
    }

    function replyMessage(message) {
        $.ajax({
            type: "POST",
            url: "/replyMessage",
            data: message,
            dataType : 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
            },
            success: function(response){
                if (response.result == 'success') {
                    console.log(response);
                }
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function deleteMessage(messageId) {
        $.ajax({
            type: "GET",
            url: "/deleteMessage",
            data: messageId,
            dataType : 'text',
            success: function(response){
                console.log(response);
            },
            error: function(response){
                console.log("network error");
            }
        });

    }

    function nextAction(activityId, activityType, assessmentType) {
        $('#nextModal').modal('hide');
        if (activityType == 0) {
            if (assessmentType == 0)
                this.location.href = '/pay/' + activityId;
            else
                this.location.href = '/university/' + activityId;

        } else if (activityType == 1) {
            this.location.href = '/pay/' + activityId;
        } else if (activityType == 2) {
            this.location.href = '/upload/' + activityId;
        } else if (activityType == 3) {
            this.location.href = '/admission/' + activityId;
        } else if (activityType == 4) {
            this.location.href = '/finish/' + activityId;
        }
    }

    $('#btn-upload').on('click', function () {
        $('#resume_filename').click();
    });

    $('#resume_filename').on('change', function () {
        var file = $(this).val();
        var index = file.lastIndexOf("\\");
        var fileName = file.substring(index+1, file.length);
        $('#file_name').val(fileName);
    });

    $('form').submit(function () {
        if ($('input[name="gpa_score"]').val()=="" || isNaN($('input[name="gpa_score"]').val())) {
            $('.numeric-invalid').text("Please enter numeric.");
            $('input[name="gpa_score"]').css('border', '2px solid red');

            return false;
        } else {
            $('.numeric-invalid').text("");
            $('input[name="gpa_score"]').css('border', '1px solid #c2cfd6');
        }

        var count = $('input[class="checkbox"]:checked').length;
        if (count > 0) {
            $('.checkbox-group-invalid').text("");
            $('.checkbox-group').css("border", "0px");
        } else {
            $('.checkbox-group-invalid').text("Please check least one.");
            $('.checkbox-group').css("border", "2px solid red");

            return false;
        }

        return true;
    })
});
