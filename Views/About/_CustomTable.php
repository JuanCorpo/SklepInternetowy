<?php

function _CustomTable($model)
{
?>
    <table class="table table-striped table-hover " >
    <thead >
    <tr >
        <th >#</th>
        <th > Name </th >
        <th > Bool </th >
        <th > Value </th >
        <th class="text-right">  </th >
    </tr >
    </thead >
    <tbody >

    <?php for($i = 0;$i<count($model);$i++){ ?>
    <tr >
        <td > <?php echo $i; ?></td >
        <td > <?php echo $model[$i]->NameTable; ?> </td >
        <td > <?php echo $model[$i]->BoolTable; ?> </td >
        <td > <?php echo $model[$i]->ValueTable; ?> </td >
        <td class="text-right" >
            <a href="/About/Edit/<?php echo $model[$i]->IdTable; ?>">Edit</a>
            <a href="/About/Delete/<?php echo $model[$i]->IdTable; ?>">Delete</a>
        </td >
    </tr >
    <?php } ?>

    </tbody >
</table >

<?php
    }