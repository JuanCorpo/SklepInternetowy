<?php

function BasicInfo($UserModel = null)
{
    SidePanel();
    ?>



    <div class="col-md-8">
        <?php echo "<form class='form-horizontal' method='post' action='/Account/ChangeBasicInfo/'>";?>
        <div style='display:inline;'>
            <h2 style='display:inline;'>Zmień dane użytkownika</h2>
            <div class='navbar-right'>
                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-plus"></span> Zatwierdź zmiany
                </button>
            </div>
            <hr>
        </div>
        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='Country'>Nazwa użytkownika</label>
                <input type='text' class='form-control' id='UserName' name='UserName'
                       placeholder='Wpisz nazwę użytkownika'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='City'>Imię</label>
                <input type='text' class='form-control' id='FirstName' name='FirstName'
                       placeholder='Wpisz swoje imię'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='Street'>Nazwisko</label>
                <input type='text' class='form-control' id='SurName' name='SurName'
                       placeholder='Wpisz swoje nazwisko'>
            </div>
        </div>
        </form>

    <?php if ($UserModel != null) { ?>
    <?php if ($UserModel->ErrorCode == 1) { ?>
        <div class="row">
            <div class="col-md-6 alert alert-dismissible alert-success" style="margin-top: 25px">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>  <?php echo $UserModel->ErrorLogin; ?> </strong>
            </div>
        </div>
    <?php } }?>

    </div>

    <?php
}