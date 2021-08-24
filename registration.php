<?php
$pageTitle = "Register";
require('includes/application_top.php');
require('includes/site_header.php');

$defaultEmail = "";
$defaultFName = "";
$defaultLName = "";
$defaultAddress = "";

$emailValid = false;
$error_message = false;

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
                    // Trim whitespace from start and end and assign to username variable
                    $email = trim($_POST["email"]);
                    $fName = trim($_POST['fName']);
                    $lName = trim($_POST['lName']);
                    $address = trim($_POST['address']);
                    $password = ($_POST['password']);
                    
                    $defaultEmail = htmlspecialchars($email);
                    $defaultFName = htmlspecialchars($fName);
                    $defaultLName = htmlspecialchars($lName);
                    $defaultAddress = htmlspecialchars($address);

                    $emailValid = emailValid($email);

                    if($emailValid)
                    {
                        $success = addCustomer($defaultEmail, $password, $defaultFName, $defaultLName, $defaultAddress);
                        if(!$success)
                        {
                            $error_message = "There was an error adding " . $defaultEmail . " to the database";
                        }
                        $success_message = "Success! " . $defaultEmail ." has been registered";
                    }
                    else
                    {
                        $error_message = "A user already exists for the email address " . $defaultEmail;
                    }
                }
                // Displays success message in alert block if successful
                if ($emailValid) 
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
                    if ($error_message) 
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

                <form method="post" id="registration_form" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="email">Email Address: </label>
                        <div class="col-sm-12">
                            <!--Email-->
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="myemail@email.com" maxlength="255" value="<?= $defaultEmail ?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="password">Password: </label>
                        <div class="col-sm-12">
                            <!--Password-->
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" maxlength="128" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="fName">First Name: </label>
                        <div class="col-sm-12">
                            <!--First name-->
                            <input type="text" class="form-control" name="fName" id="fName" placeholder="First name"
                                maxlength="128" value="<?=$defaultFName?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="lName">Last Name: </label>
                        <div class="col-sm-12">
                            <!--Last Name-->
                            <input type="text" class="form-control" name="lName" id="lName" placeholder="Last Name"
                                maxlength="128" value="<?=$defaultLName?>" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="address">Address: </label>
                        <div class="col-sm-12">
                            <!--Address-->
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="House name/number, street name, city, postcode" maxlength="512" value="<?=$defaultAddress?>" required />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <!--Registration button-->
                        <input type="submit" class="btn btn-primary btn-block" name="action" value="Register" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/site_footer.php');
?>