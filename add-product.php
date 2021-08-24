<?php
$pageTitle = "Register";
require('includes/application_top.php');
require('includes/site_header.php');

// TODO: Demonstrate

$defaultName = "";
$defaultDescription = "";
$defaultPrice = "";


?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Register</h2>
            </div>
            <div class="panel-body">
                <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    // TODO: Demonstrate 3B (More in page.php)

                    // Trim whitespace from start and end and assign to username variable
                    $name = trim($_POST["name"]);
                    $description = trim($_POST['description']);
                    $price = trim($_POST['price']);
                    $image = $_FILES['image'];

                    // TODO: Demonstrate: 3E - Field repopulation
                    $defaultName = htmlspecialchars($name);
                    $defaultDescription = htmlspecialchars($description);
                    $defaultPrice = htmlspecialchars($price);

                    // TODO: Demonstrate 3B (Name validation)
                    $validProduct = validProduct($defaultName);


                    if ($validProduct == true) 
                    {
                        $validFile = validateFile();
                        if($validFile === true)
                        {
                            $success = addProduct($name, $description, $price);
                            
                            if(!$success)
                            {
                                $error_message = "There was an error adding " . $defaultName . " to the database";
                            }
                            else
                            {
                                $defaultName = "";
                                $defaultDescription = "";
                                $defaultPrice = "";
                                $success_message = "Success! " . $defaultName ." has been added";
                            }
                        }
                        else
                        {
                            // TODO: Demonstrate: 3E
                            $error_message = $validFile;
                        }
                    }
                    else
                    {
                        // TODO: Demonstrate: 3E
                        $error_message = "A product with that name already exists:  " . $defaultName;
                    }

                }
                // TODO: Demonstrate: 3E
                // Displays success message in alert block if successful
                if (isset($success) and $success == true) 
                {
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <p><?= $success_message ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                } 
                else 
                {
                    if (isset($error_message)) 
                    {
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger">
                                    <p><?php echo $error_message ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <!-- TODO: Demonstrate 3A 3B --> 
                <form method="post" id="registration_form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="name">Product name: </label>
                        <div class="col-sm-12">
                            <!--Name-->
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Please enter the name of the product" maxlength="128" value="<?= $defaultName ?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="description">Description: </label>
                        <div class="col-sm-12">
                            <!--Description-->
                            <input type="text" class="form-control" name="description" id="description"
                                placeholder="Please enter a description for the product" value="<?= $defaultDescription ?>" maxlength="512" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="price">Product price in £: </label>
                        <div class="col-sm-12">
                            <!--Price-->
                            <input type="number" class="form-control" name="price" id="price" placeholder="0"
                                min="0.01" step="0.01" value="<?=$defaultPrice?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="image">Image: </label>
                        <div class="col-sm-12">
                            <!--Image-->
                            <input type="file" class="form-control" name="image" id="image" required />
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <!--Registration button-->
                        <input type="submit" class="btn btn-primary btn-block" name="action" value="AddProduct" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/site_footer.php');
?>