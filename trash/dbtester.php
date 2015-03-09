<?php
	session_start();
	include('processes/process.php');
	$connect = connectDB();

    //unset($_SESSION['car']);
   // print_r($_SESSION);
    //unset($_SESSION['username']);

    if(isset($_POST['submit'])){

        echo $_POST['howmany'][0];
        foreach($_POST['check_list'] as $check) {
            echo "check", $check, '<br>';
        }

    foreach($_POST['howmany'] as $result) {
    echo "amount", $result, '<br>';
    }
}

$mydate=getdate(date("U"));
echo $mydate["year"];
$year= $mydate["year"];
$date_str=date('Y-m-d', strtotime("$year-06-30"));

echo 

echo $date_str;
?>
<!--<form id="form" method="POST">
<select id="dropdown1" class="select" tabindex="2" onchange="run(this)">
    <option>Select</option>
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="mercedes">Mercedes</option>
    <option value="audi">Audi</option>
</select>
</form>!-->

<!--<select name="data[Attorney][empresa]" id="AttorneyEmpresa">
<option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="mercedes">Mercedes</option>
</select>
!-->

<form method="POST">

    <table name="options_others">
    <thead>
        <tr>
            <th></th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>

<?php   
    $table=getOthers($connect);
    while($row=mysqli_fetch_assoc($table)){
?>
        <tr>
            <td><input type="checkbox"  name="check_list[]" value="<?=$row['id']?>"/></td>
            <td><?=$row['item']?></td>
            <td><?=$row['price']?></td>
            <td><input type="text" placeholder="Enter Amount" name="howmany[]"/></td>
        </tr>   
<?php   
    }
?>
    </table>
<input type="submit" name="submit" value="Enroll">
    </form>
    Grade:
    <select name="grades" id="grades">
        <option value=""></option>
    <?php
        $checkGradesTable = getGradesDB($connect);
        while ($arrayGradesTable = mysqli_fetch_array($checkGradesTable, MYSQLI_ASSOC)) {
            $grade_level=$arrayGradesTable["grade_levels"];
            echo "<option value=\"$grade_level\">$grade_level</option>";        
        }
    ?>
    </select></br>

        Payment Mode:
    <select name="paymentmode" id="paymode">
        <option value=""></option>
    <?php
        $checkPaymentModeTable=getPaymentModeDB($connect);
        while($arrayPaymentModeTable=mysqli_fetch_array($checkPaymentModeTable, MYSQLI_ASSOC)){
            $mode=$arrayPaymentModeTable["mode"];
            echo"<option value=\"$mode\">$mode</option>";
        }
    ?>
    </select></br>


<script src="jquery-2.1.3.min.js"></script>
<script>

<iframe id="currentElement"  src="summary.php" width="200" height="200" frameborder="0"></iframe>
/*$(document).ready(function() {
    $("#AttorneyEmpresa").change(function(){
        $.ajax({
            type: 'POST',
            data:  {keyname:$('#AttorneyEmpresa option:selected').val()}
        });
    });
});*/

/*$(document).ready(function() {
    $("#AttorneyEmpresa").change(function(){
        alert($('#AttorneyEmpresa option:selected').val());

         $.ajax({
            type: 'POST',
            url: "dbtester2.php",
            data:  {car: $('#AttorneyEmpresa option:selected').val()}
        });

  //  $('#currentElement').attr('src', $('#currentElement').attr('src'));
            });
});

$(document).ready(function(){
     $("#grades").change(function(){
        //alert($('#AttorneyEmpresa option:selected').val());
        $.post('dbtester2.php', {'gradeTable': $('#grades option:selected').val()}, function(data){
            $('#currentElement').attr('src', $('#currentElement').attr('src'));
        });

        

       // return false;
    });

     $("#paymode").change(function(){
        $.post('dbtester2.php', {'feetypeTable': $('#paymode option:selected').val()}, function(data){
            $('#currentElement').attr('src', $('#currentElement').attr('src'));
        });
    });
});
$(document).ready(function(){
    $("#form").submit(function(){

        $.post('dbtester2.php', {'name': 'jesse', 'age': 25}, function(data){
            $("#content").html(data);
        });

        return false;
    });
});
function run(sel) {

    var i = sel.selectedIndex;

    if (i != -1) {
        document.getElementById("car").value = sel.options[i].text;

        $.ajax({
            type: "POST",
            url: "dbtester2.php",
            data: { car: sel.options[i].text}
        }).done(function( msg ) {});
    }
}*/
</script>

<?php
//echo "<html><head></head><body> <script type='application/javascript'>window.onload=function(){window.print()}</script></body></html>";
	include("footer.php");
?>

<!--<div>
<iframe id="currentElement" class="myframe" width="200" height="200" name="myframe" src="summary.php" frameborder="0"></iframe>
</div>!
$(document).ready(function(){
     
     $("#AttorneyEmpresa").change(function(){
        //alert($('#AttorneyEmpresa option:selected').val());
        $.post('dbtester2.php', {'car': $('#AttorneyEmpresa option:selected').val()}, function(data){
            $('#currentElement').attr('src', $('#currentElement').attr('src'));
        });
    });

});

/*$(
    function(){$('#grades').change(function() {
     /*  var panelId=$(this).val();
       alert(panelId);
       var table = document.getElementById("myTable");
       var row = table.insertRow(0);
       var cell1 = row.insertCell(0);
       var cell2 = row.insertCell(1);
       cell1.innerHTML = panelId;
       cell2.innerHTML = panelId;*/});

    $("input:radio[name=uniform]").click(function() {
        var value = $(this).val();
        alert(value);
    });

    $('#preschool').change(function() {
        if($(this).is(":checked")) {
            var value = $(this).val();
            alert(value);
        } else {
            alert("unchecked");
        }
    });

    function myFunction() {
        var table = document.getElementById("myTable");
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerHTML = "NEW CELL1";
        cell2.innerHTML = "NEW CELL2";
    }

    function myDeleteFunction() {
        document.getElementById("myTable").deleteRow(0);
    }
});



-->