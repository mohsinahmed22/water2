<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/27/2018
 * Time: 6:12 PM
 */
class Customer extends DbObject
{
    protected static $db_table = "customers";
    protected static $column = "customer_id";
    protected static $db_table_fields  = array( "customer_id",
                                                "customer_username",
                                                "customer_password",
                                                "customer_name",
                                                "customer_address",
                                                "customer_email",
                                                "customer_phone",
                                                "customer_join_date",
                                                "customer_status",
                                                "customer_payment_type",
                                                "customer_bottle_qty",
                                                "customer_bottle_rate",
                                                "customer_advance",
                                                "customer_balance"
                                                 );
    public $customer_id;
    public $id;
    public $customer_username;
    public $customer_password;
    public $customer_name;
    public $customer_email;
    public $customer_status;
    public $customer_address;
    public $customer_phone;
    public $customer_join_date;
    public $customer_payment_type;
    public $customer_bottle_qty;
    public $customer_bottle_rate;
    public $customer_advance;
    public $customer_balance;
//

    public static function verify_customer($username, $password){
            global $database;
            $query =  "SELECT * FROM customers where ";
            $query .= "customer_username = '{$username}' and ";
            $query .= "customer_password = '{$password}'";
            $found_customer = static::find_query($query);

            return !empty($found_customer)? array_shift($found_customer): false;


    }








}
