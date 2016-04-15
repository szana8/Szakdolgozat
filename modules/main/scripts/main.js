/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    setGadgetDefault();
    setSortableGrid();
});

function setGadgetDefault() {
    $('.app-gadget').css('cursor', 'move');

    $('.gadget-minimize').click(function() {
        $(this).parents(':eq(5)').next('.panel-body').hide('slideUp');
    });

    $('.gadget-maximize').click(function() {
        $(this).parents(':eq(5)').next('.panel-body').show('slideDown');
    });
}

function setSortableGrid() {
    var fromClass = '';
    var toClass = '';
    var fromID = '';
    var toID = '';

    $(".grid").sortable({
        connectWith: ".grid",
        handle: ".panel-heading",
        tolerance: 'pointer',
        placeholder: 'col-md-6 well placeholder title',
        forceHelperSize: true
    });
}
