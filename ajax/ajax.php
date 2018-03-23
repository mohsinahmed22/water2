<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Ajax</title>


</head>
<body>

<h1>The XMLHttpRequest Object</h1>

<p id="demo">Let AJAX change this text.</p>

<p id="demo2">Demo 2</p>
<p id="xml">xml</p>
<button type="button" onclick="loadDoc('ajax_info.txt', myFunction)">Change Content for Demo 1</button>
<button type="button" onclick="loadDoc('ajax_test.php?ajax=100', myFunc)">Change Content for Demo 2</button>
<button type="button" onclick="loadDoc('cd_catalog.xml', funXml)">Load XML</button>
<button type="button" onclick="loadDoc('ajax_info.txt', myhead)">Response Header</button>


<script>
    function loadDoc(url, cFunction) {
        var xhttp;
        xhttp=new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                cFunction(this);
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }
   function myFunction(xhttp){
        document.getElementById('demo').innerHTML = xhttp.responseText;
   }
   function myFunc(xhttp){
       document.getElementById('demo2').innerHTML = xhttp.responseText;
   }
    function myhead(xhttp){
        document.getElementById('demo2').innerHTML = xhttp.getResponseHeader("Last-Modified");;
    }

    function funXml(xhttp){
        var  xmlDoc, txt, x, i;
        xmlDoc = xhttp.responseXML;
        txt = "";
        x = xmlDoc.getElementsByTagName("PRICE");
        for (i = 0; i < x.length; i++) {
            txt = txt + x[i].childNodes[0].nodeValue + "<br>";
        }
        document.getElementById("xml").innerHTML = txt;
    }

</script>

</body>
</html>