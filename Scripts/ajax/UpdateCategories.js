var inserted = -1;
var selectedCategoryId = -1;

$(function () {
    var array;

    $("#AddNewCategory").click(function () {
        if ($("#NewCategoryName").val().length > 0) {
            var name = $("#NewCategoryName").val();

            var newEle = "<div id=\"" + inserted + "\" categoryname=\"" + name + "\" parentid=\"0\" categoryid=\"" + inserted + "\"  class=\"CategoryDraggable CategoryDroppable CatEle NewEle Cat_ Categories\">";
            newEle += "<div id=\"" + inserted + "Name\" style=\"margin: 5px;\">";
            newEle += name
            newEle += "</div></div>";

            $("#root").append(newEle);

            $(".CategoryDraggable").draggable({cursor: "pointer", revert: "invalid"});
            $(".CategoryDroppable").droppable({
                accept: ".CategoryDraggable",
                tolerance: "pointer",
                drop: function (event, ui) {
                    var dropped = ui.draggable;
                    var droppedOn = $(this);

                    if ($(droppedOn).hasClass("root")) {
                        $(dropped).css('background', '#75caeb');
                    } else {
                        $(dropped).css('background', 'rgba(237, 239, 241, 0.5)');
                    }
                    $(this).css('border', '0px');

                    var parentId = $(droppedOn).attr("categoryid");
                    $(dropped).attr("parentid", parentId);
                    $(dropped).detach().css({top: 0, left: 0}).appendTo(droppedOn);
                },
                over: function (event, elem) {
                    $(this).css('border', 'solid 2px black');
                }
                ,
                out: function (event, elem) {
                    $(this).css('border', '0px');
                }
            });
            $("#EditCategory").click(function () {
                var text = $("#EditCategoryName").val();
                $("#" + selectedCategoryId + "Name").html(text);
                $("#" + selectedCategoryId).attr("categoryname", text);
            });

            $("#DelNewCategory").click(function () {
                alert("TODO: Co z tym ?");
            });
            inserted--;

        } else {
            alert("Brak nazwy");
        }
    });

    $("#EditCategory").click(function () {
        var text = $("#EditCategoryName").val();
        $("#" + selectedCategoryId + "Name").html(text);
        $("#" + selectedCategoryId).attr("categoryname", text);
    });

    $("#DelNewCategory").click(function () {
        alert("TODO: Co z tym ?");
    });

    $("#root").on("click",".CategoryDraggable",function(event){
        event.stopPropagation();
        selectedCategoryId = $(this).attr("categoryid");

        $("#EditCategoryName").val($(this).attr("categoryname"));
        $("#EditCategoryName").prop('disabled', false);
        $("#EditCategory").prop('disabled', false);
        $("#DelNewCategory").prop('disabled', false);
    });

    $('html').click(function(e){
        if (!$(e.target).hasClass('CategoryDraggable') && !$(e.target).hasClass('EditElement')) {
            selectedCategoryId = -1;

            $("#EditCategoryName").val("");
            $("#EditCategoryName").prop('disabled', true);
            $("#EditCategory").prop('disabled', true);
            $("#DelNewCategory").prop('disabled', true);
        }

        if (selectedCategoryId >= 0)
            event.stopPropagation();
    });

    $("#SaveCategories").click(function () {
        $("#WaitLoader").show();
        $("#SaveCategories").prop('disabled', true);

            array = [];
            GetNewCategories("root");

            var jsonString = JSON.stringify(array);

            $.ajax({
                url: '/Scripts/ajax/UpdateCategories.php',
                data: {data: jsonString},
                type: 'POST',

                error: function () {
                    console.log("ERROR");
                },
                success: function (data) {
                    //$("#MainContainer").html(data);
                    console.log(data);
                }
            });
            $("#WaitLoader").hide();
            $("#SaveCategories").prop('disabled', false);

    });

    $(".CategoryDraggable").draggable({cursor: "pointer", revert: "invalid"});

    $(".CategoryDroppable").droppable({
        accept: ".CategoryDraggable",
        tolerance: "pointer",
        drop: function (event, ui) {
            var dropped = ui.draggable;
            var droppedOn = $(this);

            if ($(droppedOn).hasClass("root")) {
                $(dropped).css('background', '#75caeb');
            } else {
                $(dropped).css('background', 'rgba(237, 239, 241, 0.5)');
            }
            $(this).css('border', '0px');

            var parentId = $(droppedOn).attr("categoryid");
            $(dropped).attr("parentid", parentId);
            $(dropped).detach().css({top: 0, left: 0}).appendTo(droppedOn);
        },
        over: function (event, elem) {
            $(this).css('border', 'solid 2px black');
        }
        ,
        out: function (event, elem) {
            $(this).css('border', '0px');
        }
    });

    function GetNewCategories(parentId) {

        var htmlCol = document.getElementById(parentId).children;
        for (var i = 0; i < htmlCol.length; i++) {

            var validaton = htmlCol[i].attributes['categoryname'];

            if (typeof(validaton) !== "undefined") {

                var Name = htmlCol[i].attributes['categoryname'].value;
                var ParentId = htmlCol[i].attributes['parentid'].value;
                var CategoryId = htmlCol[i].attributes['categoryid'].value;

                array.push([]);
                array[array.length - 1].push(CategoryId); // CategoryId
                array[array.length - 1].push(Name); // Name
                array[array.length - 1].push(ParentId); // ParentId


                GetNewCategories(CategoryId);
            }
        }
    }
});