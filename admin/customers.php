<?php
/**
 * User: Mohsin
 * Date: 3/12/2018
 * Time: 11:42 AM
 */?>
<?php include "includes/header.php"; ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Customers List <small></small></h3>
            </div>
            <div class="buttons pull-right">
                <a href="add-customer.php" class="btn btn-success btn-lg"><i class="fa fa-user"></i> Add Customer</a>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th>
                                        <input type="checkbox" id="check-all" class="flat">
                                    </th>
                                    <th class="column-title">Customer ID </th>
                                    <th class="column-title">Name </th>
                                    <th class="column-title">Email</th>
                                    <th class="column-title">Phone </th>
                                    <th class="column-title">Address </th>
                                    <th class="column-title">Bottle Qty</th>
                                    <th class="column-title">Bottle Rate</th>
                                    <th class="column-title">Payment Type</th>
                                    <th class="column-title">Adv.</th>
                                    <th class="column-title">Bal.</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php  ?>
                                <tr class="even pointer">
                                    <?php
                                        $customers = select_all_records("SELECT * FROM", "customers");
                                     while($row = mysqli_fetch_assoc($customers)){
                                    ?>

                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" "><?php echo $row['customer_id']?></td>
                                    <td class=" "><?php echo $row['customer_name']?></td>
                                    <td class=" "><?php echo $row['customer_email']?></td>
                                    <td class=" "><?php echo $row['customer_phone']?></td>
                                    <td class=" "><?php echo $row['customer_address']?></td>
                                    <td class=" "><?php echo $row['customer_bottle_qty']?> Bottle </td>
                                    <td class="a-right a-right ">Rs.<?php echo $row['customer_bottle_rate']?></td>
                                    <td class=" "><?php echo $row['customer_payment_type']?></td>
                                    <td class="a-right a-right ">Rs. <?php echo $row['customer_advance']?></td>
                                    <td class="a-right a-right ">Rs.<?php echo $row['customer_balance']?></td>
                                    <td class=""><?php if($row['customer_status'] == 1) {echo "Active";}else{echo "Disable";}?></td>
                                    <td class=" last"><a href="view_customer.php?edit=<?php echo $row['customer_id']?>">View</a> | <a href="edit_customer.php?edit=<?php echo $row['customer_id']?>">Edit</a>
                                    </td>
                                </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
