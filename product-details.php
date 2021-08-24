<?php
$pageTitle = "Product Details";
require('includes/application_top.php');
require('includes/site_header.php');



$productID = isset($_GET['id']) ? $_GET['id'] : '';





?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php 
                    populateProductDetails($productID);
                ?>
            </div>
        </div>
    </div>
</div>
<?php
require('includes/site_footer.php');
?>