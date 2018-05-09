<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 11:42 AM
 */ ?>
<?php include "includes/header.php";
$message = "";
date_default_timezone_set("Asia/Karachi");
$today_date = date("Y-m-d");
$id = $_GET['edit'];
$admin = Admin::find_by_id($id);

//
?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php
        if (isset($_GET['msg'])) {
            ?>
            <div class="alert alert-block alert-success"><?php echo $_GET['msg'] ?></div>
        <?php } ?>
        <div class="page-title">
            <div class="title_left">
                <h3>Add New User
                    <small>of AqualJal</small>
                </h3>
            </div>
        </div>
        <?php
        if (isset($_POST['submit'])) {
            $admin->user_id = $_POST['user_id'];
            $admin->id = $_POST['user_id'];
            $admin->admin_user_username = $_POST['admin_user_username'];
            $admin->admin_user_password = $_POST['admin_user_password'];
            $admin->admin_user_name = $_POST['admin_user_name'];
            $admin->admin_user_email = $_POST['admin_user_email'];
            $admin->admin_user_role = $_POST['admin_user_role'];
            $admin->admin_user_status = $_POST['admin_user_status'];
            if ($admin->update()) {
                header("Location: edit-user.php?edit={$_GET['edit']}&msg=" . urlencode("Admin User Profile Sucessfully Created"));
            }

        }

        ?>
        <div class="clearfix"></div>
        <form class="form-horizontal form-label-left" action="edit-user.php?edit=<?php echo $_GET['edit'] ?>"
              method="post">
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
                            <br/>
                            <input type="hidden" name="customer_join_date" value="<?php echo $today_date ?>"/>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status </label>
                                <input type="radio" class="flat" name="admin_user_status" id="active"
                                       value="1" <?php if ($admin->admin_user_status == 1) { ?> checked=""<?php } ?> />
                                Active
                                <input type="radio" class="flat" name="admin_user_status" id="disable"
                                       value="0" <?php if ($admin->admin_user_status == 0) { ?> checked=""<?php } ?> />
                                Disable
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">User Role</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" name="admin_user_role">
                                        <option
                                            value="Administrator" <?php if ($admin->admin_user_role == "Administrator") { ?> selected="selected"<?php } ?> >
                                            Administrator
                                        </option>
                                        <option
                                            value="Staff" <?php if ($admin->admin_user_role == "Staff") { ?> selected="selected"<?php } ?> >
                                            Staff
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span
                                        class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Username"
                                           name="admin_user_username" value="<?php echo $admin->admin_user_username ?>"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control" value="" name="admin_user_password"
                                           value="<?php echo $admin->admin_user_password ?>" required>
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
                                    <input type="text" class="form-control" placeholder="Name" name="admin_user_name"
                                           value="<?php echo $admin->admin_user_name ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span
                                        class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="email" class="form-control" placeholder="Customer Email Address"
                                           name="admin_user_email" value="<?php echo $admin->admin_user_email ?>"
                                           required>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <hr/>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" class="form-control" placeholder="" name="user_id"
                               value="<?php echo $admin->user_id ?>">
                        <button class="btn btn-primary" type="button">Cancel</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        <?php echo $admin->user_id ?>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>
