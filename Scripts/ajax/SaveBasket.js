function SaveBasket()
{
    $.ajax({
        url: '/Scripts/ajax/SaveBasket.php',
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
