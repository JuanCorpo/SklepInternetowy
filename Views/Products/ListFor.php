<?php

function ListFor($model)
{
    ?>
    <div class='col-md-3'>
        <div class='panel panel-default'>
            <div class='panel-heading'>Filtry</div>
            <div class='panel-body'>
                Panel content
            </div>
            <div class='panel-body'>
                Panel content
            </div>
            <div class='panel-body'>
                Panel content
            </div>
            <div class='panel-body'>

                <input id='ex13' type='text' data-slider-ticks='[0,  200,  400]'
                       data-slider-ticks-snap-bounds='30'
                       data-slider-ticks-labels='[' $0', '$200', '$400']'/>

            </div>
            <script>$('#ex13').slider({
                    ticks: [0, 200, 400],
                    ticks_labels: ['$0', '$200', '$400'],
                    ticks_snap_bounds: 30
                });</script>

        </div>
    </div>

    <div class='col-md-9'>
        <div class='panel panel-default'>
            <div class='panel-heading'>Podkategorie</div>
            <div class='panel-body'>
                <?php echo $model->OtherCategories; ?>
            </div>
        </div>
    </div>

    <div class='col-md-9'>

        <?php
        foreach ($model->ItemList as $item) {
            ?>
            <div class="panel panel-primary col-md-4">
                <div class="panel-heading">
                    <h3 class="panel-title">Item id: <?php echo $item->Id; ?></h3>
                </div>
                <div class="panel-body">
                    Nazwa: <?php echo $item->Name; ?>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
    <?php
}