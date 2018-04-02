<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/27/2018
 * Time: 6:12 PM
 */
class Customer extends Users
{
    protected static $db_table = "customers";
    protected static $db_table_fields  = array( "customer_username",
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
    public $customer_join_date;
    public $customer_payment_type;
    public $customer_bottle_qty;
    public $customer_bottle_rate;
    public $customer_advance;
    public $customer_balance;


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



    // Save

    public function save(){
        return isset($this->customer_id)? $this->update() : $this->create();
    }


    // Create
    public function create(){
        global $database;
        $properties = $this->clean_properties();
        $query = "INSERT INTO " . self::$db_table;
        $query .= " ( '". implode("','", array_keys($properties)). "' ) ";
        $query .= " VALUES ('". implode("','", array_values($properties)) ."')";

//        echo $query;
        if($database->query($query)){
            $this->customer_id = $database->insert_last_id();
            return true ;
        }else{
            return false;
        }
    }


    // Update
    public function update(){
        global $database;
//        echo "yes";
        $properties = $this->clean_properties();
        $properties_pairs = array();
        foreach ($properties as $key => $value ) {
            $properties_pairs[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE " . self::$db_table . " SET ";
        $query .= implode(", ", $properties_pairs);
        $query .= " WHERE customer_id = " . $this->customer_id;
        $database->query($query);

        return (mysqli_affected_rows($database->connection) == 1)? true : false;

    }

    //Delete
    public function delete(){
        global $database;
        $query = "DELETE FROM " . self::$db_table . " WHERE customer_id  = " . $this->customer_id;
        echo ($database->query($query)? "yes" : "false");
    }


    protected function clean_properties(){
        global  $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value){
            $clean_properties[$key] = $database->escaped_string_query($value);
        }
    return $clean_properties;
    }
    protected function properties(){
        $properties_fields = array();
        foreach (self::$db_table_fields as $db_field){
            if(property_exists($this, $db_field)){
               $properties_fields[$db_field] = $this->$db_field;
            }

        }
        return $properties_fields;
    }


}