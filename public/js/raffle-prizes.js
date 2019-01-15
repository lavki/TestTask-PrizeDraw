$(document).ready(function () {

    var url = window.location.href;

    // click button id="rafflePrizes"
    $('button[id="rafflePrizes"]').click(function () {
        var action = url + 'raffle-prizes';

        $.ajax({
            url:      action,
            type:     'POST',
            dataType: 'JSON',
            success: function (data) {
                var data = $.parseJSON(data);
                var winningPrize = data.winningPrize;

                for( var key in winningPrize )
                {
                    $('#PrizeTitle').text(key);
                    $('#PrizeValue').text(winningPrize[key]);
                }
            }
        });
    });
});