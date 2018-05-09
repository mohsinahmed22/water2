<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 11:42 AM
 */ ?>
<?php include "includes/header.php";

date_default_timezone_set("Asia/Karachi");
$today_date = date("Y-m-d");


?>
<?php
//
if (isset($_POST['submit'])) {
    $admin_user = new Admin();
    $admin_user->admin_user_username = $_POST['admin_user_username'];
    $admin_user->admin_user_password = $_POST['admin_user_password'];
    $admin_user->admin_user_name = $_POST['admin_user_name'];
    $admin_user->admin_user_email = $_POST['admin_user_email'];
    $admin_user->admin_user_role = $_POST['admin_user_role'];
    $admin_user->admin_user_status = $_POST['admin_user_status'];
    if ($admin_user->create()) {
        header("Location: admin_users.php?message=Admin User Profile Sucessfully Created");
    }
}
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add New User
                    <small>of AqualJal</small>
                </h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <form class="form-horizontal form-label-left" action="add-user.php" method="post">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Login Information
                                <small></small>
                            </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <input type="hidden" name="admin_user_join_date" value="<?php echo $today_date ?>"/>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status </label>
                                <input type="radio" class="flat" name="admin_user_status" id="active" value="1"
                                       checked="" required/> Active
                                <input type="radio" class="flat" name="admin_user_status" id="disable" value="0"/>
                                Disable
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">User Role</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" name="admin_user_role">
                                        <option value="Administrator">Administrator</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span
                                        class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Username"
                                           name="admin_user_username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control" value="" name="admin_user_password">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Personal Information
                                <small></small>
                            </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span
                                        class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Full Name"
                                           name="admin_user_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span
                                        class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="email" class="form-control" placeholder="Email Address"
                                           name="admin_user_email" required>
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
