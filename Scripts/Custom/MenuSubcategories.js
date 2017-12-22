var onButton = false;
var onModal = false;
var menuActive = false;
var animationTimeout = 300;
var eBuff;

$(document).ready(function () {

    $(".MainMenuButton").mouseenter(function (e) {
        onButton = true;
        if (menuActive) {
            ShowModal(e);
        }else {
            eBuff = e;
                setTimeout(function () {
                    if((onButton || onModal) && e == eBuff) {
                        ShowModal(e);
                    }
                }, animationTimeout);
        }
    });
    $(".MainMenuButton").mouseleave(function () {
        onButton = false;
        HideModal();
    });


    $("#MainModalContent").mouseenter(function () {
        onModal = true;
    });
    $("#MainModalContent").mouseleave(function () {
        onModal = false;
        HideModal();
    });

    function ShowModal(e){
        menuActive = true;
        var mainCategoryId = document.getElementById(e.target.id).getAttribute("category");
        LoadSubcategories(mainCategoryId);
    }

    function HideModal() {
            setTimeout(function () {
                if (menuActive && (!onButton && !onModal)) {
                    menuActive = false;
                    $("#MainContainerModal").hide();
                }
            }, animationTimeout);
    }
});

function LoadSubcategories(rootCategoryId) {

    $.ajax({
        url: '/Scripts/ajax/menuSubcategories.php',
        data: {
            ID: rootCategoryId
        },
        type: 'POST',

        error: function () {
            console.log("ERROR");
        },
        success: function (data) {
            $("#MainModalContent").html(data);
            $("#MainContainerModal").show();
        }
    });

}