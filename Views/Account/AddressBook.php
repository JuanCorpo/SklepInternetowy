<?php

function AddressBook($AddressesModel)
{
    SidePanel();

echo'
    <div>
        <a href="../../Account/AddAddress/"><button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-plus" ></span> Dodaj </button> </a>
    </div>';
    ?>
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
        <?php
        if(count($AddressesModel) > 0)
        foreach ($AddressesModel as $item) {
            ?>
            <tr>
                <td><?php echo $item->Country; ?></td>
                <td><?php echo $item->City; ?></td>
                <td><?php echo $item->Street; ?></td>
                <td><?php echo $item->HouseNumber; ?></td>
                <td><?php echo $item->PostalCode; ?></td>
                <td><?php echo $item->PhoneNumber; ?></td>
                <td><?php echo $item->Vovoidship; ?></td>
                <td>
                    <a href="../../Account/DeleteAddress/<?php echo$item->AddressId;?>"><button class='btn btn-danger' id=''><span
                            class='glyphicon glyphicon-minus'></span>Usuń </button> </a>
                </td>
            </tr>
            <?php
        }else{
            echo "<tr><td style='text-align: center' colspan='100%'>Brak adresów</td></tr>";
        }

            ?>
        </tbody>
    </table>
    </div>


<?php
}