/**
 * Created by Pisti on 2016. 05. 05..
 */

    function setAlertBlock (pin_Type, pin_Message) {
        return '<div class="alert alert-' + pin_Type + '">' + pin_Message + '</div>';
    }


    function ajaxSubmit(pin_URL, pin_FormName, pin_ResponsElement)
    {
        $.ajax({
            type:   "POST",
            async:  false,
            url:    pin_URL,
            data:   $(pin_FormName).serialize(),
            beforeSend: function(jqXHR, settings) {
            },
            complete: function(jqXHR, textStatus) {
            },
            success: function(data){
                if(pin_ResponsElement) {
                    $(pin_ResponsElement).html(data);
                }
                else {
                    console.log('The respons element does not exists.');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //$(responsDiv).html('<div>'+xhr.responseText+'</div>');
                console.log(xhr.responseText);
                console.log(xhr.status);
            }
        });
    }

    $(document).ready(function() {
        $.ajax({
            url: "index.php?url=loadLanguageELements",
            success: function (data) {
                var languageObj = jQuery.parseJSON(data);
                alert(languageObj.__ROOT_URL__);
            }
        });
    });