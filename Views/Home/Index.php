<?php
function HomeIndexView($model, $ProductsTableModel, $BestProductModel)
{
    ?>
    <div class="col-md-12">


    <div class="col-md-9">
        <h2 style="padding-left: 10px">Polecane produkty</h2>
        <?php foreach ($ProductsTableModel as $item ) { ?>
        <div class="col-md-3" style="height: 200px; margin-bottom: 10px">
            <div class="panel panel-default">
                <a href="/Products/show/<?php echo $item->ProductId; ?>"> <div class="panel-heading" style="height: 50px"><?php echo $item->Name; ?></div></a>
                <a href="/Products/show/<?php echo $item->ProductId; ?>"><div class="panel-body">  <img style="height: 100px; max-width: 150px" src="<?php echo $item->ImageDirectory; ?>"/></a>
                <br>
                    <?php echo $item->Price."zł"; ?>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>

        <h2 style="padding-left: 10px">Produkt roku</h2>
        <div class="col-md-3">
            <div class="panel panel-default">
                <a href="/Products/show/<?php echo $BestProductModel->ProductId; ?>"> <div class="panel-heading" style="font-size: 40px"><?php echo $BestProductModel->Name; ?></div></a>
                <a href="/Products/show/<?php echo $BestProductModel->ProductId; ?>"><div class="panel-body">  <img style="height: 150px; width: 200px" src="<?php echo $BestProductModel->ImageDirectory; ?>"/></a>
                <br>
                <div style="font-size: 40px"><?php echo $BestProductModel->Price."zł"; ?></div>
            </div>
        </div>

    </div>
    </div>
<?php
}