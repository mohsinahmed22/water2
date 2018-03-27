<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/27/2018
 * Time: 6:09 PM
 return  */
class Users
{
    public $customer_id;
    public $customer_username;
    public $customer_password;
    public $customer_name;
    public $customer_email;
    public $customer_status;
    public $customer_address;
    public $customer_phone;


    public static function select_all_users($table){
        return self::find_query("SELECT * FROM $table");
    }

    public static function select_user_by_id($table, $col, $id){
        $found_user =  self::find_query("SELECT * FROM '{$table}' WHERE '{$col}' = $id ");
        return $found_user;
    }

    public static function find_query($sql){
        global $database;
        $result_set = $database->query($sql);

        return $result_set;

    }



}