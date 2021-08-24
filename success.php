<?php
$pageTitle = "Success";
require('includes/application_top.php');
require('includes/site_header.php');
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading, text-center">
                <h2 class="panel-title">Order Confirmed</h2>
            </div>
            <div class="panel-body">
                <div class="col-sm-12, text-center">
                    <img class="confirmed-img img-fluid" src='images/icons/tick.png'>
                    <!--Generated Order Number here-->
                    <h3>Order Number: 218821744</h3>
                </div>
                <div class="row, text-center">
                    <p>Thank you for your order. An email has been sent to confirm delivery.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('includes/site_footer.php');
?>