$(document).ready(function(){
    $('input[name="email"]').change(function(){
        $('#phoneGroup').slideDown();
    });
});