<?php
function AdministrationCategories($model)
{
    echo "<div style='display:inline;'>
<h2 style='display:inline;'>Edycja kategorii</h2>
    <div class='navbar-right'>
        <a class=\"btn btn-warning\" type=\"submit\" id='AddNewCategory'><span class=\"glyphicon glyphicon-plus\"></span> Dodaj nową</a>
        <a class=\"btn btn-warning \" type=\"submit\" id='SaveCategories'>Zapisz</a>
    </div>
</div>
<hr>";

    echo "<div class=\"CategoryDroppable col-md-12 root\" style='min-width:100px;min-height:100px;'>";

    echo InitCategories($model, 0, 0, 0);

    echo "</div>";
    ?>
    <script>
        $(function () {
            $("#SaveCategories").click(function(){
                alert("TODO ZAPIS!");
            });
            $("#AddNewCategory").click(function(){
                alert("TODO DODAWANIE!");
            });


            $(".CategoryDraggable").draggable({cursor: "pointer", revert: "invalid"});

            $(".CategoryDroppable").droppable({
                accept: ".CategoryDraggable",
                tolerance:"pointer",
                drop: function (event, ui) {
                    var dropped = ui.draggable;
                    var droppedOn = $(this);

                    if($(droppedOn).hasClass("root")){
                        $(dropped).css('background','#75caeb');
                    }else{
                        $(dropped).css('background','rgba(237, 239, 241, 0.5)');
                    }
                    $(this).css('border','0px');

                    $(dropped).detach().css({top: 0, left: 0}).appendTo(droppedOn);
                },
                over: function(event, elem) {
                    $(this).css('border','solid 2px black');
                }
                ,
                out: function(event, elem) {
                    $(this).css('border','0px');
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

            if($row['ParentId'] == 0)
                $bg = "#75caeb";
            else
                $bg="rgba(237, 239, 241, 0.5)";

            $GLOBALS['res'] .= '<div class="CategoryDraggable CategoryDroppable CatEle Cat_' . $row["CategoryId"] . '" 
            style="color: #333333;float:left;cursor:pointer ;background-color: '.$bg.'; margin: 5px;font-size:10pt; min-width:100px;max-width:200px;border: 1px black solid;box-shadow: 1px 1px 5px black;border-radius: 5px;">';

            $GLOBALS['res'] .= '<div categoryid="'.$row["CategoryId"].'" style="margin: 5px;">';
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