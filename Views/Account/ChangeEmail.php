<?php

function ChangeEmail($UserModel = null)
{
    SidePanel();
    ?>


<div class="col-md-8">
        <?php echo "<form class='form-horizontal' method='post' action='/Account/ChangeUserMail/'>";?>
<div style='display:inline;'>
    <h2 style='display:inline;'>Zmień adres email</h2>
    <div class='navbar-right'>
        <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-plus"></span> Zatwierdź zmiany
        </button>
    </div>
    <hr>
</div>
<div class='row'>
    <div class='form-group col-md-6'>
        <label for='Country'>Stary adres email</label>
        <input type='text' class='form-control' id='OldMail' name='OldMail'
               placeholder='Wpisz stary adres email'>
    </div>
</div>

<div class='row'>
    <div class='form-group col-md-6'>
        <label for='City'>Nowy adres email</label>
        <input type='text' class='form-control' id='NewMail' name='NewMail'
               placeholder='Wpisz nowy adres email'>
    </div>
</div>

<div class='row'>
    <div class='form-group col-md-6'>
        <label for='Street'>Powtórz adres email</label>
        <input type='text' class='form-control' id='NewMailConfirm' name='NewMailConfirm'
               placeholder='Wpisz ponownie nowy adres email'>
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
    <?php } ?>


    <?php if ($UserModel->ErrorCode == 2) { ?>
        <div class="row">
            <div class="col-md-6 alert alert-dismissible alert-danger" style="margin-top: 25px">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> <?php echo $UserModel->ErrorLogin; ?> </strong>
            </div>
        </div>
    <?php } ?>
<?php } ?>
</div>

<?php
}