<?php

function AddAddress()
{
    SidePanel();
?>
    <div class="col-md-8">
    <?php echo "<form class='form-horizontal' method='post' action='../../Account/AddAddress/'>";?>
        <div style='display:inline;'>
            <h2 style='display:inline;'>Dodaj adres do książki adresowej</h2>
            <div class='navbar-right'>
                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-plus"></span> Dodaj adres
                </button>
            </div>
            <hr>
        </div>
        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='Country'>Kraj</label>
                <input type='text' class='form-control' id='Country' name='Country'
                       placeholder='Wpisz nazwę kraju'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='City'>Miasto</label>
                <input type='text' class='form-control' id='City' name='City'
                       placeholder='Wpisz nazwę miasta'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='Street'>Ulica</label>
                <input type='text' class='form-control' id='Street' name='Street'
                       placeholder='Wpisz nazwę ulicy'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='HouseNumber'>Numer domu</label>
                <input type='text' class='form-control' id='HouseNumber' name='HouseNumber'
                       placeholder='Wpisz numer domu'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='PostalCode'>Kod pocztowy</label>
                <input type='text' class='form-control' id='PostalCode' name='PostalCode'
                       placeholder='Wpisz kod pocztowy'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='PhoneNumber'>Numer telefonu</label>
                <input type='text' class='form-control' id='PhoneNumber' name='PhoneNumber'
                       placeholder='Wpisz numer telefonu'>
            </div>
        </div>

        <div class='row'>
            <div class='form-group col-md-6'>
                <label for='Vovoidship'>Województwo</label>
                <input type='text' class='form-control' id='Vovoidship' name='Vovoidship'
                       placeholder='Wpisz nazwę Województwa'>
            </div>
        </div>
    </form>
    </div>



<?php
}