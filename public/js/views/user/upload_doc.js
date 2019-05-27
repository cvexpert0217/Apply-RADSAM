
$(document).ready(function($){
	$('.btn-upload').on('click', function () {
        $(this).closest('td').find('input').click();
    });

    $('input').on('change', function () {
        var file = $(this).val();
        var index = file.lastIndexOf("\\");
        var fileName = file.substring(index+1, file.length);
        var extension = fileName.split('.')[1];
        var realName = Date.now() + "." + extension;
        var doc_id = $(this).attr('data-id');
        var docFile = $(this).prop('files')[0];
        console.log(docFile);
        var data = new FormData();
        data.append('doc_id', doc_id);
        data.append('doc_name', fileName);
        data.append('doc_realname', realName);
        data.append('doc_file', docFile);
        // store doc_name to db_allowcated_doc;
        $.ajax({
            type: "POST",
            data: data,
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $('input[name="_token"]').val());
            },
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            url: "/upload/save/doc-name",
            success: function(response){
                console.log(response);
            },
            error: function(response){
                console.log("alarm get error");
            }
        });

        $(this).closest('tr').find('span').text(fileName);
        // checkDocsCount();
    });

    $('#btn-register').on('click', function () {

    });

    function checkDocsCount() {
        var length = $('table').find('span').length;
        var count = 0;
        var spans = $('table').find('span');
        for (var i=0; i<spans.length; i++) {
            if (spans[i].textContent != "")
                count ++;
        }

        if (length == count)
            $('#btn-register').attr('disabled', false);
    }
});

function getDocName(type, req_id) {
    var req_str = "";
    switch (type) {
        case 0:
        case 1:
            req_str = university_require_list[req_id];
            break;
        case 2:
            req_str = school_require_list[req_id];
            break;
        case 3:
            req_str = visa_require_list[req_id];
            break;
        default:
            return;
    }

    $('td[data-doc-name='+ req_id +']').text(req_str);
}

var university_require_list = [
    "All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca",
    "The birth certificate and national ID of student and all family members",
    "Scan of the current and previous passport of the student and all family members",
    "The High School diploma and transcripts",
    "Bachelor degree and transcripts",
    "Resume(CV) of the Student in English",
    "IELTS Academic certificate (if applicable)",
    "The Police clearance certificate of the student and all family members.",
    "The residential and commercial property ownership certificates.",
    "The residential and commercial lease agreements.",
    "The vehicle ownership certificates.",
    "Bank statement letter for four past months.",
    "The article of incorporation and/or business license for self-employed applicants.",
    "The employment letter verification and two last pay stubs for employed applicants.",
    "Colorful photography of the student, 3.5 cm * 4.5 cm with white background.",
    "The military certificate for male applicants.",
    "An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.",
    "An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.",
    "Previous visa refusal letters of Canada or the Unites States of America."
];

var school_require_list = [
    "All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca",
    "The birth certificate and national ID card of student parents.",
    "Scan of the current and previous passport of the student and parents.",
    "Two latest school transcripts.",
    "Vaccination card.",
    "Resume(CV) of the Student in English with the scan of all certificates",
    "The Police clearance certificate of the student and parents.",
    "The residential and commercial property ownership certificates under the name the name of student and parents.",
    "The residential and commercial lease agreements under the name the name of student and parents.",
    "The vehicle ownership certificates under the name the name of student and parents.",
    "Bank statement letter for four past months.",
    "The article of incorporation and/or business license for self-employed parents.",
    "The employment letter verification and two last pay stubs for employed parents.",
    "The student and parents Colorful photography of the student, 3.5 cm * 4.5 cm with white background.",
    "An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.",
    "An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.",
    "Previous visa refusal letters of Canada or the Unites States of America."
];

var visa_require_list = [
    "All documents should be officially translated, scanned in JPG format and send to us through Email address: info@radsam.ca",
    "The official invitation letter or the full information of the inviter who is a Canadian permanent resident or citizen.",
    "The Police clearance certificate of the student and all family members.",
    "The residential and commercial property ownership certificates.",
    "The residential and commercial lease agreements.",
    "The vehicle ownership certificates.",
    "Bank statement letter for four past months.",
    "The article of incorporation and/or business license for self-employed applicants.",
    "The employment letter verification and two last pay stubs for employed applicants.",
    "Colorful photography of the student, 3.5 cm * 4.5 cm with white background.",
    "The military certificate for male applicants.",
    "An English Word file of the student and all family members information includes full name, date of birth, address, postal code, education, cell phone, email, job title, employer name.",
    "An English Word file of the student’s travel history includes city, departure date, leave date, purpose of visit, hotel name, base on the passport stamps for the past 5 years.",
    "Previous visa refusal letters of Canada or the Unites States of America."
];
