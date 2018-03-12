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

/* General Selection*/
function select_all_records($query, $table){

    $db_data = db_query($query." ".$table);
    return $db_data;
}

/* General One Selection*/
function select_record($table, $id){

//    $db_data = db_query("SELECT * FROM {}"$table);

}


/* Insert Customer*/
function insert_customer($data){
global $connection;
    $query = "INSERT INTO customers ";
    $query .= "(customer_username, 
                customer_password, 
                customer_name,
                customer_address, 
                customer_email, 
                customer_phone,
                customer_join_date,
                customer_status,
                customer_payment_type,
                customer_bottle_qty,
                customer_bottle_rate,
                customer_advance,
                customer_balance) ";
    $query .= "VALUES (
                '{$data['customer_username']}',
                '{$data['customer_password']}',
                '{$data['customer_name']}',
                '{$data['customer_address']}',
                '{$data['customer_email']}',
                {$data['customer_phone']},
                '{$data['customer_join_date']}',
                 {$data['customer_status']},
                '{$data['customer_payment_type']}',
                {$data['customer_bottle_qty']},
                {$data['customer_bottle_rate']},
                {$data['customer_advance']},
                {$data['customer_balance']}
                )";
     $add_customer = mysqli_escape_string($connection, db_query($query));
     if ($add_customer) {
         return true;
     }
}