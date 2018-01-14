<?php

function EmailQueue($model)
{

    echo "
    <div style='display:inline;'>
        <h2 style='display:inline;'>Kolejka email</h2>
    </div>
    <hr>";


    echo "<table class=\"table table-hover table-striped\">";
    echo "<tr><td>#</td>  <td>Odbiorca</td>   <td>Wiadomość</td>   <td>Wysłana</td>  <td>Data dodania</td> <td>Data wysłania</td>    <td></td></tr>";

    $i = 0;
    foreach ($model as $item)
    {
        echo "<tr>
            <td>$i</td>  
            <td>".$item->EmailAddress."</td>   
            <td style='font-size: 9pt;'><b>".$item->Subject."</b><br>".$item->Body."</td>   
            <td>".$item->IsSend."</td>  
            <td>".$item->AppendDate."</td> 
            <td>".$item->SendDate."</td>    
            <td><a class='glyphicon glyphicon-send' style='color: black;text-decoration: none;'></a></td>
        </tr>";
        $i++;
    }

    echo "</table>";

}