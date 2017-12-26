<?php
function AdministrationCategories($model)
{
    echo "<div style='display:inline;'>
<h2 style='display:inline;'>Edycja kategorii</h2>

    <div class='navbar-right'>
        <input style='float: left;width:180px;margin: 0 5px;' class='form-control' placeholder='Nazwa nowej kategorii' name='NewCategoryName' id='NewCategoryName'/>
        <button class=\"btn btn-warning\" type=\"submit\" id='AddNewCategory'><span class=\"glyphicon glyphicon-plus\"></span> Dodaj nową</button>
        <button class=\"btn btn-warning \" type=\"submit\" id='SaveCategories'>Zapisz</button>
    </div>

    <div class='navbar-right' style='float: left;margin: 0 20px 0 0;'>
        <input style='float: left;width:180px;margin:0 5px;' class='form-control EditElement' disabled placeholder='Wybierz aby edytować' name='EditCategoryName' id='EditCategoryName'/>
        <button class=\"btn btn-warning EditElement\" type=\"submit\" disabled id='EditCategory'><span class=\"glyphicon glyphicon-pencil\"></span> Edytuj</button>
        <button class=\"btn btn-danger EditElement\" type=\"submit\" disabled id='DelNewCategory'><span class=\"glyphicon glyphicon-remove\"></span> Usuń</button>
    </div>
         
</div>
<hr>";

    echo "<div categoryid='0' id='root' class=\"CategoryDroppable col-md-12 root Cat_0\" style='min-width:100px;min-height:100px;'>";

    echo InitCategories($model, 0, 0, 0);

    echo "</div>";
    ?>
    <script>
        var inserted = -1;
        var selectedCategoryId = -1;

        $(function () {
            var array;

            $('html').click(function(e) {//
                if(!$(e.target).hasClass('CategoryDraggable') && !$(e.target).hasClass('EditElement'))
                {
                    event.stopPropagation();
                    selectedCategoryId = -1;

                    $("#EditCategoryName").val("");
                    $("#EditCategoryName").prop('disabled', true);
                    $("#EditCategory").prop('disabled', true);
                    $("#DelNewCategory").prop('disabled', true);
                }
            });

            $(".CategoryDraggable").click(function (even) {
                event.stopPropagation();
                selectedCategoryId = $(this).attr("categoryid");

                $("#EditCategoryName").val($(this).attr("categoryname"));
                $("#EditCategoryName").prop('disabled', false);
                $("#EditCategory").prop('disabled', false);
                $("#DelNewCategory").prop('disabled', false);
            });

            $("#EditCategory").click(function () {
                var text = $("#EditCategoryName").val();
                $("#" + selectedCategoryId + "Name").html(text);
                $("#" + selectedCategoryId).attr("categoryname",text);
            });

            $("#DelNewCategory").click(function () {
                alert("TODO: Co z tym ?");
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

            $("#SaveCategories").click(function () {
                $("#Loader").show();
                $("#SaveCategories").prop('disabled', true);

                setTimeout(function(){
                    array = [];
                    GetNewCategories("root");

                    var jsonString = JSON.stringify(array);

                    $.ajax({
                        url: '/Scripts/ajax/updateCategories.php',
                        data: {data: jsonString},
                        type: 'POST',

                        error: function () {
                            console.log("ERROR");
                        },
                        success: function (data) {
                            //$("#MainContainer").html(data);
                        }
                    });
                    $("#Loader").hide();
                    $("#SaveCategories").prop('disabled', false);
                },1500);
            });

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
                    inserted--;

                } else {
                    alert("Brak nazwy");
                }
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
        });

    </script>
    <?php
}

$GLOBALS['res'] = "";

function InitCategories($array, $mainCategoryId, $level)
{
    $bg = "";
    foreach ($array as $row) {
        if (($level == 0 && $row['CategoryId'] == $mainCategoryId) || $row['ParentId'] == $mainCategoryId) {

            if ($row['ParentId'] == 0)
                $bg = "#75caeb";
            else
                $bg = "rgba(237, 239, 241, 0.5)";

            $GLOBALS['res'] .= '<div id="' . $row["CategoryId"] . '" categoryname="' . $row["CategoryName"] . '" parentid="' . $row["ParentId"] . '" categoryid="' . $row["CategoryId"] . '"  class="CategoryDraggable CategoryDroppable Categories CatEle Cat_' . $row["CategoryId"] . '" 
            style="background-color: ' . $bg . ';">';

            $GLOBALS['res'] .= '<div id="' . $row['CategoryId'] . 'Name" style="margin: 5px;">';
            $GLOBALS['res'] .= $row["CategoryName"];

            $GLOBALS['res'] .= "</div>";

            if ($row['ParentId'] == $mainCategoryId) {
                InitCategories($array, $row['CategoryId'], $level + 1);
            }
            $GLOBALS['res'] .= '</div>';
        }
    }
    return $GLOBALS['res'];
}