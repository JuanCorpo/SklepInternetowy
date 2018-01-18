<?php
function EmailTemplates($model)
{

    echo "
    <div style='display:inline;'>
        <h2 style='display:inline;'>Szablony email</h2>
    </div>
    <hr>";


    echo "<table class=\"table table-hover table-striped\">";
    echo "<tr><td>#</td>    <td>Tytuł</td>   <td>Treść</td>     <td></td></tr>";

    $i = 0;
    foreach ($model as $item)
    {
        echo "<tr>
            <td>$i</td>    
            <td>".$item->Subject."</td>   
            <td>".$item->Body."</td>  
            <td><a href='../../Administration/EditEmailTemplate/".$item->Id."' class='glyphicon glyphicon glyphicon-edit' style='color: black;text-decoration: none;'></a></td>
        </tr>";
        $i++;
    }

    echo "</table>";

}