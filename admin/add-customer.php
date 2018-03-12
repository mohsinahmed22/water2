<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 11:42 AM
 */?>
<?php include "includes/header.php";

date_default_timezone_set("Asia/Karachi");
$today_date = date("Y-m-d");


?>
<?php
 if(isset($_POST['submit'])){
/*     $customer_username = $_POST['customer_username'];
     $customer_password = $_POST['customer_password'];
     $customer_name = $_POST['customer_name'];
     $customer_address = $_POST['customer_address'];
     $customer_email = $_POST['customer_email'];
     $customer_phone = $_POST['customer_phone'];
     $customer_status = $_POST['customer_status'];
     $customer_payment_type = $_POST['customer_payment_type'];
     $customer_bottle_qty= $_POST['customer_bottle_qty'];
     $customer_bottle_rate = $_POST['customer_bottle_rate'];
     $customer_advance = $_POST['customer_advance'];
     $customer_balance = $_POST['customer_balance'];
     $customer_join_date = $_POST['customer_join_date'];*/
    $customer_data = array(
     'customer_username' => $_POST['customer_username'],
     'customer_password' => $_POST['customer_password'],
     'customer_name' => $_POST['customer_name'],
     'customer_address' => $_POST['customer_address'],
     'customer_email' => $_POST['customer_email'],
     'customer_phone' => $_POST['customer_phone'],
     'customer_status' => $_POST['customer_status'],
     'customer_payment_type' => $_POST['customer_payment_type'],
     'customer_bottle_qty' => $_POST['customer_bottle_qty'],
     'customer_bottle_rate' => $_POST['customer_bottle_rate'],
     'customer_advance' => $_POST['customer_advance'],
     'customer_balance' => $_POST['customer_balance'],
     'customer_join_date' => $_POST['customer_join_date'],
    );

     $new_customer = insert_customer($customer_data);
     if($new_customer){ header("Location: customers.php");}

 }


?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add New Customer <small>of AqualJal</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <form class="form-horizontal form-label-left" action="add-customer.php" method="post">
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Login Information<small></small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <input type="hidden" name="customer_join_date" value="<?php echo $today_date?>"/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status </label>
                            <input type="radio" class="flat" name="customer_status" id="active" value="1" checked="" required /> Active
                            <input type="radio" class="flat" name="customer_status" id="disable" value="0" /> Disable
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Username <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="Enter Complete Name" name="customer_username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" value="" name="customer_password" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Personal Information<small></small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Name <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Enter Complete Name" name="customer_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="tel" class="form-control" placeholder="Phone" name="customer_phone" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="email" class="form-control" placeholder="Enter Email Address" name="customer_email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" rows="3" placeholder='rows="3"' name="customer_address" required></textarea>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Infomation<small></small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Type</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="customer_payment_type">
                                    <option value="cash">Cash</option>
                                    <option value="Monthly">Monthly</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bottle Qty</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="Enter Bottle Qty" name="customer_bottle_qty" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bottle Rate <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="Each Rate" name="customer_bottle_rate" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Advance <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="" name="customer_advance" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Previous Balance</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="" name="customer_balance" required>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <hr/>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <button class="btn btn-primary" type="button">Cancel</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
            </div>

        </div>
        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>
