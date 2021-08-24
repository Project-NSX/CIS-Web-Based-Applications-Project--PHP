<?php
// TODO: Task 2
// This is a duplicated registration form that encrypts everything submitted.
// Encrypt.php is the page that allows users to encrypt text and save it to the database

require('includes/classes/encryption.php');
$unencryptedText = '';

// TODO: Demonstrate: Task 2
$encryptedText = new Encryption($db, $unencryptedText, $key);

$pageTitle = "Decrypt From Database";
require('includes/application_top.php');
require('includes/site_header.php');

$success = false;

$error_message = false;

?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Decrypt from Database</h2>
            </div>
            <div class="panel-body">
                <?php
                // Get results from DB
                $queryResult = $encryptedText->readText();

                // Loop through results, decrypt them, and print the encrypted and decrypted versions of them
                while ($row = mysqli_fetch_assoc($queryResult)) 
                {
                    echo "<b>Encrypted:</b> ";
                    echo $row['encryptedText'];

                    echo "<br/><b>Unencrypted:</b> ";
                    echo $encryptedText->decrypt($row['encryptedText']);
                    echo "<br/><br/>";
                }

                ?>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/site_footer.php');
?>