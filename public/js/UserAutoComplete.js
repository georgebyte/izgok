$(document).ready(function(){

    var response = "";
    
    $('#username').keypress(function() {

        $.ajax({
        url: '/api/lookup/' + $('#username').val(),
        dataType: 'html',
        async: true,
        success: function(json) {
            response = $.parseJSON(json).toString();
            }
        });

        var AvailableUsers = response.split(",")

            $( "#username" ).autocomplete({
              source: AvailableUsers
            });               
    });

});