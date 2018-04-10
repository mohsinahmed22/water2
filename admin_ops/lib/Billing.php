<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 4/5/2018
 * Time: 7:57 PM
 */
class Billing extends DbObject
{
    protected static $db_table = "billing";
    protected static $column = "customer_id";
    protected static $db_table_fields  = array(
                                                "billing_id",
                                                "customer_id",
                                                "customer_balance",
                                                "billing_date",
                                                "billing_amount_due",
                                                "billing_amount_paid",
                                                "billing_amount_balance",
                                                "billing_amount_payment_type",
                                                "billing_bottle_qty",
                                                "billing_bottle_rate"
                                            );

    public $billing_id;
    public $id;
    public $customer_id;
    public $customer_balance;
    public $billing_date;
    public $billing_amount_due;
    public $billing_amount_paid;
    public $billing_amount_balance;
    public $billing_amount_payment_type;
    public $billing_bottle_qty;
    public $billing_bottle_rate;


    public static function find_by_id($id){
        $found_id =  static::find_query("SELECT * FROM ". static::$db_table . " WHERE ". static::$column ." = $id ");
        return !empty($found_id) ? $found_id : false;
    }

    public function monthly_info($date){
        $a = new self();
        echo $a->customer_id;
    }

    public function monthname($id){
        $this->id = $id;
        $query = "select *  from billing where customer_id = " . $id;
        $result = static::find_query($query);
        $month_array = array();
        foreach ($result as $nw){
            $date= date_create($nw->billing_date);
            $month_array[date_format($date,"My")]['month'] = date_format($date,"M-y");
            $month_array[date_format($date,"My")]['visit'] = static::monthly_info($nw->billing_date);
        }

        return $month_array;
    }

    public function monthly_record($id){
            $month_name_array = self::monthname($id);
            print_r($month_name_array);





    }

}
