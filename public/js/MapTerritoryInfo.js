$(document).ready(function() {
    $('.village img').mouseover(function(){
        $('.village-name').html($(this).data('village'));
        $('.player-name').html($(this).data('leader'));
    });
    $('.village img').mouseout(function(){
        $('.village-name').html('---');
        $('.player-name').html('---');
    });
});