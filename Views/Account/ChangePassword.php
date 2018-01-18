<?php

function ChangePassword($model)
{
    SidePanel();
?>

    <div class="col-md-8">
        <h2 style='display:inline;'>Zmień hasło</h2>
    <hr>
    <?php echo'<form class="form-horizontal" method="post" action="../../Account/ChangePassword/">';?>
        <!-- Pole nazwy produktu -->
        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='ProductName'>Stare hasło</label>
                <input type='password' class='form-control' id='OldPassword' name='OldPassword'
                       placeholder='Wpisz stare hasło'>
            </div>
        </div>
        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='ProductName'>Nowe hasło</label>
                <input type='password' class='form-control' id='NewPassword' name='NewPassword'
                       placeholder='Wpisz nowe hasło'>
            </div>
        </div>
        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='ProductName'>Nowe hasło</label>
                <input type='password' class='form-control' id='NewPasswordConfirm' name='NewPasswordConfirm'
                       placeholder='Powtórz nowe hasło'>
            </div>
        </div>
        <div class='navbar-left'>
            <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-pencil"></span> Wyślij
            </button>
        </div>
        </div>
    <input type='hidden' class='form-control' id='Email' name='Email' value='<?php echo $model->UserPrivateMail; ?>'>
    </form>

    <?php if ($model->ErrorCode == 1) { ?>
    <div class="row">
        <div class="col-md-6 alert alert-dismissible alert-success" style="margin-top: 25px">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>  <?php echo $model->ErrorLogin; ?> </strong>
        </div>
    </div>
    <?php } ?>


    <?php if ($model->ErrorCode == 2) { ?>
    <div class="row">
    <div class="col-md-6 alert alert-dismissible alert-danger" style="margin-top: 25px">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> <?php echo $model->ErrorLogin; ?> </strong>
    </div>
    </div>
    <?php } ?>

    </div>
<?php
}