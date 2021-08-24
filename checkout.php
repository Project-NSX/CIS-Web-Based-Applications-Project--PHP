<?php
$pageTitle = "Checkout";
require('includes/application_top.php');
require('includes/site_header.php');


if(!isset($_SESSION['userID']) || empty($_SESSION['userID'])) 
{
    $_SESSION['readyForCheckout'] = false;
    $succ_msg = 4;
    header('Location: login.php?succ_msg=' . $succ_msg);

}

?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Checkout</h2>
            </div>
            <hr />
            <div class="panel-body, text-center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Delivery</h3>
                        <div class="panel-body" style="padding: 5px">
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                    <b>Delivery Address:</b> <br />
                                    <p style="padding-top: 5px">Mr Made Up<br />
                                        42 Some street,<br />
                                        Some town<br />
                                        Some County</br>
                                        EX22-7TD<br />
                                    </p>
                                </div>
                                <div class="col-md-6" style="padding: 5px">
                                    <b>Delivery Method: </b><br />
                                    <form style="padding-top: 5px">
                                        <input type="radio" name="d-method" value="prime" checked> Chamoizon Prime<br>
                                        <input type="radio" name="d-method" value="standard"> Free Standard Delivery<br>
                                        <input type="radio" name="d-method" value="special"> Special Delivery
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Delivery And items</h3>
                        <div class="panel-body" style="padding: 5px">
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                    <b>Items:</b><br />
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    <b>Price:</b><br />
                                </div>
                            </div>
                            <!--Products and prices here-->
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                    1 x Premium Ladder + Free Bloke
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    £300<br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                    1 x Chamoizon Basics Squeegee
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    £15<br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                    1 x Chamoizon Chamoise Leather
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    £15<br />
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                    <b>Delivery:</b><br />
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    <br />
                                </div>
                            </div>
                            <!--Delivery method and price-->
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                    Chamoizon Prime
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    £0.00<br />
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                    <b>Total:</b><br />
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                </div>
                            </div>
                            <!--Order Total-->
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 5px">
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    £330<br />
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                </div>
                <!--Order Confirmation button-->
                <form method="post" action="success.php" id="add-to-basket" class="form horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-primary btn-block" name="action" value="Confirm Order" required />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require('includes/site_footer.php');
?>