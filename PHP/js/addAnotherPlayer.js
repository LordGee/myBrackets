$(document).ready(function(){
    $("#addPlayer").click(function(){
        var count = $('.count').length;
        count = count + 1;
        if (count <= 32) {
            $('<div class="remove"><div class="col-lg-4 col-md-6 col-sm-12">' +
                '<label for="e_pname">Player ' + count + ' - Name & Email : </label>' +
                '<div class="inputWrap count">' +
                '<span class="inputIcon inputParticipant">' +
                '<i class="fa fa-user fa-fw fa-lg" aria-hidden="true"></i>  ' + count + ' </span>' +
                '<input type="text" name="e_pname[]" placeholder="Enter the participants name" required>' +
                '</div>' +
                '<div class="inputWrap">' +
                '<span class="inputIcon inputParticipant">' +
                '<i class="fa fa-envelope-o fa-fw fa-lg" aria-hidden="true"></i>  ' + count + ' </span>' +
                '<input type="email" name="e_email[]" placeholder="Enter the participants email">' +
                '</div><br></div></div>').insertBefore("#next");
            $("html, body").animate({ scrollTop: $(document).height() }, "slow");
        }
    });

    $("#removePlayer").click(function(){
        $('.remove:last').remove();
        // $("html, body").animate({ scrollTop: $(document).height() }, "slow");
    });
});