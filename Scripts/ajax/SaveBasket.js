function SaveBasket()
{
    $.ajax({
        url: 'SaveBasket.php',
        // data: {
        //     Action: action,
        //     ID: productId
        // },
        type: 'POST',

        error: function () {
            //console.log("NIE");
        },
        success: function (data) {
            //console.log("TAK");
        }
    });
}
