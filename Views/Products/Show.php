<?php

function ProductsShow($model)
{
    ?>

    <div class="col-md-12">


    <div class="col-md-12">
    <a style='display:inline;'> <h1 style='display:inline;'> <?php echo $model->Name; ?> </h1> </a>
        <?php if (RoleHelper::IsInRole(1)) { ?>
    <?php echo '<a href="/Administration/EditProduct/'.$model->ProductId.'" <button class="btn btn-warning navbar-right"><span class="glyphicon glyphicon-pencil"></span> Edytuj produkt </button></a>';
         } ?>
        <hr>
    </div>

    <div class="col-md-12">
        <?php  echo $model->Description; ?>
    </div>

    <div class="col-md-12">
        <br>
        <h1 style='display:inline;'> Tabela parametrów </h1>
        <hr>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Typ parametru</th>
            <th>Wartość parametru</th>
            <th>Jednostka</th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach ($model->Parameters as $item) { ?>
    <tr>
        <td> <?php echo $item->ParameterType->ParameterName; ?> </td>
        <td> <?php echo $item->ParameterValue; ?> </td>
        <td> <?php echo $item->ParameterType->Suffix; ?> </td>

    </tr>
        <?php  } ?>
</tbody>
</table>
</div>


    </div>

    <?php
}


