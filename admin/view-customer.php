<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 11:42 AM
 */?>
<?php include "includes/header.php"; ?>
<?php
if(isset($_GET['view'])){
    echo $_GET['view'];
}

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Customers List <small></small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-4 col-sm-3 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Customer Information <small>Aqua jal</small></h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
