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
    $view_user = select_record('customers', 'customer_id', $_GET['view']);
    foreach ($view_user as $user){
        $customer_username = $user['customer_username'];
        $customer_name = $user['customer_name'];
        $customer_address = $user['customer_address'];
        $customer_email = $user['customer_email'];
        $customer_phone = $user['customer_phone'];
        $customer_join_date = $user['customer_join_date'];
        $customer_status = $user['customer_status'];
        $customer_payment_type = $user['customer_payment_type'];
        $customer_bottle_qty = $user['customer_bottle_qty'];
        $customer_bottle_rate = $user['customer_bottle_rate'];
        $customer_advance = $user['customer_advance'];
        $customer_balance = $user['customer_balance'];
    }

}
if(isset($_POST['save_record'])){

}
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $customer_name ?>   <small><a class="btn btn-xs btn-success" href="edit-customer.php?edit=<?php echo $_GET['view'];?>">Edit Customer</a></small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-3 col-sm-2 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Personal Information <small>Aqua jal</small></h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <h3><?php echo $customer_name ?></h3>
                        <ul class="list-unstyled user_data">
                            <li><span class="<?php echo ($customer_status == 0) ? "text-danger" : "text-sucess"; ?>"> <i class="fa fa-user user-profile-icon"></i> <?php echo ($customer_status == 0) ? "Disable" : "Active"; ?></span></li>
                            <li><i class="fa fa-key user-profile-icon"></i> <?php echo $customer_username ?> (Username)</li>
                            <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $customer_address ?></li>
                            <li><i class="fa fa-email user-profile-icon"></i> <?php echo $customer_email ?></li>
                            <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $customer_phone ?></li>
                            <li><i class="fa fa-calendar user-profile-icon"></i> <?php echo $customer_join_date ?></li>
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
                            <li>Bottle Qty: <?php echo $customer_bottle_qty ?></li>
                            <li>Bottle Rate: <Rs class=""></Rs><?php echo $customer_bottle_rate ?></li>
                        </ul>
                    </div>
                    <h4>Billing Details</h4>
                    <ul class="list-unstyled user_data">
                        <li>Billing Type: <?php echo ucfirst($customer_payment_type)  ?></li>
                        <li>Advance: Rs.<?php echo $customer_advance ?></li>
                        <li>Previous Bal.: Rs.<?php echo $customer_balance ?></li>
                    </ul>

                </div>
            </div>
            <div class="col-md-9 col-sm-10 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Billing Details <small>(<?php echo $customer_name ?>)</small></h2>
                        <!-- Small modal -->
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">Add New Billing Record</button>

                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="view-customer.php" method="post" class="form-horizontal form-label-left" _lpchecked="1">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel2">Add New Billing</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4>New Billing</h4>
                                        <p>Payment Type : <strong><?php echo ucfirst($customer_payment_type);?></strong></p>
                                        <hr/>


                                        <div class="col-sm-6    ">
                                            <div class="form-group">
                                                <label>Billing Date</label>
                                                <input type="date" class="form-control" name="billing_date" placeholder="Current Date" disabled="disabled" value="<?php echo $today_date ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Bottle Rate </label>
                                                <input type="text" class="form-control" name="billing_bottle_qty" placeholder="Bottle Rate" disabled="disabled" value="<?php echo $customer_bottle_rate;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Bottle Qty</label>
                                                <input type="number" class="form-control" name="billing_bottle_rate" placeholder="Bottle Qty" value="<?php echo $customer_bottle_qty;?>">
                                            </div>


                                        </div>
                                        <div class="col-sm-6 pull-right">
                                            <h4>Billing Total</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td>Rs.<?php echo $subtoatal = $customer_bottle_rate * $customer_bottle_qty ; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Balance</th>
                                                        <td>Rs.<?php echo $customer_balance ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>Rs.<?php echo $grand_total = $subtoatal + $customer_balance?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="form-group">
                                                    <label>Amount Paid</label>
                                                    <input type="text" class="form-control" placeholder="Amount Paid" name="billing_amount_paid" value="<?php echo $grand_total = $subtoatal + $customer_balance?>">
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
                        <p class="text-muted font-13 m-b-30">
                            The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                        </p>
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Bottle Qty</th>
                                <th>Bottle Rate</th>
                                <th>Amount Due</th>
                                <th>Previous Balance</th>
                                <th>Amount Paid</th>
                                <th>Amount Balance</th>
                            </tr>
                            </thead>


                            <tbody>
                            <?php
                                $billing_month = select_all_records('SELECT * FROM', 'billing');
                                foreach ($billing_month as $record){
                            ?>
                            <tr>
                                <td><?php echo $record['billing_amount_payment_type']?></td>
                                <td><?php echo $record['billing_amount_date']?></td>
                                <td><?php echo $record['billing_bottle_qty']?></td>
                                <td><?php echo $record['billing_bottle_rate']?></td>
                                <td><?php echo $record['billing_amount_due']?></td>
                                <td><?php echo $record['billing_amount_balance']?></td>
                                <td><?php echo $record['billing_amount_paid']?></td>
                                <td><?php echo $record['customer_balance']?></td>
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
