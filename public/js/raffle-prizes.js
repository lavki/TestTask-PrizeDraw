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

                $('#rafflePrizes').remove();

                var data = $.parseJSON(data);
                var winningPrize = data.winningPrize;

                for( var key in winningPrize )
                {
                    $('#PrizeTitle').text('Congratulation! You won ' + key);
                    $('#PrizeValue').text(winningPrize[key]);
                }

                var options = data.options;
                var buttons = '';
                for( var key in options )
                {
                    buttons += '<button class="btn btn-default">'+options[key]+'</button>';
                }

                $('#prizeOption').html(buttons);
                $('#winnerPrize').attr('style', 'display: block');
            }
        });
    });
});