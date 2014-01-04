$(document).ready(function() {
    $('.village img').mouseover(function(){
        $('.village-name').html($(this).data('ref'));
    });
    $('.village img').mouseout(function(){
        $('.village-name').html('---');
    });
});