<?php

function ProductsShow($model)
{
    ?>

    <div class="col-md-12">


    <div class="col-md-12">
    <a style='display:inline;'> <h1 style='display:inline;'> <?php echo $model->Name; ?> </h1> </a>
        <?php echo '<div style="display: inline;" id="stars_' . $model->ProductId . '" stars="' . $model->GetRating() . '" class="starrr"></div>
        <div style="display:inline">(' . $model->NoOfRatings . ')</div>' ;?>
        <button class="btn btn-warning navbar-right" onclick="addToBasket(<?php echo $model->ProductId; ?>)"><span class="glyphicon glyphicon-plus"></span> Dodaj do koszyka </button>
        <?php if (RoleHelper::IsInRole(1)) { ?>
    <?php echo '<a href="/Administration/EditProduct/'.$model->ProductId.'" <button class="btn btn-warning navbar-right" style="margin-right:10px"><span class="glyphicon glyphicon-pencil"></span> Edytuj produkt </button></a>';
         } ?>
        <hr>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
        <?php  echo $model->Description; ?>
        </div>
        <div class="col-md-6">
        <img style="max-height: 300px; max-width: 500px" src="<?php echo $model->ImageDirectory; ?>"/>
        </div>
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

        <script src="/Scripts/Custom/Stars.js"></script>
        <script src="/Scripts/ajax/Basket.js"></script>
    </div>

    <?php
}


