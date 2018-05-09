<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 5/8/2018
 * Time: 6:09 PM
 */
class Admin extends DbObject
{
    protected static $db_table = "admin_users";
    protected static $column = "user_id";
    protected static $db_table_fields = array(
        "admin_user_name",
        "admin_user_password",
        "admin_user_username",
        "admin_user_role",
        "admin_user_email",
        "admin_user_status"
    );
    public $user_id;
    public $id;
    public $admin_user_name;
    public $admin_user_username;
    public $admin_user_password;
    public $admin_user_role;
    public $admin_user_email;
    public $admin_user_status;

    public static function verify_customer($username, $password)
    {
        global $database;
        $query = "SELECT * FROM admin_users where ";
        $query .= "admin_user_username = '{$username}' and ";
        $query .= "admin_user_password = '{$password}'";

        $found_user = static::find_query($query);
        return !empty($found_user) ? array_shift($found_user) : false;
    }

}