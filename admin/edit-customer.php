<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 11:42 AM
 */?>
<?php include "includes/header.php";

date_default_timezone_set("Asia/Karachi");
$today_date = date("Y-m-d");
$edit_user_id = $_GET['edit'];
$message = ""

?>
<?php
if(isset($_GET['edit'])){
    $edit_user = select_record('customers', 'customer_id', $edit_user_id);
    while ($data = mysqli_fetch_assoc($edit_user)){
        $edit_customer_username = $data['customer_username'];
        $edit_customer_password = $data['customer_password'];
        $edit_customer_name = $data['customer_name'];
        $edit_customer_address = $data['customer_address'];
        $edit_customer_email = $data['customer_email'];
        $edit_customer_phone = $data['customer_phone'];
        $edit_customer_status = $data['customer_status'];
        $edit_customer_payment_type = $data['customer_payment_type'];
        $edit_customer_bottle_qty= $data['customer_bottle_qty'];
        $edit_customer_bottle_rate = $data['customer_bottle_rate'];
        $edit_customer_advance = $data['customer_advance'];
        $edit_customer_balance = $data['customer_balance'];
        $edit_customer_join_date = $data['customer_join_date'];
    }
}

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

    $edit_customer_data = array(
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

     $edit_customer = update_customer($edit_customer_data, $_POST['customer_id']);
     $message = "Account has been updated Sucessfully";
     if($edit_customer){ header("Location: edit-customer.php?edit={$_POST['customer_id']}&msg={$message}");}


 }


?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php
        if(isset($_GET['msg'])){?>
            <div class="alert alert-block alert-success"><?php echo $_GET['msg']?></div>
        <?php }?>
        <div class="page-title">
            <div class="title_left">
                <h3>Add New Customer <small>of AqualJal</small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <form class="form-horizontal form-label-left" action="edit-customer.php" method="post">
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
                            <input type="radio" class="flat" name="customer_status" id="active" value="1" <?php if($edit_customer_status == 1){?> checked=""<?php }?>   /> Active
                            <input type="radio" class="flat" name="customer_status" id="disable" value="0" <?php if($edit_customer_status == 0){?> checked=""<?php }?>  /> Disable
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Username <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="Enter Complete Name" name="customer_username" value="<?php echo $edit_customer_username ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" value="" name="customer_password" value="<?php echo $edit_customer_password ?>" required>
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
                                    <input type="text" class="form-control" placeholder="Enter Complete Name" name="customer_name"  value="<?php echo $edit_customer_name ?>"required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="tel" class="form-control" placeholder="Phone" name="customer_phone" value="<?php echo $edit_customer_phone ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="email" class="form-control" placeholder="Enter Email Address" name="customer_email" value="<?php echo $edit_customer_email ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" rows="3" placeholder='rows="3"' name="customer_address" required><?php echo $edit_customer_address ?></textarea>
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
                                    <option value="cash" <?php if($edit_customer_payment_type == "Cash"){?> selected="selected"<?php }?>  >Cash</option>
                                    <option value="Monthly" <?php if($edit_customer_payment_type == "Monthly"){?> selected="selected"<?php }?>  >Monthly</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bottle Qty</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="Enter Bottle Qty" name="customer_bottle_qty" value="<?php echo $edit_customer_bottle_qty ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bottle Rate <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="Each Rate" value="<?php echo $edit_customer_bottle_rate ?>"name="customer_bottle_rate" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Advance <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="" value="<?php echo $edit_customer_advance ?>" name="customer_advance" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Previous Balance</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="" name="customer_balance" value="<?php echo $edit_customer_balance ?>" required>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <hr/>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" class="form-control" placeholder="" name="customer_id" value="<?php echo $edit_user_id ?>">
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
