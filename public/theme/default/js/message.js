var error = $('#session #error').text();
var message = $('#session #message').html();
if(error >= 1){
    $('#notice').css('display', 'block');
    $('#notice p').html(message);
    setTimeout(function(){
        $('#notice').css('display', 'none');
    },2000);
}