<?php

function AddProduct($model, $Categories, $Employees, $ParametersTypes)
{

    ?>
    <form class="form-horizontal" method='post' action='/Administration/AddProduct'>
        <div style='display:inline;'>
            <h2 style='display:inline;'>Dodaj produkt</h2>


            <div class='navbar-right'>
                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-plus"></span> Dodaj
                </button>
            </div>
        </div>
        <hr>


        <div class='row'>
            <div class='form-group col-md-4 col-md-offset-4'>
                <label for='ProductName'>Nazwa Produktu</label>
                <input type='text' class='form-control' id='ProductName' name='ProductName'
                       placeholder='Wpisz nazwę produktu'>
            </div>
        </div>


        <div class='row'>
            <div class="form-group row col-md-4">
                <label for="CategorySelect">Wybierz kategorię produktu</label>
                <select class="form-control" id="CategorySelect" name="CategorySelect">
                    <?php

                    foreach ($Categories as $item)
                        echo '<option value= ' . ($item->CategoryId) . '>' . $item->CategoryName . '</option>'
                    ?>
                </select>
            </div>
        </div>


        <div class='row'>
            <div class='form-group col-md-4 col-md-offset-4'>
                <label for='ProductPrice'>Cena produktu</label>
                <input type='text' class='form-control' id='ProductPrice' name='ProductPrice'
                       placeholder='Wpisz cenę produktu'>
            </div>
        </div>


        <div class='row'>
            <div class='form-group col-md-4 col-md-offset-4'>
                <label for='StockSize'>Stan magazynowy</label>
                <input type='text' class='form-control' id='StockSize' name='StockSize'
                       placeholder='Wpisz stan magazynowy produktu'>
            </div>
        </div>


        <div class='row'>
            <div class="form-group row col-md-4">
                <label for="EmployeerSelect">Wybierz opiekuna produktu</label>
                <select class="form-control" id="EmployeerSelect" name="EmployeerSelect">
                    <?php
                    foreach ($Employees as $item)
                        echo '<option value= ' . ($item->Id) . '>' . $item->GetFullName() . '</option>'
                    ?>
                </select>
            </div>
        </div>


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


        <div class='row'>
            <div class="form-group row col-md-12">
                <label for="EmployeerSelect">Opis produktu</label>
                <textarea class="ckeditor" name="desc"></textarea>
            </div>
        </div>
        <input type="hidden" value="0" name="ParamSize" id="ParamSize">
    </form>


    <script>
        var ParamSize = 0;
        $(document).ready(function () {
            //called when key is pressed in textbox
            $("#ProductPrice").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) return false;
            });
            //called when key is pressed in textbox
            $("#StockSize").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) return false;
            });

            $("#ParamTypeSelect").change(function () {
                var Param = ($(this).find(":selected").attr("ParamType"));
                $("#ParamType").val(Param);
            });

            $("#Add").click(function () {
                console.log($("#ParamTypeSelect").find(":selected").val());
                if ($("#ParamTypeSelect").find(":selected").val() != -1 && $("#Value").val().length > 0) {
                    //     $("#ParametersTable").insertRow(0);
                    var table = document.getElementById("ParametersTable");

// Create an empty <tr> element and add it to the 1st position of the table:
                    var row = table.insertRow(2);
                    row.id = ParamSize++;
                    $("#ParamSize").val(ParamSize);


// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:

                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
// Add some text to the new cells:
                    var Id = $("#ParamTypeSelect").find(":selected").val();
                    var Val = $("#Value").val();

                    cell1.innerHTML = ($("#ParamTypeSelect").find(":selected").text());
                    cell2.innerHTML = ($("#Value").val());
                    cell3.innerHTML = ($("#ParamType").val());
                    cell4.innerHTML = "<div><a onclick='DeleteRow(this.id)' class='btn btn-danger' id='"+(ParamSize -1)+"'><span class='glyphicon glyphicon-minus'></span>Usuń</a> " +
                        "<input type=\"hidden\" value=\"" + Id + "\" name=\"ParamId_" + ParamSize + "\" id=\"ParamId_" + ParamSize + "\">" +
                        "<input type=\"hidden\" value=\"" + Val + "\" name=\"ParamVal_" + ParamSize + "\" id=\"ParamVal_" + ParamSize + "\">" +
                        "</div>";
                } else
                    alert("Wprowadź prawidłowe parametry");
            });
        });

        function DeleteRow(rowid)
        {
            var row = document.getElementById(rowid);
            var table = row.parentNode;
            while ( table && table.tagName != 'TABLE' )
                table = table.parentNode;
            if ( !table )
                return;
            table.deleteRow(row.rowIndex);
        }
    </script>
    <?php
}