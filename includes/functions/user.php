<?php

// Returns bool of true or false for login usage
function login($emailEntered, $passwordEntered)
{
    global $db;
    $success = false;

    $sql = "SELECT customerID, password, fName, lName, email FROM customer where email='" . mysqli_real_escape_string($db, $emailEntered) . "'";
    $result = mysqli_query($db, $sql);
    $user_details = mysqli_fetch_assoc($result);


    if (isset($user_details['customerID'])) 
    {

        // TODO: Demonstrate: 1B
        $passwordSuccess = password_verify($passwordEntered, $user_details['password']);
        if ($passwordSuccess == true)
        {
            $success = true;
            // User's ID session variable
            $_SESSION['userID'] = $user_details['customerID'];
            $_SESSION['userEmail'] = $user_details['email'];
            $_SESSION['fName'] = $user_details['fName'];
            $_SESSION['lName'] = $user_details['lName'];
        }
    }

    return $success;
}

// Checks if email is already in use
function emailValid($email)
{
    global $db;
    $sql = "SELECT email, customerID FROM customer WHERE email = '" . mysqli_real_escape_string($db, $email) . "'"; // Add SQL injection prevention
    $result = mysqli_query($db, $sql);
    $user_details = mysqli_fetch_assoc($result);

    if ($user_details['email'] != $email) 
    {
        $emailValid = true;
    } 
    else 
    {
        $emailValid = false;
    }
    return $emailValid;
}

// Adds a user and their details 
function addCustomer($email, $password, $fName, $lName, $address)
{
    global $db;
    // TODO: Demonstrate: 1A
    $sql = "INSERT INTO customer (email, password, fName, lName, address) VALUES ('" . mysqli_real_escape_string($db, $email) . "', '" . mysqli_real_escape_string($db, password_hash($password, PASSWORD_DEFAULT)) . "', '" . mysqli_real_escape_string($db, $fName) . "', '" . mysqli_real_escape_string($db, $lName) . "' , '" . mysqli_real_escape_string($db, $address) . "')";
    $result = mysqli_query($db, $sql);
    return $result;
}



?>
