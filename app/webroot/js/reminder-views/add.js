$(document).ready(function() {

	$("#datetime").datetimepicker({
		timeFormat: 'hh:mm tt z'
	});


	var titleLeft = 30;

    $('#remainingTitleChars').text('Characters left: ' + titleLeft);

    $('#ReminderTitle').keyup(function () {

        titleLeft = 30 - $(this).val().length;

        if(titleLeft < 0){
            $('#remainingTitleChars').addClass("overlimit");
        }
        if(titleLeft >= 0){
            $('#remainingTitleChars').removeClass("overlimit");
        }

        $('#remainingTitleChars').text('Characters left: ' + titleLeft);
    });


    var bodyLeft = 100;

    $('#remainingBodyChars').text('Characters left: ' + bodyLeft);

    $('#ReminderBody').keyup(function () {

    	bodyLeft = 100 - $(this).val().length;

    	if(bodyLeft < 0){

            $('#remainingBodyChars').addClass("overlimit");
        }
        if(bodyLeft >= 0){

            $('#remainingBodyChars').removeClass("overlimit");
        }

        $('#remainingBodyChars').text('Characters left: ' + bodyLeft);

    });



});