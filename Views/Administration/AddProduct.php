<?php

function AddProduct($model, $Categories, $Employees, $ParametersTypes)
{

    ?>
    <!--Formularz dodawania produktu -->
    <form class="form-horizontal" method='post' action='/Administration/AddProduct' enctype="multipart/form-data">
        <!-- Przycisk dodawania -->
        <div style='display:inline;'>
            <h2 style='display:inline;'>Dodaj produkt</h2>
            <div class='navbar-right'>
                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-plus"></span> Dodaj
                </button>
            </div>
        </div>
        <hr>
        <div class='form-group col-md-4'>
        <!-- Pole nazwy produktu -->
        <div class='row'>
            <div class='form-group col-md-12'>
                <label for='ProductName'>Nazwa Produktu</label>
                <input type='text' class='form-control' id='ProductName' name='ProductName'
                       placeholder='Wpisz nazwę produktu'>
            </div>
        </div>
        <!-- Pole kategorii produktu -->
        <div class='row'>
            <div class="form-group row col-md-12">
                <label for="CategorySelect">Wybierz kategorię produktu</label>
                <select class="form-control" id="CategorySelect" name="CategorySelect">
                    <?php
                    foreach ($Categories as $item)
                        echo '<option value= ' . ($item->CategoryId) . '>' . $item->CategoryName . '</option>'
                    ?>
                </select>
            </div>
        </div>
        <!-- Pole ceny produktu -->
        <div class='row'>
            <div class='form-group col-md-12'>
                <label for='ProductPrice'>Cena produktu</label>
                <input type='text' class='form-control' id='ProductPrice' name='ProductPrice'
                       placeholder='Wpisz cenę produktu'>
            </div>
        </div>
        <!-- Pole stanu magazynowego produktu -->
        <div class='row'>
            <div class='form-group col-md-12'>
                <label for='StockSize'>Stan magazynowy</label>
                <input type='text' class='form-control' id='StockSize' name='StockSize'
                       placeholder='Wpisz stan magazynowy produktu'>
            </div>
        </div>
        <!-- Pole opiekuna produktu -->
        <div class='row'>
            <div class="form-group row col-md-12">
                <label for="EmployeerSelect">Wybierz opiekuna produktu</label>
                <select class="form-control" id="EmployeerSelect" name="EmployeerSelect">
                    <?php
                    foreach ($Employees as $item)
                        echo '<option value= ' . ($item->Id) . '>' . $item->GetFullName() . '</option>'
                    ?>
                </select>
            </div>
        </div>
        </div>

            <div  class='form-group col-md-8'>
                <img class='profile-pic'  src='' />
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
                                echo '<option ParamType="' . ($item->Suffix) . '" value= "' . ($item->ParameterId) . '">' . $item->ParameterName . '</option>'
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
            </tbody>
        </table>
        <!-- CKE editor -->
        <div class='row'>
            <div class="form-group row col-md-12">
                <label for="EmployeerSelect">Opis produktu</label>
                <textarea class="ckeditor" name="desc"></textarea>
            </div>
        </div>
        <input type="hidden" value="0" name="ParamSize" id="ParamSize">
    </form>
    <!-- Początek skryptów -->
    <script>
        var ParamSize = 0;
        $(document).ready(function () {
            // Zabezpieczenie przed wpisywaniem liter do pola ceny produktu
            $("#ProductPrice").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) return false;
            });
            // Zabezpieczenie przed wpisywaniem liter do pola stanu magazynowego produktu
            $("#StockSize").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) return false;
            });
            // Dodawanie nowego parametru do tabeli
            $("#ParamTypeSelect").change(function () {
                var Param = ($(this).find(":selected").attr("ParamType"));
                $("#ParamType").val(Param);
            });
            // Reakcja na przycisk dodawania
            $("#Add").click(function () {
                console.log($("#ParamTypeSelect").find(":selected").val());
                if ($("#ParamTypeSelect").find(":selected").val() != -1 && $("#Value").val().length > 0) {
                    var table = document.getElementById("ParametersTable");

                    var row = table.insertRow(2);
                    row.id = ParamSize++;
                    $("#ParamSize").val(ParamSize);

                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);

                    var Id = $("#ParamTypeSelect").find(":selected").val();
                    var Val = $("#Value").val();

                    cell1.innerHTML = ($("#ParamTypeSelect").find(":selected").text());
                    cell2.innerHTML = ($("#Value").val());
                    cell3.innerHTML = ($("#ParamType").val());
                    cell4.innerHTML = "<div><a onclick='DeleteRow(this.id)' class='btn btn-danger' id='" + (ParamSize - 1) + "'><span class='glyphicon glyphicon-minus'></span>Usuń</a> " +
                        "<input type=\"hidden\" value=\"" + Id + "\" name=\"ParamId_" + ParamSize + "\" id=\"ParamId_" + ParamSize + "\">" +
                        "<input type=\"hidden\" value=\"" + Val + "\" name=\"ParamVal_" + ParamSize + "\" id=\"ParamVal_" + ParamSize + "\">" +
                        "</div>";

                    $("#ParamTypeSelect").val(-1);
                    $("#ParamType").val("");
                    $("#Value").val("");

                } else
                    alert("Wprowadź prawidłowe parametry");
            });
        });

        // Usuwanie parametru z tabeli
        function DeleteRow(rowid) {
            var row = document.getElementById(rowid);
            var table = row.parentNode;
            while (table && table.tagName != 'TABLE')
                table = table.parentNode;
            if (!table)
                return;
            table.deleteRow(row.rowIndex);
        }
    </script>

    <script>
        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function(){
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
    </script>
    <?php
}