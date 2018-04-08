<?php
/**
 * Created by PhpStorm.
 * User: Mohsin
 * Date: 4/6/2018
 * Time: 11:07 AM
 */
include ("db/init.php");

if(isset($_GET['qty'])){?>
    <tr>
        <th style="width:50%">Subtotal:</th>
        <td>Rs.<div id="netl"><?php echo ($_GET['rate']  * $_GET['qty']);?></div></td>
    </tr>
    <?php  if ($_GET['bal'] == 1) {?>
    <tr>
        <th>Balance:</th>
        <td>Rs. <div id="grndtl"><?php echo ($_GET['balamt']);?></div></td>
    </tr>
    <?php } ?>
    <tr>
        <th>Total:</th>
        <td>Rs. <div id="grndtl"><?php

                        if ($_GET['bal'] == 1) {
                            $total = ($_GET['rate'] * $_GET['qty']) + $_GET['balamt'] ;
                            echo $total;
                        }else{
                            $total = ($_GET['rate'] * $_GET['qty']);
                            echo $total;
                        }


                ?></div>

        </td>
   </tr>

<?php }


