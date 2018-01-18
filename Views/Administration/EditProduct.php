<?php

function EditProduct($ProductModel, $Employees, $Categories, $ParametersTypes)
{
?>
    <!-- Skrypty -->
    <script src="/Scripts/AddParameters.js"></script>

    <!--Formularz dodawania produktu -->
    <div class="col-md-12">
        <form class="form-horizontal" method='post' action='<?php echo DIR; ?>/Administration/EditProduct/<?php echo $ProductModel->ProductId; ?>' enctype="multipart/form-data">
            <div style='display:inline;'>
                <h2 style='display:inline;'>Edytuj produkt</h2>
                <div class='navbar-right'>
                    <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-pencil"></span> Zatwierdź zmiany
                    </button>
                </div>
            </div>
            <hr>

            <!-- Pole nazwy produktu -->
            <div class='form-group col-md-4'>
                <div class='row'>
                    <div class='form-group col-md-12'>
                        <label for='ProductName'>Nazwa Produktu</label>
                        <input type='text' class='form-control' id='ProductName' name='ProductName' value="<?php echo $ProductModel->Name; ?>"
                               placeholder='Wpisz nazwę produktu'>
                    </div>
                </div>
                <!-- Pole kategorii produktu -->
                <div class='row'>
                    <div class="form-group row col-md-12">
                        <label for="CategorySelect">Wybierz kategorię produktu</label>
                        <select class="form-control" id="CategorySelect" name="CategorySelect">
                            <?php
                            foreach ($Categories as $item) {
                                $Selected = ($ProductModel->CategoryId == $item->CategoryId ? "selected" : "");
                                echo '<option '.$Selected.' value= ' . ($item->CategoryId) . '>' . $item->CategoryName . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Pole ceny produktu -->
                <div class='row'>
                    <div class='form-group col-md-12'>
                        <label for='ProductPrice'>Cena produktu</label>
                        <input type='text' class='form-control' id='ProductPrice' name='ProductPrice' value="<?php echo $ProductModel->Price; ?>"
                               placeholder='Wpisz cenę produktu'>
                    </div>
                </div>
                <!-- Pole stanu magazynowego produktu -->
                <div class='row'>
                    <div class='form-group col-md-12'>
                        <label for='StockSize'>Stan magazynowy</label>
                        <input type='text' class='form-control' id='StockSize' name='StockSize' value="<?php echo $ProductModel->StockSize; ?>"
                               placeholder='Wpisz stan magazynowy produktu'>
                    </div>
                </div>
                <!-- Pole opiekuna produktu -->
                <div class='row'>
                    <div class="form-group row col-md-12">
                        <label for="EmployeerSelect">Wybierz opiekuna produktu</label>
                        <select class="form-control" id="EmployeerSelect" name="EmployeerSelect">
                            <?php
                            foreach ($Employees as $item) {
                                $Selected = ($ProductModel->ProductEmployeeId == $item->Id ? "selected" : "");
                                echo '<option '.$Selected.' value=" ' . ($item->Id) . '">' . $item->GetFullName() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Zdjęcie produktu -->
            <div  class='form-group col-md-8'>
                <img src="<?php echo $ProductModel->ImageDirectory; ?>"  class='profile-pic'  src='' />
                <br>
                <div class="upload-button btn btn-warning">Załaduj Obrazek</div>
                <input class="file-upload" style="display: none" type="file" accept="image/*" name="ImageUpload"/>
            </div>
            <!-- Tabela dodawania parametrów -->
            <table class="table table-striped" id="ParametersTable">
                <thead>
                <tr>
                    <th scope="col">Nazwa Parametru</th>
                    <th scope="col">Wartość</th>
                    <th scope="col">Jednostka</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="form-group row col-md-12">
                            <select class="form-control" id="ParamTypeSelect">
                                <option value="-1">---Wybierz---</option>
                                <?php
                                foreach ($ParametersTypes as $item)

                                    echo '<option  ParamType="' . ($item->Suffix) . '" value= "' . ($item->ParameterId) . ' ">' . $item->ParameterName . '</option>'
                                ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class='form-group col-md-12'>
                            <input type='text' class='form-control' id='Value'>
                        </div>
                    </td>
                    <td>
                        <div class='form-group col-md-12'>
                            <input type='text' class='form-control' id='ParamType' disabled=''>
                        </div>
                    </td>
                    <td>
                        <div>
                            <a class="btn btn-success" id='Add'><span class="glyphicon glyphicon-plus"></span>Dodaj</a>
                        </div>
                    </td>
                </tr>
                <?php
                foreach ($ProductModel->Parameters as $item) { ?>
                    <script>
                        AddRowLoaded("<?php echo $item->ParameterType->ParameterId; ?>", "<?php echo $item->ParameterType->ParameterName; ?>", "<?php echo $item->ParameterValue; ?>", "<?php echo $item->ParameterType->Suffix; ?>");
                    </script>
                <?php } ?>
                </tbody>
            </table>
            <!-- CKE editor -->
            <div class='row'>
                <div class="form-group row col-md-12">
                    <label for="EmployeerSelect">Opis produktu</label>
                    <textarea class="ckeditor" name="desc"> <?php echo $ProductModel->Description; ?> </textarea>
                </div>
            </div>
            <input type="hidden" value="0" name="ParamSize" id="ParamSize">
            <script type="text/javascript">
                var elem = document.getElementById("ParamSize");
                elem.value = GetParamSize();
            </script>
        </form>
    </div>
    <?php
}