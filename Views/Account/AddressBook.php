<?php

function AddressBook($AddressesModel)
{
    SidePanel();
    ?>

    <div>
        <a href="/Account/AddAddress"><button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-plus" ></span> Dodaj </button> </a>
    </div>

    <div class="col-md-8">
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>Kraj</th>
            <th>Miasto</th>
            <th>Ulica</th>
            <th>Numer domu</th>
            <th>Kod pocztowy</th>
            <th>Numer telefonu</th>
            <th>Województwo</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($AddressesModel as $item) { ?>
            <tr>
                <td><?php echo $item->Country; ?></td>
                <td><?php echo $item->City; ?></td>
                <td><?php echo $item->Street; ?></td>
                <td><?php echo $item->HouseNumber; ?></td>
                <td><?php echo $item->PostalCode; ?></td>
                <td><?php echo $item->PhoneNumber; ?></td>
                <td><?php echo $item->Vovoidship; ?></td>
                <td>
                    <button class='btn btn-danger' id='" + (ParamSize - 1) + "'><span
                            class='glyphicon glyphicon-minus'></span>Usuń</a> </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>


<?php
}