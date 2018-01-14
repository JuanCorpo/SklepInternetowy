function addToBasket(productId) {
    callBasketScript(productId, 1);
}

function removeFromBasket(productId){
    callBasketScript(productId, -1);
}

function callBasketScript(productId, action){
    $.ajax({
        url: '/Scripts/ajax/addToBasket.php',
        data: {
            Action: action,
            ID: productId
        },
        type: 'POST',

        error: function () {
            //console.log("NIE");
        },
        success: function (data) {
            //console.log("TAK");
            //console.log(data);
            if(action === -1) {
                $("#BasketProductList").innerHTML = data;
                document.getElementById("BasketProductList").innerHTML = data;
            }
        }
    });
}