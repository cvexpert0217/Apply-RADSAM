
$(document).ready(function($){
    $('#confirm-policy-visa').on('click', function() {
        if ($(this).is(':checked')) {
            $('.btn-confirm-policy-visa').attr('disabled', false);
        } else {
            $('.btn-confirm-policy-visa').attr('disabled', true);
        }
    });

    $('.btn-confirm-policy-visa').on('click', function () {
        var assessment_id = window.location.pathname.charAt(window.location.pathname.length-1);
        registerPolicyVisa(assessment_id);
    });

    $('#confirm-policy-study').on('click', function() {
        if ($(this).is(':checked')) {
            $('.btn-confirm-policy-study').attr('disabled', false);
        } else {
            $('.btn-confirm-policy-study').attr('disabled', true);
        }
    });

    $('.btn-confirm-policy-study').on('click', function () {
        var universityId = $('input[name="university_id"]').val();
        var activityId = $('input[name="study_id"]').val();
        registerPolicyStudy(activityId, universityId);
    });

    function registerPolicyVisa(assessment_id) {
        $.ajax({
            type: "POST",
            url: "/policy/register",
            data: {
                'assessment_id': assessment_id
            },
            dataType : 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
            },
            success: function(response){
                if (response['success'] == 1)
                    goHome();
            },
            error: function(response){
                console.log(response);
            }
        });
    }

    function registerPolicyStudy(activityId, universityId) {
        $.ajax({
            type: "POST",
            url: "/policy/register",
            data: {
                'activity_id': activityId,
                'university_id': universityId
            },
            dataType : 'json',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
            },
            success: function(response){
                if (response['success'] == 1)
                    goHome();
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

    function goHome() {
        this.location.href = "/";
    }
});
