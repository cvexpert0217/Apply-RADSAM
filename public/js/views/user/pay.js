$(document).ready(function($){
    $('.btn-pay-bill').on('click', function () {
        $('input[name="pay_type"]').val(0);
        $('#pay_image_file').click();
    });

    $('.btn-pay-paypal').on('click', function () {
        $('input[name="pay_type"]').val(1);
        $('#pay_image_file').click();
    });

    $('#pay_image_file').on('change', function () {
        var file = $(this).val();
        var index = file.lastIndexOf("\\");
        var fileName = file.substring(index+1, file.length);
        $('input[name="pay_image"]').val(fileName);
        $('form').submit();
    });
});