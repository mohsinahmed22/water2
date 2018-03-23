<?php
/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/19/2018
 * Time: 5:37 PM
 */
ob_start();
include 'db.php';
include "functions.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Ajax Name Search</title>


</head>
<body>
<h1>The XMLHttpRequest Object</h1>
<div id="time"></div>
<button type="button" onclick="loadajax('ajax_test.php?time=0', timeFun)">Time</button>



<div id="count"></div>
<button type="button" onclick="loadajax('ajax_test.php?count', countFun)">Count</button>
<br>
<input type="number" name="num1" id="num1" >
<input type="number" name="num2" id="num2">
<div id="calc"></div>
<button type="button" onclick="loadajax('ajax_test.php?count', calcFun)">Count</button>
<br><br><br>
<?php
$select_customer = select_all_records("SELECT * FROM ", 'customers');
print_r($select_customer);?>



<form>
<select name="ssname" id="ssname"  >
    <?php
foreach ($select_customer as $customer){
    echo "<option onclick=\"loadajax('ajax_test.php?data='+ this.value, loadData)\" value='{$customer['customer_id']}'>". $customer['customer_name'] . "</option>";
}
?>
</select>
    <input type="hidden"  id="user_id" value="<?php echo mysqli_num_rows($select_customer)?>">
</form>
<div id="detail"></div>
<button type="button" id="nexts" onclick="nexts()">Next</button>
<button type="button" id="pres" disabled onclick="pres()">Pre</button>


<script>
    var i = 1;
    var x = document.getElementById('user_id').value;
    loadajax('ajax_test.php?data=' + i,loadData);
    function loadajax2(url, cFun) {
        var xhttp;
        xhttp =  new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200){
                cFun(this, i);
            }
        }
        xhttp.open('GET', url, true);
        xhttp.send();

    }

    function loadajax(url, cFun) {
        var xhttp;
        xhttp =  new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200){
                cFun(this);
            }
        }
        xhttp.open('GET', url, true);
        xhttp.send();

    }

    function timeFun(xhttp) {
        document.getElementById('time').innerHTML = xhttp.responseText;
    }
    function countFun(xhttp) {
            document.getElementById('count').innerHTML = xhttp.responseText;

    }
    function calcFun() {
        var num1,num2;
        num1 = parseFloat(document.getElementById('num1').value);
        num2 = parseFloat(document.getElementById('num2').value);
        document.getElementById("calc").innerHTML =  (num1+num2);
    }
    function loadData(xhttp) {
        document.getElementById('detail').innerHTML = xhttp.responseText;

    }


    function nexts() {
        if(i < x) {
            i++;
            loadajax('ajax_test.php?data=' + i, loadData);
            document.getElementById('pres').removeAttribute('disabled');
        }else {document.getElementById('nexts').setAttribute('disabled','disabled');}

    }
    function pres() {
        if(i >= 1){
            i--;
            loadajax('ajax_test.php?data='+i,loadData);
            document.getElementById('nexts').removeAttribute('disabled');
        }else {document.getElementById('pres').setAttribute('disabled','disabled');}

    }
</script>
</body>
</html>
