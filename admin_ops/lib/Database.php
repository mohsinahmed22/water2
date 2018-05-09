<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 3/27/2018
 * Time: 5:37 PM
 */
class Database
{
    public $connection;

    public function __construct()
    {
        $this->db_connect();
    }

    public function db_connect()
    {
        $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($this->connection->connect_errno) {
            die("Connection failed:" . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);
        return $this->confirm_query($result);
    }

    // Confirm Query
    public function confirm_query($result)
    {
        if (!$result) {
            die("Query Failed: " . $this->connection->error);
        }
        return $result;
    }

    // Escaped String
    public function escaped_string_query($string)
    {
        return $this->connection->real_escape_string($string);
    }

    public function insert_last_id()
    {
        return mysqli_insert_id($this->connection);

    }
}

$database = new Database();