$(document).ready(function() {
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
});