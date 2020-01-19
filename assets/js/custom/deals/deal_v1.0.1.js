$(document).ready(function(){
    $('.printCoupon').click(function(e){
        e.preventDefault();
        deals.printCoupon();
    });
    
    // Loading quotation modal when errors
    if($('#quotation_sended').val() != undefined) {
        $('#doQuotation').modal('show');
    }
});
deals = {
    printCoupon: function() {
        $.ajax({
            url: $('#base_url').val() + "ajax/userIsLogged",
            dataType: 'json'
        }).complete(function (res) {
            if (res.responseJSON != undefined) {
                if(res.responseJSON == true) {
                    // Popup confirm
                    $('#printCouponConfirm').modal('show');
                } else {
                    // Inscription
                    window.location.href = $('#base_url').val()+'users/signup?notif=print_blocked';
                }
            } else {
                // TODO error
            }
        }).error(function () {
            // TODO error
        });
    }
}