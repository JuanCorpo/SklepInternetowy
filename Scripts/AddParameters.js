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

        if ($("#ParamTypeSelect").find(":selected").val() != -1 && $("#Value").val().length > 0) {
            AddRow();

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

function AddRow() {
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
    cell2.innerHTML = document.getElementById('Value').value;// ($("#Value").val());
    cell3.innerHTML = ($("#ParamType").val());
    cell4.innerHTML = "<div><a onclick='DeleteRow(this.id)' class='btn btn-danger' id='" + (ParamSize - 1) + "'><span class='glyphicon glyphicon-minus'></span>Usuń</a> " +
        "<input type=\"hidden\" value=\"" + Id + "\" name=\"ParamId_" + ParamSize + "\" id=\"ParamId_" + ParamSize + "\">" +
        "<input type=\"hidden\" value=\"" + Val + "\" name=\"ParamVal_" + ParamSize + "\" id=\"ParamVal_" + ParamSize + "\">" +
        "</div>";

    $("#ParamTypeSelect").val(-1);
    $("#ParamType").val("");
    $("#Value").val("");
}

function AddRowLoaded(ParamType, ParamName, Value, Suffix) {
    var table = document.getElementById("ParametersTable");

    var row = table.insertRow(2);
    row.id = ParamSize++;
    $("#ParamSize").val(ParamSize);

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    var Id = ParamType;
    var Val = Value;

    cell1.innerHTML = ParamName;
    cell2.innerHTML = Value;
    cell3.innerHTML = Suffix;
    cell4.innerHTML = "<div><a onclick='DeleteRow(this.id)' class='btn btn-danger' id='" + (ParamSize - 1) + "'><span class='glyphicon glyphicon-minus'></span>Usuń</a> " +
        "<input type=\"hidden\" value=\"" + Id + "\" name=\"ParamId_" + ParamSize + "\" id=\"ParamId_" + ParamSize + "\">" +
        "<input type=\"hidden\" value=\"" + Val + "\" name=\"ParamVal_" + ParamSize + "\" id=\"ParamVal_" + ParamSize + "\">" +
        "</div>";

    $("#ParamTypeSelect").val(-1);
    $("#ParamType").val("");
    $("#Value").val("");
}

function GetParamSize() {
    return ParamSize;
}


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