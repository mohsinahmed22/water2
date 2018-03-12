<?php
/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 12:59 PM
 */

function db_query($data){
    global $connection;
    $query_db = mysqli_query($connection, $data);
    if ($query_db){
        //die("Error Mysqli" . $connection);
    }
    return $query_db;
}


function select_all_records($query, $table){
    global $connection;
    $db_data = db_query($query." ".$table);
    return $db_data;
}

function select_record($query, $table){
    global $connection;

}
