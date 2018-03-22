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
function select_record($table, $column, $id){
    $select_single_record = db_query("SELECT * FROM $table WHERE $column = $id");
//    $db_data = db_query("SELECT * FROM {}"$table);
    if ($select_single_record){
        return $select_single_record;
    }
}
function sum_record($table,$sum, $customer_column, $id){
    $total_query = db_query("SELECT SUM({$sum}) as total FROM {$table} WHERE {$customer_column} ={$id}");
    if($total_query){
        return $total_query;
    }
}

function sum_record_by_month($table,$sum, $customer_column, $id, $month){
    global $connection;
    $total_query = db_query("SELECT SUM({$sum}) as total FROM {$table} WHERE {$customer_column} ={$id} AND MONTH(billing_date)=$month ");
    if($total_query){
        return $total_query;
    }else{ die('Error' . mysqli_error($connection));}
}

function insert_billing($id,$month,$qty,$amt_due,$amt_paid,$amt_bal){
    global $connection;
    $query_check = mysqli_fetch_assoc(db_query("SELECT billing_monthly_month FROM billing_monthly WHERE billing_monthly_month LIKE '{$month}' AND customer_id = {$id} "));
    if($query_check['billing_monthly_month'] == $month){
        $query = "UPDATE billing_monthly SET ";
        $query .= " billing_monthly_bottle_qty = {$qty}, 
                    billing_monthly_amount_due = {$amt_due},
                    billing_monthly_amount_paid = {$amt_paid},
                    billing_monthly_amount_balance = {$amt_bal} ";
        $query .= "WHERE customer_id = {$id} AND billing_monthly_month = '{$month}' ";
        $total_billing = db_query($query);
    }else{

        $query2 = "INSERT INTO billing_monthly ";
        $query2 .= "(customer_id, billing_monthly_month, billing_monthly_bottle_qty,
              billing_monthly_amount_due, billing_monthly_amount_paid, billing_monthly_amount_balance)";
        $query2 .= " VALUES ({$id},'{$month}',{$qty},{$amt_due},{$amt_paid},{$amt_bal})";
        $total_billing = db_query($query2);
    }

    if (!$total_billing){die('Error' . mysqli_error($connection));}


}


function select_customer_record($id){
    $select_customer_billing = db_query("SELECT * FROM billing WHERE customer_id = $id ORDER BY billing_date DESC");
    if ($select_customer_billing){
        return $select_customer_billing;
    }
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
/* Update Customer*/
function update_customer($data, $id){
    global $connection;
    $edit_query = "UPDATE customers SET
                customer_username = '{$data['customer_username']}', 
                customer_password = '{$data['customer_password']}', 
                customer_name = '{$data['customer_name']}',
                customer_address = '{$data['customer_address']}', 
                customer_email = '{$data['customer_email']}', 
                customer_phone = {$data['customer_phone']},
                customer_status = {$data['customer_status']},
                customer_payment_type = '{$data['customer_payment_type']}',
                customer_bottle_qty = {$data['customer_bottle_qty']},
                customer_bottle_rate = {$data['customer_bottle_rate']},
                customer_advance = {$data['customer_advance']},
                customer_balance = {$data['customer_balance']} 
               WHERE customer_id = $id ";
    $update_customer = mysqli_real_escape_string($connection, db_query($edit_query));
    if($update_customer){return true; }
}

/* Insert Billing Customer*/
function insert_customer_billing($data){
    global $connection;
    $query = "INSERT INTO billing ";
    $query .= "(
                customer_id,
                customer_balance,
                billing_date,
                billing_amount_due,
                billing_amount_paid,
                billing_amount_balance,
                billing_amount_payment_type,
                billing_bottle_qty,
                billing_bottle_rate
                ) ";
    $query .= "VALUES (
                {$data['customer_id']},
                {$data['customer_balance']},
                 '{$data['billing_date']}',
                 {$data['billing_amount_due']},
                {$data['billing_amount_paid']},
                 {$data['billing_amount_balance']},
                '{$data['billing_amount_payment_type']}',
                 {$data['billing_bottle_qty']},
                {$data['billing_bottle_rate']}                
                )";
    $add_customer_billing = mysqli_escape_string($connection, db_query($query));

    $query_customer = $query = "UPDATE customers SET customer_balance = {$data['billing_amount_balance']} WHERE customer_id = {$data['customer_id']}";
    $add_customer_balance = mysqli_escape_string($connection, db_query($query_customer));

    if ($add_customer_billing && $add_customer_balance) {
        return true;
    }
}