<?php
// TODO: Task 2
// This is a duplicated registration form that encrypts everything submitted.
// Decrypt.php is the page that will show all decrypted info in the db
require('includes/classes/encryption.php');

$unencryptedText = '';

// TODO: Demonstrate: Task 2
$encryptedText = new Encryption($db, $unencryptedText, $key);

$pageTitle = "Encrypt to Database";
require('includes/application_top.php');
require('includes/site_header.php');

$success = false;

$error_message = false;

?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Encrypt To Database</h2>
            </div>
            <div class="panel-body">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    // Trim whitespace from start and end and assign to username variable
                    $unencryptedText = $_POST["unencryptedText"];

                    $encryptedText->unencryptedText = $unencryptedText;

                    $encryptionSuccess = $encryptedText->encrypt();
                    $encryptedText->decrypt($encryptedText->cipherText);
                    // If encrypt succeeds:
                    if ($encryptionSuccess) 
                    {
                        // Add encrypted text to database
                        $success = $encryptedText->addTextEncrypted();
                        if (!$success) 
                        {
                            $error_message = "There was an error adding the text to the database";
                        }
                        $success_message = "Success! The following has been encrypted and added to the database: <br/>" . $encryptedText->unencryptedText;
                    } 
                    else 
                    {
                        $error_message = "There was an error encrypting the details :-/";
                    }
                }
                // Displays success message in alert block if successful
                if ($success) 
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
                        <label class="col-sm-12 control-label" for="unencryptedText">Text To Encrypt: </label>
                        <div class="col-sm-12">
                            <!--Email-->
                            <input type="text" class="form-control" name="unencryptedText" id="unencryptedText"
                                placeholder="Type some text to encrypt" maxlength="255" required />
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