$(function () {

    // init the validator 
    // validator files are included in the download package
    // otherwise download from http://1000hz.github.io/bootstrap-validator
    // https://cdnjs.com/libraries/1000hz-bootstrap-validator
    // https://github.com/1000hz/bootstrap-validator

    $('#contact-form').validator();

    console.log('Script loaded!');
    // when the form is submitted
    $('#contact-form').on('submit', function (e) {

        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "contact.php";


            // POST values in the background the script URL
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data) {
                    console.log(typeof data);
                    // data = JSON object that contact.php returns

                    // we receive the type of the message: success x danger and apply it it the
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    // let's compose Bootstrap alert box HTML
                    var alertBox = '<div class="alert ' + messageAlert +
                        ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    alert(messageText);
                    // if we have messageAlert and messageText
                    if (messageAlert && messageText) {
                        console.log("true");
                        // inject the alert to .message div in our form
                        $('#contact-form').find('.message').html(alertBox);
                        // empty the form
                        $('#contact-form')[0].reset();
                    }

                }
            });
            return false;
        }
    });
});