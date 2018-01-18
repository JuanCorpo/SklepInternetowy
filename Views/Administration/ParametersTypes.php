<?php
function ParametersTypes($model)
{
    echo '
        <div style=\'display:inline;\'>
            <h2 style=\'display:inline;\'>Typy parametrów</h2>
        </div>
        <hr>
        
        
        <form action="../../Administration/ParametersTypes/" method="post">
            <div class="col-md-4">                
                <input name="Name" placeholder="Nazwa parametru" class="form-control" type="text"/>
            </div>
            <div class="col-md-2">                
                <!-- <input name="prefix" placeholder="Prefix" class="form-control" type="text"/> -->
            </div>
            <div class="col-md-2">                
                <input name="Suffix" placeholder="Suffix" class="form-control" type="text"/>
            </div>
            <div class="col-md-2">                
                <select name="ValueType" class="form-control">
                <option>Tekst</option> 
                <option>Liczba</option>
                <option>Tak/Nie</option>
                </select>
            </div>
            <div class="col-md-2">
                <input class="btn btn-warning" type="submit" value="Dodaj"/>
            </div>
        </form>
';
    echo '
    <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Nazwa parametru</th>
      <th>Suffix</th>
      <th>Typ parametru</th>
    </tr>
  </thead>
  
  <tbody>';
    $i = 0;
    foreach ($model as $item) {
        $i++;
        echo "<tr>
      <td>$i</td>
      <td>$item->ParameterName</td>
      <td>$item->Suffix</td>
      <td>$item->ValueType</td>    </tr>";
    }

    echo '</tbody>
</table> 
    ';
}