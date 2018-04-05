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
    protected static $db_table_fields  = array( "billing_id", "customer_id",
        "customer_balance",
        "billing_date",
        "billing_amount_due",
        "billing_amount_paid",
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

}