/**
 * Created by Pisti on 2016. 05. 04..
 */


function readyPluginList() {

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

    $("#ext-class-id").change(function() {
        var ext_type_id = $("#ext-type-id").val();
        window.location.href =  "{__ROOT_URL__}startModule/PluginsList/" + this.value + "/" +ext_type_id;
    });
}



