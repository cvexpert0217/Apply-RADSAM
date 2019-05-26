
$(document).ready(function($){
    $('.btn-apply').on('click', function () {
        var universityId = $(this).attr('data-id');
        var activityId = $('input[name="id"]').val();
        goPolicy(activityId, universityId);
    });

    function goPolicy(activityId, universityId) {
        this.location.href = '/policy/study/' + activityId + '?' + universityId;
    }
});
