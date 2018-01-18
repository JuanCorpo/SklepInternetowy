<?php

function EditEmailTemplateView($model)
{

echo "
<form method='post' action='../../Administration/EditEmailTemplate/$model->Id'>
    <div style='display:inline;'>
            <h2 style='display:inline;'>Edycja szablonu</h2>
            <div class='navbar-right'>
                <button class=\"btn btn-warning\" type=\"submit\"><span class=\"glyphicon glyphicon-plus\"></span>Zapisz</button>
            </div>
    </div>
    <hr>
        
    <div class='row'>
        <div class=\"form-group\">
            <input type='hidden' name='id' value='$model->Id'/>
            <input placeholder='Tytuł' class=\"form-control\" type='text' name='subject' value='$model->Subject'/>
        </div>
    </div>
    
    <div class='row'>
        <div class=\"form-group\">
            <textarea class=\"ckeditor\" name=\"body\">$model->Body</textarea>
        </div>
    </div>
    </form>";



}