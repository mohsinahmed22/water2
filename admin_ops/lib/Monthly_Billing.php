<?php

/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 4/11/2018 2:57 PM
 */
class Monthly_Billing extends Billing
{

    protected static $db_table = "billing_monthly";
    protected static $column_billing_month = "billing_monthly_id";
    protected static $column = "customer_id";
    protected static $db_table_fields = array(
//        "billing_monthly_id",
        "customer_id",
        "billing_monthly_month",
        "billing_monthly_collection_status",
        "billing_monthly_amount_balance",
        "billing_monthly_amount_paid",
        "billing_monthly_amount_due",
        "billing_monthly_bottle_qty",
        "billing_monthly_visits"
    );

    public $billing_monthly_id;
    public $billing_monthly_month;
    public $billing_monthly_collection_status = 'Unpaid';
    public $billing_monthly_amount_balance;
    public $billing_monthly_amount_paid;
    public $billing_monthly_amount_due;
    public $billing_monthly_bottle_qty;
    public $billing_monthly_visits;

    public function sum_monthly($id, $column, $month, $year)
    {
        global $database;

        $query = "SELECT sum({$column}) as total FROM billing where customer_id =" . $id . " AND MONTH(billing_date) = {$month} AND YEAR(billing_date) = {$year}";
        $result = $database->query($query);
//        $result = static::find_query($query);
        return mysqli_fetch_assoc($result);
    }

    public function count_monthly($id, $month, $year)
    {
        global $database;
        $query = "SELECT count(*) as total FROM billing where customer_id =" . $id . " AND MONTH(billing_date) = {$month} AND YEAR(billing_date) = {$year}";
        $result = $database->query($query);
//        $result = static::find_query($query);
        return mysqli_fetch_assoc($result);


    }

    public function find_by_month($month)
    {
        $query = "SELECT * FROM " . static::$db_table . " ";
        $query .= "WHERE customer_id = " . $this->customer_id;
        $query .= " AND billing_monthly_month = '{$month}' ";
        $month_found = static::find_query($query);
        if ($month_found) {
            foreach ($month_found as $item) {
                return $this->billing_monthly_id = $item->billing_monthly_id;

            }

//            return true;
        }

    }

    public function records_by_month($id)
    {
        $query = "select *  from billing where customer_id = " . $id;
        $result = static::find_query($query);
        $month_array = array();
        foreach ($result as $nw) {
            $date = date_create($nw->billing_date);
            $month_array[date_format($date, "My")]['month'] = date_format($date, "M-y");
            $month_array[date_format($date, "My")]['visits'] = $nw->count_monthly($id, date_format($date, "m"), date_format($date, "Y"));
            $month_array[date_format($date, "My")]['paid'] = $nw->sum_monthly($id, 'billing_amount_paid', date_format($date, "m"), date_format($date, "Y"));
            $month_array[date_format($date, "My")]['due'] = $nw->sum_monthly($id, 'billing_amount_due', date_format($date, "m"), date_format($date, "Y"));
            $month_array[date_format($date, "My")]['qty'] = $nw->sum_monthly($id, 'billing_bottle_qty', date_format($date, "m"), date_format($date, "Y"));
        }
        return $month_array;
    }

    public function monthly_record($id)
    {
        $this->customer_id = $id;
        $monthly_detail = self::records_by_month($id);
//        print_r($monthly_detail);
        $visits = array_column($monthly_detail, 'visits');
        $month = array_column($monthly_detail, 'month');
        $paid = array_column($monthly_detail, 'paid');
        $due = array_column($monthly_detail, 'due');
        $qty = array_column($monthly_detail, 'qty');
        for ($i = 0; $i < count($month); $i++) {
            $this->billing_monthly_month = $month[$i];
            $this->billing_monthly_amount_due = $due[$i]['total'];
            $this->billing_monthly_amount_paid = $paid[$i]['total'];
            $this->billing_monthly_bottle_qty = $qty[$i]['total'];
            $this->billing_monthly_visits = $visits[$i]['total'];
            if ($this->id = $this->find_by_month($month[$i]) && $this->billing_monthly_collection_status != "Unpaid") {
                $this->billing_monthly_collection_status = "Paid";
                $this->update();
                $message[] = "{$month[$i]} Record has been Successfully Updated";
            } elseif ($this->id = $this->find_by_month($month[$i]) && $this->billing_monthly_collection_status == "Unpaid") {
                $this->update();
                $message[] = "{$month[$i]} Record has been Successfully Updated";
            } else {
                $this->create();
                $message[] = "{$month[$i]} New Record has been Added. ";
            }

        }
        return "<div class=\"alert alert-success\">" . implode("<br>", $message) . "</div>";
    }

    // Update
    public function update()
    {
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$db_table . " SET ";
        $query .= implode(", ", $properties_pairs);
        $query .= " WHERE " . static::$column_billing_month . " = " . $this->id;
//        echo $query;
        $database->query($query);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }


}