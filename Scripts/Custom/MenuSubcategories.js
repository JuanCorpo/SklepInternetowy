var onButton = false;
var onModal = false;

$(document).ready(function () {

    $(".MainMenuButton").mouseenter(function (e) {
        onButton = true;
        var mainCategoryId = document.getElementById(e.target.id).getAttribute("category");
        LoadSubcategories(mainCategoryId);

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

    function HideModal() {
        setTimeout(function () {
            if (!onButton && !onModal) {
                $("#MainContainerModal").hide();
            }
        }, 170);
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