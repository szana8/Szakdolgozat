/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    setGadgetDefault();
    setSortableGrid();
    setGadgetColor();
});

function setGadgetDefault() {
    $('.app-gadget').css('cursor', 'move');
    $('.app-gadget').hover(function(event) {
        $(this).find(".gadget-options").show();
    });

    $('.app-gadget').mouseleave(function(event) {
        $(this).find(".gadget-options").hide();
        $("button.dropdown-toggle").dropdown("toggle");
    });

    $('.gadget-minimize').click(function() {
        $(this).parents(':eq(5)').next('.panel-body').hide('slideUp');
    });

    $('.gadget-maximize').click(function() {
        $(this).parents(':eq(5)').next('.panel-body').show('slideDown');
    });
}

function setSortableGrid() {
    $(".grid").sortable({
        //connectWith: ".grid",
        handle: ".panel-heading",
        tolerance: 'pointer',
        items: '.panel',
        connectWith: ".grid",
        revert: true,
        opacity: 0.5,
        dropOnEmpty: true,
        placeholder: 'panel-header placeholder panel-body',
        forceHelperSize: true,
        start: function(e, ui){
            ui.placeholder.height(ui.item.height());
            ui.placeholder.html('<div style="font-size:16pt;text-align:center;margin-top:'+((ui.item.height())/2)+'px;color:#999999;">Drag your gadget here!</div>');
        }
    });
}

function setGadgetColor() {
    $('.colorize').click(function() {
        var color = $(this).css('background-color');
        var textColor = '#FFFFFF';

        if(color == 'rgb(245, 245, 245)') {
            textColor = '#000000';
        }

        $(this).parents(':eq(8)').css('background-color', color).css('color', textColor);
    });
}
