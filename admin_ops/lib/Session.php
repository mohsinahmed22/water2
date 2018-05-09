<?php
/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 4/9/2018
 * Time: 4:06 PM
 */
class Session
{
    private $is_signed_in = false;
    public $user_id;
    public $message;

    public function __construct()
    {
        session_start();
        $this->check_login();
//        $this->check_message();
    }

    public function is_signed_in()
    {
        return $this->is_signed_in;
    }

    private function check_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->is_signed_in = true;
        } else {
            $this->is_signed_in = false;
            unset($this->user_id);

        }
    }

    public function login($user)
    {
        if ($user) {
            echo $this->user_id = $_SESSION['user_id'] = $user->user_id;
            $this->is_signed_in = true;

        }
    }

    public function logout()
    {
        unset($this->user_id);
        unset($_SESSION['user_id']);
        $this->is_signed_in = false;

    }

    public function message($msg = "")
    {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }

    }

    public function check_message()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }


}


$session = new Session();