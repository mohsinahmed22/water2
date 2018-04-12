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

    public function sum_monthly($id,$column, $month, $year){
        global $database;

        $query = "SELECT sum({$column}) as total FROM billing where customer_id =" . $id . " AND MONTH(billing_date) = {$month} AND YEAR(billing_date) = {$year}";
        $result = $database->query($query);
//        $result = static::find_query($query);
        return mysqli_fetch_assoc($result);
    }
    public function count_monthly($id, $month, $year){
        global $database;
        $query = "SELECT count(*) as total FROM billing where customer_id =" . $id . " AND MONTH(billing_date) = {$month} AND YEAR(billing_date) = {$year}";
        $result = $database->query($query);
//        $result = static::find_query($query);
        return mysqli_fetch_assoc($result);


    }

    public function records_by_month($id){
        $query = "select *  from billing where customer_id = " . $id;
        $result = static::find_query($query);
        $month_array = array();
        foreach ($result as $nw){
            $date= date_create($nw->billing_date);
              $month_array[date_format($date,"My")]['month'] = date_format($date,"M-y");
            $month_array[date_format($date,"My")]['visits'] = $nw->count_monthly($id,date_format($date,"m"), date_format($date,"Y"));
              $month_array[date_format($date,"My")]['paid'] = $nw->sum_monthly($id,'billing_amount_paid',date_format($date,"m"), date_format($date,"Y"));
              $month_array[date_format($date,"My")]['due'] = $nw->sum_monthly($id,'billing_amount_due',date_format($date,"m"), date_format($date,"Y"));
              $month_array[date_format($date,"My")]['qty'] = $nw->sum_monthly($id,'billing_bottle_qty',date_format($date,"m"), date_format($date,"Y"));
        }
        return $month_array;
    }
    public function monthly_record($id){
            $monthly_detail = self::records_by_month($id);
//            print_r($monthly_detail);
            $visits = array_column($monthly_detail, 'visits');
            $month = array_column($monthly_detail, 'month');
            $paid = array_column($monthly_detail, 'paid');
            $due = array_column($monthly_detail, 'due');
            $qty = array_column($monthly_detail, 'qty');
            for($i=0; $i < count($month); $i++){
                $html = "<tr>";
                $html .= "<td>". $month[$i]. "</td>";
                $html .= "<td>". $visits[$i]['total']. "</td>";
                $html .= "<td>".$qty[$i]['total']."</td>";
                $html .= "<td>". $due[$i]['total']. "</td>";
                $html .= "<td>". $paid[$i]['total']."</td>";
                $html .= "<td></td>";
                $html .= "<td></td>";
                $html .= "</tr>";
                echo $html;
            }


    }

}

