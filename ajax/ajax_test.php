
<?php
include "db.php";
include "functions.php";
if(isset($_GET['ajax'])){

    echo $count = $_GET['ajax'];


}
if(isset($_GET['php'])){
    $a[] = "Anna";
    $a[] = "Brittany";
    $a[] = "Cinderella";
    $a[] = "Diana";
    $a[] = "Eva";
    $a[] = "Fiona";
    $a[] = "Gunda";
    $a[] = "Hege";
    $a[] = "Inga";
    $a[] = "Johanna";
    $a[] = "Kitty";
    $a[] = "Linda";
    $a[] = "Nina";
    $a[] = "Ophelia";
    $a[] = "Petunia";
    $a[] = "Amanda";
    $a[] = "Raquel";
    $a[] = "Cindy";
    $a[] = "Doris";
    $a[] = "Eve";
    $a[] = "Evita";
    $a[] = "Sunniva";
    $a[] = "Tove";
    $a[] = "Unni";
    $a[] = "Violet";
    $a[] = "Liza";
    $a[] = "Elizabeth";
    $a[] = "Ellen";
    $a[] = "Wenche";
    $a[] = "Vicky";

// get the q parameter from URL
    $q = $_REQUEST["php"];


    $hint = "";
// lookup all hints from array if $q is different from ""
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        foreach($a as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint === "") {
                    $hint = $name;
                } else {
                    $hint .= ", $name";
                }
            }
        }
    }

// Output "no suggestion" if no hint was found or output correct values
    echo $hint === "" ? "no suggestion" : $hint;




}
if(isset($_GET['db'])){
    $test = mysqli_fetch_assoc(db_query("SELECT * FROM billing WHERE customer_id = 2"));
    echo $test['billing_bottle_rate'] * $_GET["db"];
}

if(isset($_GET['time'])){
    echo date('D,M H:m:s, Y');
}

if(isset($_GET['count'])){

    echo $count = $count++;
}


if(isset($_GET['data'])){
    $sel_user = mysqli_fetch_assoc(select_record('customers','customer_id', $_GET['data']));
    if($sel_user){
        echo "<br> Name:" . $sel_user["customer_name"]."<br>";
        echo "Address:" . $sel_user["customer_address"]."<br>";
        echo "Phone:" . $sel_user["customer_phone"]."<br>";
        echo "Email:" . $sel_user["customer_email"]."<br>";
    }else{
        echo "No Data Found";
    }




}