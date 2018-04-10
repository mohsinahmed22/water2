<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 11:59 AM
 */
ob_start();
?>
<?php include('db/init.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/green.css" rel="stylesheet">
    <link href="assets/css/daterangepicker.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="assets/css/custom.css" rel="stylesheet">
</head>
<?php
if (isset($_POST['login'])){
    $username = trim($_POST['customer_username']);
    $password = trim($_POST['customer_password']);

    $user_found  = Customer::verify_customer($username, $password);
    if($user_found){
        $session->user_id = $user_found->customer_id;
        header("Location: index.php");
    }else{
        $message = "<div class='alert alert-danger'>Invalid Login. Kindly check username and password.</div>";
    }
}else{
    $message = "";

}
if (isset($_POST['signup'])){

    $user = new Customer();
    $user->customer_payment_type     = $_POST['customer_payment_type'];
    $user->customer_username = $_POST['customer_username'];
    $user->customer_password = $_POST['customer_password'];
    $user->customer_name =  $_POST['customer_name'];
    $user->customer_email = $_POST['customer_email'];
    $user->customer_phone =  $_POST['customer_phone'];
    $user->customer_address =  $_POST['customer_address'];
    $user->customer_bottle_qty =  $_POST['customer_bottle_qty'];
    if($user->save()){
        $message = "<div class='alert alert-success'>Your Account has been created successfully. Our Representative will contact you soon.</div>";
    }
}
?>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                 <?php echo $message ?>
                <form action="" method="post">
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" name="customer_username" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="customer_password" required="" />
                    </div>
                    <div>
                        <input type="submit" class="btn btn-default submit" value="Login" name="login" />
                        <a class="reset_pass" href="#">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-table"></i> Aqual Jal</h1>
                            <p>©2017 All Rights Reserved. Aqual Jal.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form action="login.php" method="post">
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" name="customer_username" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" name="customer_password" />
                    </div>
                    <hr>
                    <div>
                        <input type="text" class="form-control" placeholder="Full Name" name="customer_name" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" name="customer_email" required="" />
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Full Name" name="customer_phone" required="" />
                    </div>
                    <div>
                        <textarea cols="10" rows="3" class="form-control" placeholder="Complete Address" name="customer_address" required="" ></textarea>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Bottle Qty" name="customer_bottle_qty" required="" />
                    </div>
                    <div>
                        <select class="form-control" name="customer_payment_type">
                            <option value="Cash">Cash</option>
                            <option value="Monthly">Monthly</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-default submit" value="Request for Sign-up" name="signup" />
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-table"></i>  Aqual Jal</h1>
                            <p>©2017 All Rights Reserved. Aqual Jal</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
