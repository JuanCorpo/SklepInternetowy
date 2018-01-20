<?php
function AccountProfileView($model)
{
SidePanel();
 ?>
    <div class="col-md-8">
    <h2 style='display:inline;'>Dane użytkownika</h2>
    <hr>


    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nazwa użytkownika</td>
                <td> <?php echo $model->UserName; ?> </td>
            </tr>
            <tr>
                <td>Adres email</td>
                <td> <?php echo $model->UserPrivateMail; ?> </td>
            </tr>
            <tr>
                <td>Imię</td>
                <td> <?php echo $model->FirstName; ?> </td>
            </tr>
            <tr>
                <td>Nazwisko</td>
                <td> <?php echo $model->SurName; ?> </td>
            </tr>
        </tbody>
    </table>

    </div>
    <?php
}
?>


