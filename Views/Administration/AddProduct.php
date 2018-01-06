<?php

function AddProduct($model, $Employees)
{

    ?>
    <form class="form-horizontal" method='post' action='/Administration/AddProduct'>
        <div style='display:inline;'>
            <h2 style='display:inline;'>Dodaj produkt</h2>


            <div class='navbar-right'>
                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-plus"></span> Dodaj</button>
            </div>
        </div>
        <hr>
        <div class='row'>
            <div class='form-group col-md-4 col-md-offset-4'>
                <label for='ProductName'>Nazwa Produktu</label>
                <input type='text' class='form-control' id='ProductName' name='ProductName' placeholder='Wpisz nazwę produktu'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-4 col-md-offset-4'>
                <label for=''>Password</label>
                <input type='password' class='form-control' id='password' name='Password' placeholder='Password'>
            </div>
        </div>
        <div class='row'>
        <div class="form-group row col-md-4">
            <label for="EmployeerSelect">Wybierz opiekuna produktu</label>
            <select class="form-control" id="EmployeerSelect">
                <?php
                foreach ($Employees as $item)
                    echo '<option value= '.($item->Id).'>'.$item->GetFullName().'</option>'
                ?>
            </select>
        </div>
        </div>
    </form>

    <?php
}