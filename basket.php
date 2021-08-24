<?php
$pageTitle = "Basket";
require('includes/application_top.php');
require('includes/site_header.php');

// Create new session array if one doesn't exist
if (!isset($_SESSION['basket'])) 
{
    $_SESSION['basket'] = array();
}

// Post action from last page
if (isset($_POST['action']) and $_POST['action'] == "Add To Basket") 
{
    $productID = $_POST['productID'];
    $quantity = $_POST['quantity'];

    // If product is already in basket
    if (array_key_exists($productID, $_SESSION['basket'])) 
    {
        // Add quantity to it
        $_SESSION['basket'][$productID] += $quantity;
    } 
    else 
    {
        // Add product and quantity to array
        $_SESSION['basket'] += array($productID => $quantity);
    }
}
// Delete action from this page
else if (isset($_POST['delete']))
{ 
    $deleteID = $_POST['delete'];
    unset($_SESSION['basket'][$deleteID]);
} 


else if (isset($_POST['update']))
{
    updateBasket();
}
else if (isset($_POST['checkout']))
{
    if(!isset($_SESSION['userID']) || empty($_SESSION['userID'])) 
    {
        $_SESSION['readyForCheckout'] = false;
        $succ_msg = 4;
        header('Location: login.php?succ_msg=' . $succ_msg);

    }
    else
    {
        $_SESSION['readyForCheckout'] = true;
        header('Location: checkout.php');
    }

}

// If user tries to add over 99 of an item to basket
foreach ($_SESSION['basket'] as $p => $q) {
    if ($q > 99) {
        $_SESSION['basket'][$p] = 99;
    }
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Basket</h2>
                <hr />
            </div>
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-body, text-center" style="padding: 20px">
                        <?php
                        if (!empty($_SESSION['basket'])) 
                        {
                            ?>
                            <form name="action" id="updateBasket" method="post" class="form-horizontal, text-left">
                            
                            <?php
                            foreach ($_SESSION['basket'] as $p => $q) 
                            {
                                populateBasket($p, $q);
                            }
                            ?>
                            <!--Bottom of Basket-->
                            <div class="row">
                                <div class="col-md-12">
                                    
                                        <div class="form-group">
                                            <div class="col-sm-12" style="align-items: center">
                                                <input id="update" type="submit" class="btn btn-secondary btn-block" name="update" value="Update Basket" />
                                                <input id="checkout" type="submit" class="btn btn-primary btn-block" name="checkout" value="Checkout" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        } 
                        else 
                        {
                            ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-info text-left">
                                        <p>Your baseket is empty</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require('includes/site_footer.php');
?>