<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/27/2018
 * Time: 6:09 PM
 return  */
class DbObject
{

    public static function find_all(){
        return static::find_query("SELECT * FROM ". static::$db_table);
    }

    public static function find_by_id($id){
        $found_id =  static::find_query("SELECT * FROM ". static::$db_table . " WHERE ". static::$column ." = $id  LIMIT 1");
        return !empty($found_id) ? array_shift($found_id) : false;
    }

    public static function find_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();

        while($row = mysqli_fetch_array($result_set)){
            $object_array[] = static::instantiation($row);
        }

        return $object_array;
    }

    public function instantiation($record){
        $calling_class = get_called_class();
        $obj =  new $calling_class;

        foreach ($record as $key => $value){
            if ($obj->has_attribute($key)){
                    $obj->$key = $value;
            }
        }

        return $obj;
    }
    protected function has_attribute($the_attribute) {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }


    // Save

    public function save(){
        return isset($this->id)? $this->update() : $this->create();
    }


    // Create
    public function create(){
        global $database;
        $properties = $this->clean_properties();
        $query = "INSERT INTO " . static::$db_table;
        $query .= " ( ". implode(",", array_keys($properties)). " ) ";
        $query .= " VALUES ('". implode("','", array_values($properties)) ."')";

        if($database->query($query)){
            $this->id = $database->insert_last_id();
            return true ;
        }else{
            return false;
        }
    }


    // Update
    public function update(){
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value ) {
            $properties_pairs[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$db_table . " SET ";
        $query .= implode(", ", $properties_pairs);
        $query .= " WHERE " . static::$column ." = " . $this->id;
        $database->query($query);

        return (mysqli_affected_rows($database->connection) == 1)? true : false;

    }

    //Delete
    public function delete(){
        global $database;
        $query = "DELETE FROM " . static::$db_table . " WHERE ". static::$column ." = " . $this->id;
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

        foreach (static::$db_table_fields as $db_field){
            if(property_exists($this, $db_field)){
                $properties_fields[$db_field] = $this->$db_field;
            }
        }

        return $properties_fields;
    }


}