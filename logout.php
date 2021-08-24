<?php
session_start();
unset($_SESSION['userID']);
unset($_SESSION['userEmail']);
unset($_SESSION['fName']);
unset($_SESSION['lName']);
unset($_SESSION['readyForCheckout']);
$succ_msg = 0;
header('Location: index.php?succ_msg=' . $succ_msg);
exit;
