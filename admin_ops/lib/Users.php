<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/27/2018
 * Time: 6:09 PM
 return  */
class Users
{
    protected static $db_table = "customers";
    public $customer_id;
    public $customer_username;
    public $customer_password;
    public $customer_name;
    public $customer_email;
    public $customer_status;
    public $customer_address;
    public $customer_phone;


    public static function select_all_users(){
        return self::find_query("SELECT * FROM ". self::$db_table);
    }

    public static function select_user_by_id($id){
        $found_user =  self::find_query("SELECT * FROM ". self::$db_table . " WHERE customer_id = $id  LIMIT 1");
        return !empty($found_user) ? array_shift($found_user) : false;
    }

    public static function find_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = mysqli_fetch_array($result_set)){
            $object_array[] = self::instantiation($row);
        }
        return $object_array;
    }

    public function instantiation($record){
        $obj =  new self;
        foreach ($record as $key => $value){
            if ($obj->has_attribute($key)){
                    $obj->$key = $value;
            }
        }
        return $obj;
    }
    private function has_attribute($the_attribute) {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }


}