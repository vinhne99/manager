
set_disable_form_element = function (form_element) {
    $(form_element).find ('input, textarea, select, button').each(function(){
        $(this).attr ('disabled', 'disabled');
    });
}
set_null_form_element = function (form_element) {
    $(form_element).find ('input, textarea').each(function(){
        $(this).val('');
    });
}
set_enable_form_element = function (form_element) {
    $(form_element).find ('input, textarea, select, button').each(function(){
        $(this).removeAttr('disabled');
    });
}
response_status = function(json_response) {
    if (json_response.status == 1) {
        return true;
    }
    else return false;
}

set_message = function(status, jElement, message) {
    switch (status) {
        case 'Success':
            var success_html = ' <div class="alert alert-success alert-dismissible fade in" role="alert">';
            success_html += '<button type="button"  class="close-error" data-dismiss="alert" aria-label="Close"></button>';
            success_html += '<strong>Thông báo! </strong>' + message;
            success_html += '</div>';
            jElement.find ('span.response-message').html (success_html);
            break;
        case 'Error':
            var error_html = '<div class="alert alert-danger alert-dismissible fade in" role="alert">';
            error_html += '<button class="close-error" type="button" ass="close" data-dismiss="alert" aria-label="Close">';               error_html += '</button>';
            error_html += '<strong>Lỗi! </strong>'+ message +'</div>';
            jElement.find ('span.response-message').html (error_html);
            break;

    }
}
set_message_empty = function(jElement) {
    jElement.find('span.response-message').html ('<span class="loading2"></span>');
}

$(function(){
    $("#update_password").click(function(){
        var element = $('#change-password');
        set_disable_form_element(element);
        set_message_empty(element);
        $.ajax({
            type: "POST",
            url:bath + "admin/setting/update_password",
            data: {
                'password_old': $(element).find("input[name='password_old']").val(),
                'password_new': $(element).find("input[name='password_new']").val(),
                'password_new_re': $(element).find("input[name='password_new_re']").val()
            },
            error: function(data){
                //alert('error test');
            },
            dataType: 'json',
            success: function(data){
                set_enable_form_element(element);
                if (data['status'] == 0){
                    set_message('Error', element , data['error']);
                }
                if (data['status'] == 1) {
                    set_null_form_element(element);
                    set_message('Success', element , '');
                    element.modal('hide');
                    new PNotify({
                        title: 'Thông báo thành công',
                        text: data['success'],
                        type: 'success'
                    });
                }
            }
        });
    });
});

