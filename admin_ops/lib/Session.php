<?php
/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 4/9/2018
 * Time: 4:06 PM
 */

class Session {
    private $is_signed_in = false;
    public $user_id ;

    public function __construct()
    {
        session_start();

    }

    public function is_signed_in(){
        return $this->is_signed_in;
    }
//
    private function check_login(){
        if (isset($_SESSION['user_id'])){



        }else{

        }
    }







}


$session = new Session();