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

$subtoatal = $customer_bottle_rate * $customer_bottle_qty ;
$grand_total = $subtoatal + $customer_balance;
$grand_total_paid = $subtoatal + $customer_balance;



if(isset($_POST['save_record'])){
    if($_POST['billing_amount_paid'] < $_POST['billing_amount_due']){
    $new_balance = $_POST['billing_amount_due'] - $_POST['billing_amount_paid'];
    }else{
        $new_balance = 0.00;
    }
    $customer_billing =  array(
        'customer_id' => $_POST['customer_id'],
        'customer_balance' => $_POST['customer_balance'],
        'billing_date' => $_POST['billing_date'],
        'billing_amount_due' => $_POST['billing_amount_due'],
        'billing_amount_paid' => $_POST['billing_amount_paid'],
        'billing_amount_balance' => $new_balance,
        'billing_amount_payment_type' => $_POST['billing_amount_payment_type'],
        'billing_bottle_rate' => $_POST['billing_bottle_rate'],
        'billing_bottle_qty' => $_POST['billing_bottle_qty']
    );

    $add_billing = insert_customer_billing($customer_billing);
    if($add_billing) {
        header("Location: view-monthly-customer.php?view={$_POST['customer_id']}");
    }
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
                            <h2>Monthly Report <small>(<?php echo $customer_name ?>)</small></h2>
                            <div class="clearfix"></div>
                        </div>
                    <div class="x_content">
                        <form method="post" >
                        <button type="submit" class="btn btn-danger pull-right"name="generate_report">Generate/Update Report</button>
                            <?php if($customer_status != 0) {?>
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-paid-modal-lg">Paid</button>
                            <?php }?>
                        </form>

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Billing Month</th>
                                <th>Bottles Qty</th>
                                <th>Amount Due</th>
                                <th>Amount Paid</th>
                                <th>New Balance</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <?php
                            if(isset($_POST['generate_report'])){
                                // echo "True";
                                $billing_monthly_report = select_customer_record($_GET['view']);
                                $num_count = mysqli_num_rows($billing_monthly_report);
                                foreach ($billing_monthly_report as $report){
                                    $billing_month = date_create("{$report['billing_date']}");
                                    $billing_month_year[] = date_format($billing_month,'n');
                                    $btl_qty = $report['billing_date'];
                                }
                            }
                            $billing_month_year = array_unique($billing_month_year);;
                            $total = array(
                                'total_sell' => mysqli_fetch_assoc(sum_record('billing','billing_amount_due','customer_id', $_GET['view'])),
                                'total_btl_qty' => mysqli_fetch_assoc(sum_record('billing','billing_bottle_qty','customer_id', $_GET['view'])),
                            );




                            ?>
                            <tbody>
                            <?php  foreach($billing_month_year as $months){
                                        $month = mysqli_fetch_array(sum_record_by_month('billing', 'billing_bottle_qty','customer_id',$_GET['view'],$months));
                                        $total_sell  = mysqli_fetch_array(sum_record_by_month('billing', 'billing_amount_due','customer_id',$_GET['view'],$months));
                                        $total_sell  = mysqli_fetch_array(sum_record_by_month('billing', 'billing_amount_due','customer_id',$_GET['view'],$months));
                                ?>

                                <tr>
                                    <td><?php echo $months ?></td>
                                    <td><?php echo $month[0];?></td>
                                    <td><?php echo $total_sell[0];?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Billing Details <small>(<?php echo $customer_name ?>)</small></h2>
                        <!-- Small modal -->
                        <?php if($customer_status != 0) {?>
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">Add New Billing Record</button>
                        <?php }?>
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
                                        <p>Payment Type : <strong><?php echo ucfirst($customer_payment_type);?></strong>
                                            <input type="hidden" class="form-control" name="billing_amount_payment_type" value="<?php echo ucfirst($customer_payment_type);?>">
                                        </p>
                                        <hr/>


                                        <div class="col-sm-6    ">
                                            <div class="form-group">
                                                <label>Billing Date</label>
                                                <input type="date" class="form-control" name="billing_date" placeholder="Current Date" value="<?php echo $today_date ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Bottle Rate </label>
                                                <input type="text" class="form-control" id="btl_rate" name="billing_bottle_rate" placeholder="Bottle Rate" value="<?php echo $customer_bottle_rate;?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Bottle Qty</label>
                                                <input type="number" class="form-control" id="btl_qty" name="billing_bottle_qty" placeholder="Bottle Qty" value="<?php echo $customer_bottle_qty;?>" onchange="newQty(this.value)">
                                            </div>


                                        </div>
                                        <div class="col-sm-6 pull-right">
                                            <h4>Billing Total</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td>Rs.<div id="netl"><?php echo $subtoatal?></div></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Balance</th>
                                                        <td>Rs.<?php echo $customer_balance ?>
                                                            <input type="hidden" class="form-control" name="customer_balance" value="<?php echo $customer_balance ?>">
                                                            <input type="hidden" class="form-control" name="customer_id" value="<?php echo $_GET['view']?>">

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>Rs. <div id="grndtl"><?php echo  $grand_total?></div>
                                                            <input type="hidden" class="form-control" name="billing_amount_due" value="<?php echo $grand_total?>">

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
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
                                <th>Previous Balance</th>
                                <th>Amount Due</th>
                                <th>Amount Paid</th>
                                <th>New Balance</th>
                            </tr>
                            </thead>


                            <tbody>
                            <?php
                                $billing_month = select_customer_record($_GET['view']);
                                foreach ($billing_month as $record){
                            ?>
                            <tr>
                                <td><?php echo $record['billing_amount_payment_type']?></td>
                                <td><?php echo $record['billing_date']?></td>
                                <td><?php echo $record['billing_bottle_qty']?></td>
                                <td>Rs. <?php echo $record['billing_bottle_rate']?></td>
                                <td>Rs.<?php echo $record['customer_balance']?></td>
                                <td>Rs.<?php echo $record['billing_amount_due']?></td>
                                <td>Rs.<?php echo $record['billing_amount_paid']?></td>
                                <td>Rs.<?php echo $record['billing_amount_balance']?></td>
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
    function newQty(str) {
        var newtotal = document.getElementById("btl_rate").value * str;
        document.getElementById("netl").innerHTML = newtotal;
    }

    $("#paid").keyup(function() {
        $("span#nameFromInput").text($("#paid").val() );
    });
</script>