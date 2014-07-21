$(document).ready(function () {

    $('#date').pickadate({
        formatSubmit: 'yyyy/mm/dd',
        hiddenPrefix: 'formatted_'
    });

    $('#time').pickatime({
        formatSubmit: 'HH:i',
        hiddenPrefix: 'formatted_',
        interval: 5
    });

    var titleLeft = 30;

    $('#remainingTitleChars').text('Characters left: ' + titleLeft);

    $('#ReminderTitle').keyup(function () {

        titleLeft = 30 - $(this).val().length;

        if (titleLeft < 0) {
            $('#remainingTitleChars').addClass("overlimit");
        }
        if (titleLeft >= 0) {
            $('#remainingTitleChars').removeClass("overlimit");
        }

        $('#remainingTitleChars').text('Characters left: ' + titleLeft);
    });


    var bodyLeft = 300;

    $('#remainingBodyChars').text('Characters left: ' + bodyLeft);

    $('#ReminderBody').keyup(function () {

        bodyLeft = 300 - $(this).val().length;

        if (bodyLeft < 0) {

            $('#remainingBodyChars').addClass("overlimit");
        }
        if (bodyLeft >= 0) {

            $('#remainingBodyChars').removeClass("overlimit");
        }

        $('#remainingBodyChars').text('Characters left: ' + bodyLeft);

    });

});