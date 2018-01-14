<?php

function SiteInfoView($text, $type)
{
    if (RoleHelper::IsInRole(1)) {
        echo "<form method='post' action='/Site/SaveSiteInfo'>";
        echo "<div class='row'>
            <div class='col-md-12'>            
            <div class='navbar-left'>
                <a class=\"btn btn-warning MainSiteInfo\" onclick=\"EditSiteInfo('" . $type . "')\"><span class=\"glyphicon glyphicon-pencil\"></span> Edytuj
                </a>                
                
                <button class=\"btn btn-primary MainSiteInfoEdit\" style='display:none;' type=\"submit\"><span class=\"glyphicon glyphicon-pencil\"></span> Zapisz
                </button>
                
                <a class=\"btn btn-default MainSiteInfoEdit\" style='display:none;' onclick=\"CancelEditSiteInfo('" . $type . "')\"><span></span> Anuluj
                </a>
            </div>
        </div>
        </div>";

        echo "<br>";
        echo "<div style='display:none;' class='MainSiteInfoEdit'>";
        echo '<input type="hidden" value="'.$type.'" name="type"/>';
        echo '<textarea class="ckeditor" id="content" name="content">'.$text.' </textarea>';
        echo "</div>";
        echo "<script>/*$( 'textarea.ckeditor' ).val( '$text' );*/</script>";
        echo "</form>";
    }
    echo "<div id='Content' class='MainSiteInfo'>";
    echo $text;
    echo "</div>";


    ?>
    <script>
        function EditSiteInfo(category) {
            $(".MainSiteInfoEdit").show();
            $(".MainSiteInfo").hide();
        }

        function CancelEditSiteInfo(category) {
            $(".MainSiteInfoEdit").hide();
            $(".MainSiteInfo").show();
        }
    </script>
    <?php
}