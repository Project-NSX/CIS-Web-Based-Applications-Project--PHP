<?php
$pageTitle = "Login";
require('includes/application_top.php');
require('includes/site_header.php');

?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Login</h2>
            </div>
            <div class="panel-body">
                <?php

                // Redirects user to home page if they're logged in
                if (isset($_SESSION['userID'])) {
                    $succ_msg = 1;
                    header('Location: index.php?succ_msg=' . $succ_msg);
                    exit;
                }

                $success = false;
                $error_message = false;

                $defaultEmail = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    // Trim whitespace from start and end and assign to username variable
                    $emailEntered = trim($_POST["email"]);
                    $passwordEntered = $_POST["password"];
                    // Evaluates to true or false
                    $success = login($emailEntered, $passwordEntered);
                    // Storage for entered username
                    $defaultUN = htmlspecialchars($emailEntered);
                    

                    if ($success) 
                    {
                        if (isset($_SESSION['readyForCheckout'])) 
                        {
                            if ($_SESSION['readyForCheckout'] == false) {
                                $succ_msg = 2;
                                $_SESSION['readyForCheckout'] = true;
                                header('Location: checkout.php?succ_msg=' . $succ_msg);
                                exit;
                            }
                        } 
                        else 
                        {
                            if ($success) 
                            {
                                $succ_msg = 2;
                                header('Location: index.php?succ_msg=' . $succ_msg);
                                exit;
                            } 
                        }
                    }
                    else 
                    {
                        $succ_msg = 5;
                        header('Location: login.php?succ_msg=' . $succ_msg);
                        exit;
                    }
                }
                
            // If error message exists. This only runs if success is false and error_message is true
            // Displays error message in error block.

                    ?>

                <!--Login form - Only displays if user has not successfully logged in-->
                <form method="post" action="login.php" id="login_form" class="form horizontal">
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="email">Email Address: </label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="greatest@windowcleaner.com" maxlength="100" value="<?= $defaultEmail ?>"
                                required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label" for="username">Password: </label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" maxlength="50" required />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-primary btn-block" name="action" value="Login" />
                    </div>
                </form>
                <?php
                
                ?>
            </div>
        </div>
    </div>
</div>
<?php
require('includes/site_footer.php');
?>