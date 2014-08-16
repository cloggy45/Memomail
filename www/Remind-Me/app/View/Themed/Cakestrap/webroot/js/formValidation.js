$(document).ready(function () {

    // Create our own password comparison because the default uses 'name' attr.
    $.formUtils.addValidator({

        name: 'original_password',
        validatorFunction: function (value, $el, config, language, $form) {

            var otherFieldValue = $("#UserPassword").val();

            if (value == otherFieldValue) {
                return true;
            }

        },
        errorMessage: 'Passwords entered do not match',
        errorMessageKey: 'badPasswordValidation'

    });

    $.formUtils.addValidator({

        name: 'original_email',
        validatorFunction: function (value, $el, config, language, $form) {

            var otherFieldValue = $("#UserEmail").val();

            if (value == otherFieldValue) {
                return true;
            }
        },
        errorMessage: 'Emails entered do not match',
        errorMessageKey: 'badEmailValidation'

    });

    $.validate({

        modules: 'security',
        borderColorOnError: '#FFF',
        addValidClassOnAll: true
        //validateOnBlur : false,
    });


});