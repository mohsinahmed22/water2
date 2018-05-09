<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 11:42 AM
 */?>
<?php include "includes/header.php"; ?>
<?php
date_default_timezone_set("Asia/Karachi");
$today_date = date("Y-m-d");

if(isset($_GET['view'])){
    $customer = Customer::find_by_id($_GET['view']);
    $customer->customer_id = $_GET['view'];

}
if(isset($_POST['save_record'])){
//    if($_POST['previous_balance']) {echo "yes";}
    $new_record = new Billing();
    $new_record->customer_id = $customer->customer_id;
    $new_record->billing_date = $_POST['billing_date'];
    $new_record->billing_amount_paid = $_POST['billing_amount_paid'];
    $new_record->billing_bottle_qty = $_POST['billing_bottle_qty'];
    $new_record->billing_bottle_rate = $_POST['billing_bottle_rate'];
    $new_record->billing_amount_payment_type = $_POST['billing_amount_payment_type'];
    $new_record->customer_balance = $customer->customer_balance;
    $new_record->billing_amount_due = $new_record->billing_bottle_qty * $_POST['billing_bottle_rate'];

    if(isset($_POST['previous_balance'])){
        $new_record->billing_amount_balance = ($new_record->billing_amount_due + $new_record->customer_balance) - $new_record->billing_amount_paid;
    }elseif(!isset($_POST['previous_balance']) && $new_record->billing_amount_due > $new_record->billing_amount_paid){
        $new_record->billing_amount_balance  = $new_record->customer_balance + ($new_record->billing_amount_due - $new_record->billing_amount_paid);
    }else{
        $new_record->billing_amount_balance = $new_record->customer_balance;
    }
    $new_record->save();
    $customer->customer_balance = $new_record->billing_amount_balance;
    $customer->id = $customer->customer_id;
    $customer->update();
}
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $customer->customer_name ?>   <small><a class="btn btn-xs btn-success" href="edit-customer.php?edit=<?php echo $customer->customer_id ;?>">Edit Customer</a></small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-3 col-sm-2 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Personal Informationa <small>Aqua jal</small></h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <h3><?php echo $customer->customer_name;


                            ?></h3>
                        <ul class="list-unstyled user_data">
                            <li><span class="<?php echo ($customer->customer_status == 0) ? "text-danger" : "text-sucess"; ?>"> <i class="fa fa-user user-profile-icon"></i> <?php echo ($customer->customer_status == 0) ? "Disable" : "Active"; ?></span></li>
                            <li><i class="fa fa-key user-profile-icon"></i> <?php echo $customer->customer_username ?> (Username)</li>
                            <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $customer->customer_address ?></li>
                            <li><i class="fa fa-email user-profile-icon"></i> <?php echo $customer->customer_email ?></li>
                            <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $customer->customer_phone ?></li>
                            <li><i class="fa fa-calendar user-profile-icon"></i> <?php echo $customer->customer_join_date ?></li>
                        </ul>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">

                        <h2>Billing Detail <small>Aqua jal</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <h4>Bottle's Details</h4>
                        <ul class="list-unstyled user_data">
                            <li>Bottle Qty: <?php echo $customer->customer_bottle_qty ?></li>
                            <li>Bottle Rate: <Rs class=""></Rs><?php echo $customer->customer_bottle_rate ?></li>
                        </ul>
                    </div>
                    <h4>Billing Details</h4>
                    <ul class="list-unstyled user_data">
                        <li>Billing Type: <?php echo ucfirst($customer->customer_payment_type)  ?></li>
                        <li>Advance: Rs.<?php echo $customer->customer_advance ?></li>
                        <li>Previous Bal.: Rs.<?php echo $customer->customer_balance ?></li>
                    </ul>

                </div>
            </div>
            <div class="col-md-9 col-sm-10 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Billing Details <small>(<?php echo $customer->customer_name ?>)</small></h2>
                        <!-- Small modal -->
                        <?php if($customer->customer_status != 0) {?>
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">Add New Billing Record</button>
                        <?php }?>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="view-customer.php?view=<?php echo $_GET['view']?>" method="post" class="form-horizontal form-label-left" _lpchecked="1">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel2">Add New Billing</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4>New Billing</h4>
                                        <p>Payment Type : <strong><?php echo ucfirst($customer->customer_payment_type);?></strong>
                                            <input type="hidden" class="form-control" name="billing_amount_payment_type" value="<?php echo ucfirst($customer->customer_payment_type);?>">
                                        </p>
                                        <hr/>


                                        <div class="col-sm-6    ">
                                            <div class="form-group">
                                                <label>Billing Date</label>
                                                <input type="date" class="form-control" name="billing_date" placeholder="Current Date" value="<?php echo $today_date ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Bottle Rate </label>
                                                <input type="text" class="form-control" id="btl_rate" name="billing_bottle_rate" placeholder="Bottle Rate" value="<?php echo $customer->customer_bottle_rate;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Bottle Qty</label>
                                                <input type="number" class="form-control" id="btl_qty" name="billing_bottle_qty" placeholder="Bottle Qty" value="<?php echo $customer->customer_bottle_qty;?>" onkeyup="update_value(this.value)">
                                            </div>
                                            <div class="form-group">
                                                <label>Previous Balance</label>
                                                <input type="checkbox" id="previous_balance" name="previous_balance" value="1" onchange="update_value(this)">

                                                <br>
                                                <small>if checked previous balance will be added to total</small>
                                            </div>


                                        </div>
                                        <div class="col-sm-6 pull-right">
                                            <h4>Billing Total</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody id="test">
                                                    </tbody>
                                                </table>
                                                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['view']?>">
                                                <div class="form-group">
                                                    <label>Amount Payable</label>
                                                    <input type="text" id="paid" class="form-control" placeholder="Amount Paid" name="billing_amount_paid" required>
                                                    <input type="hidden" class="form-control" name="billing_amount_balance" value="0">
                                                </div>
                                            </div>
                                            <button type="reset" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                            <button type="submit" name="save_record" class="btn btn-primary pull-right">Save Billing Record</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                    </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /modals -->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30"></p>
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Bottle Qty</th>
                                <th>Bottle Rate</th>
                                <th>Previous Balance</th>
                                <th>Amount Due</th>
                                <th>Amount Paid</th>
                                <th>New Balance</th>
                            </tr>
                            </thead>


                            <tbody>
                            <?php

                                $customer_billing = Billing::find_by_id($customer->customer_id);
                                if($customer_billing) {
                                    foreach ($customer_billing as $record) {
                                        ?>
                                        <tr>
                                            <td><?php echo $record->billing_amount_payment_type; ?></td>
                                            <td><?php echo $record->billing_date; ?></td>
                                            <td><?php echo $record->billing_bottle_qty; ?></td>
                                            <td>Rs. <?php echo $record->billing_bottle_rate ?></td>
                                            <td>Rs.<?php echo $record->customer_balance ?></td>
                                            <td>Rs.<?php echo $record->billing_amount_due ?></td>
                                            <td>Rs.<?php echo $record->billing_amount_paid ?></td>
                                            <td>Rs.<?php echo $record->billing_amount_balance ?></td>
                                        </tr>
                                    <?php }
                                }else{ ?>
                                    <tr>
                                        <td colspan="8" class="text-center"><strong>No Result Found</strong></td>
                                    </tr>


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "includes/footer.php"; ?>
<script>

    update_value();
    function update_value(val) {
        var rate  = document.getElementById('btl_rate').value ;
        var qty = document.getElementById('btl_qty').value;

        if(document.getElementById('previous_balance').checked){
            var bal = 1;
            var balamt = <?php echo $customer->customer_balance;?>
        }else{
            var bal = 0;
            var balamt = 0;
        }


        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 || xhttp.status == 200){
                document.getElementById('test').innerHTML = xhttp.responseText;
            }
        }

        xhttp.open('GET', 'test.php?qty='+ qty + '&rate='+ rate + "&bal="+ bal + "&balamt="+ balamt, true)
        xhttp.send();
    }

</script>