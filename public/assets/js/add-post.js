$(document).ready(function () {
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    $("#add-edit-post-form").validate({
        rules: {
            title: {
                required: true
            },
            content: {
                required: true
            }
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});