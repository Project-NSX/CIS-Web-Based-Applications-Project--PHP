<?php
// Config contains debug state
require("includes/configure.php");
require("includes/functions/database.php");
require("includes/functions/user.php");
require("includes/functions/page.php");


session_start();

@$db = connect();

if (DEBUG) 
{
    // Show full error reporting if DEBUG is on
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // If there is an error with MySQL connection to Database..
    if (mysqli_connect_error()) 
    {
        // Echo error message and error
        $db_error = 'Cannot connect to database: ' . mysqli_connect_error();
    }
} 
else 
{
    // Set errors to not display
    ini_set('display_errors', 0);
    // If site cannot connect to database
    if (mysqli_connect_error()) 
    {
        $db_error = "Error connecting to Database. Please try again. If the error persists, please contact theman@thebrokenwebsite.com";
    }
}
?>
