/**
 * Created by Pisti on 2016. 05. 04..
 */

$(document).ready(function() {
    $("#addonFileID").change(function() {
        var ext = $(this).val().split('.').pop().toLowerCase();
        if(ext != 'zip') {
            loc_Block = setAlertBlock('danger', 'The uploaded file is not a zip file!');
        }
        else {
            loc_Block = setAlertBlock('success', 'Add-on uploaded success!')
        }
        $("#myModal").modal('hide');
        $("#addon-respons-div").html(loc_Block);
    });

    alert('sad');
    $("#ext-class-id").change(function() {
        var ext_type_id = $("#ext-type-id").val();
        alert(languageObj.__ROOT_URL__);
        //window.location.href(languageObj.__ROOT_URL__ + "startModule/PluginsList/" + this.value + "/" +ext_type_id);
    });


});