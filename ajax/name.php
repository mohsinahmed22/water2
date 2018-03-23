<?php
/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/19/2018
 * Time: 5:37 PM
 */?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Ajax Name Search</title>


</head>
<body>
<h1>The XMLHttpRequest Object</h1>

<h3>Start typing a name in the input field below:</h3>

<form action="">
    First name: <input type="text" id="txt1" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>
<script>
    function showHint(val) {
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200 ){
                document.getElementById('txtHint').innerHTML = this.responseText;
            }

        };
        xhttp.open('GET', "ajax_test.php?db="+val, true)
        xhttp.send();
    }
</script>

</body>
</html>
