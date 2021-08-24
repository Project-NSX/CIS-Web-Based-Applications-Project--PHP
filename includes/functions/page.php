<?php
// Populates all products on index.php
function populateProducts()
{
    global $db;
    $sql = "SELECT productID, productName, image, alt, price  FROM product";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="col-md-3 product">
            <h3><?= $row['productName'] ?></h3>
            <img class="img-thumb" src="<?= $row['image'] ?>" alt="<?= $row['alt'] ?>" />
            <p>
                £<?= $row['price'] ?>
            </p>
            <div class="row btn_row">
                <div class="col-md-6 button">
                    <a class="btn btn-secondary btn block" href="product-details.php?id=<?= $row['productID'] ?>">Product
                        Details</a>
                </div>
                <form action="basket.php" method="post" id="add-to-basket" class="form-horizontal,text-left">
                    <div class="form-group">
                        <div class="col-sm-6 button">
                            <!--Add to basket button-->
                            <input type="submit" class="btn btn-secondary btn block" name="action" value="Add To Basket" required />
                            <input type="hidden" name="productID" value="<?= $row['productID'] ?>" />
                            <input type="hidden" name="quantity" value=1 />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }
}

// Populates the product details on the product details page
function populateProductDetails($productID)
{
    global $db;
    $sql = "SELECT productID, productName, image, alt, price, description FROM product WHERE productID =" . mysqli_real_escape_string($db, $productID) . "";
    $result = mysqli_query($db, $sql);
    $productDetails = mysqli_fetch_assoc($result);
    $productError = 'URL is not a valid product. Please select a valid product. If the issue persists, please contact someone who cares you donkey :D';
    // Error block for if the itemID isn't recognised
    if (!$productDetails) {
    ?>
        <div class="row">
            <div class="col-sm-12 text-left">
                <div class="alert alert-danger">
                    <p><?= $productError ?></p>
                </div>
            </div>
        </div>
    <?php
        require('includes/site_footer.php');
        exit;
    }

    ?>
    <h2 class="panel-title"><?= $productDetails['productName'] ?></h2>
    </div>
    <div class="text-center">
        <div class="panel-body, text-center">
            <div class="row">
                <div class="col-md-3, text-center">
                    <!--Product Image-->
                    <img class="img" src="<?= $productDetails['image'] ?>" alt="<?= $productDetails['alt'] ?>">
                </div>
                <div class="col-md-4">
                    <h4 class="text-left">
                        Description:
                    </h4>
                    <p class="text-justify">
                        <!--Product Description-->
                        <?=
                            $productDetails['description']
                        ?>
                    </p>
                </div>
                <div class="col-md-4, text-left">
                    <h5 class="text-left">
                        <!--Product Price-->
                        Price: £<?= $productDetails['price'] ?>
                    </h5>
                    <form action="basket.php" method="post" id="add-to-basket" class="form-horizontal,text-left">
                        <div class="form-group">
                            <label class="col-sm-12 control-label" for="quantity">Quantity: </label>
                            <div class="col-sm-12">
                                <!--Product Quantity-->
                                <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1" max="99" required />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <!--Add to basket button-->
                            <input type="submit" class="btn btn-secondary btn block" name="action" value="Add To Basket" required />
                            <input type="hidden" name="productID" value="<?= $productDetails['productID'] ?>" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        require('includes/site_footer.php');
    }


    // Populates the basket
    function populateBasket($productID, $quantity)
    {
        global $db;
        $sql = "SELECT productName, image, alt, price, description FROM product WHERE productID=" . mysqli_real_escape_string($db, $productID) . "";
        $result = mysqli_query($db, $sql);
        $productDetails = mysqli_fetch_assoc($result);
        $itemPrice = $productDetails['price'];
        $itemTotal =  $itemPrice * $quantity;


        if ($productDetails) {
        ?>
            <div class="row">
                <div class="col-md-3">
                    <img class="img-thumb" src="<?= $productDetails['image'] ?>" alt="<?= $productDetails['alt'] ?>">
                </div>
                <div class="col-md-6">
                    <h4>
                        <?= $productDetails['productName'] ?>
                    </h4>
                    <p>
                        <?= $productDetails['description'] ?>
                    </p>
                </div>
                <div class="col-md-3">

                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="quantity">Quantity: </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" name="update_<?= $productID ?>" value="<?= htmlspecialchars($quantity) ?>" min="1" max="99" required />

                            <b>Item Price:</b> £<?= $itemPrice ?> <br />
                            <b>Quantity:</b> <?= $quantity ?> <br />
                            <b>Item Total:</b> £<?= $itemTotal ?> <br />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-danger btn-block" name="delete" value="<?= $productID ?>">Delete
                            From Basket</button>
                    </div>
                </div>
            </div>
            <hr />
    <?php
        }
    }


    function UpdateBasket()
    {
        $products = array_keys($_SESSION['basket']);
        foreach ($products as $product) {
            $_SESSION['basket'][$product] = (int) $_POST['update_' . $product];
        }
    }


    // TODO: Demonstrate: 3B Name Validation
    function validProduct($name)
    {
        global $db;
        $sql = "SELECT productName FROM product WHERE productName = '" . mysqli_real_escape_string($db, $name) . "'";
        $result = mysqli_query($db, $sql);

        $product_details = mysqli_fetch_assoc($result);


        if ($product_details['productName'] != $name) {
            $productValid = true;
        } else {
            $productValid = false;
        }
        return $productValid;
    }

    // TODO: Demonstrate: 3C
    function validateFile()
    {
        $success = false;
        if ($_FILES and isset($_FILES['image']) and $_FILES['image']['name']) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];
            $type = $_FILES['image']['type'];

            list($width, $height) = getimagesize($_FILES['image']['tmp_name']);

            // TODO: Demonstrate: 3C
            if ($size > 4000000) {
                $success = "File is over 4mb. Please use a smaller file";
            } elseif (!in_array($type, array('image/gif', 'image/jpg', 'image/png', 'image/jpeg'))) {
                $success = "File is not a gif, jpeg, jpg, or png. Please use one of these file types";
            } elseif ($height > 500 and $width > 500) {
                $success = "File's height or width is over 500 px, please use a smaller file";
            } else {
                $success = true;
            }
        }
        return $success;
    }

    // TODO: Demonstrate: 3D - Function
    function addProduct($name, $description, $price)
    {
        global $db;
        $success = false;

        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        // TODO: Demonstrate: 3D - Move file
        move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'] . '/images/products/' . $filename);

        // TODO: Demonstrate: 3D - SQL Inejection protection
        $sql = "INSERT INTO product (productName, image, description, price)
                VALUES
                ('" . mysqli_real_escape_string($db, $name) . "', 'images/products/" . mysqli_real_escape_string($db, $filename) . "', '" . mysqli_real_escape_string($db, $description) . "', " . mysqli_real_escape_string($db, $price) . ");";

        if (mysqli_query($db, $sql)) {
            $success = true;
        }
        return $success;
    }



    ?>