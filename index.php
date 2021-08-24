<?php
$pageTitle = "Home";
require('includes/application_top.php');
require('includes/site_header.php');

?>
<div class="row main-content">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Products</h2>
            </div>
            <div class="panel-body">
                <div class="row products">
                    <?php
                    populateProducts();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('includes/site_footer.php');
?>