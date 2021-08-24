<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Other meta tags -->
    <title><?= "Chamoizon - " . $pageTitle ?></title>
    <meta name="Author" content="eeuab8@bangor.ac.uk" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Custom JavaScript -->
    <script src="js/script.js" type="text/javascript"></script>
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="index.php">Chamoizon.com</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <!-- <li class="nav-item active"> -->
                <!-- Add php to show active page -->
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-lg-0 navbar-right">
                <li><a class="nav-link" href="basket.php">Basket</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Account
                    </a>
                    <div class="dropdown-menu">
                        <?php


                        if(!isset($_SESSION['userID']) || empty($_SESSION['userID'])) 
                        {
                            ?>
                            <a class="dropdown-item" href="login.php">Sign In</a>
                            <a class="dropdown-item" href="registration.php">Register</a>
                            <?php
                        }else
                        {
                            ?>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                            <?php
                        }
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="main-body">
            <!--Title bar-->
            <div class="jumbotron" id="welcome">
                <h1 class="display-4">Chamoizon</h1>
                <hr class="my-4">
                <p class="lead">The number one stop for window cleaning equiptment</p>
            </div>
            <?php

            if (!$db) {
            ?>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="alert alert-danger">
                            <p><?= $db_error ?></p>
                        </div>
                    </div>
                </div>
            <?php
                require('includes/site_footer.php');
                exit;
            }

    // Displays success message in alert block if successful
    
    //print_r($_SESSION);

    if (isset($_GET['succ_msg'])) 
    {
        if($_GET['succ_msg'] == 4)
        {
            $alterType = "warning";
        }
        else if($_GET['succ_msg'] == 5)
        {
            $alterType = "danger";
        }
        else
        {
            $alterType = "success";
        }

        if ($_GET['succ_msg'] == 0)
        {
            $message = "You have successfully logged out.";
        }
        else if($_GET['succ_msg'] == 1)
        {
            $message = "You are already logged in ". $_SESSION['fName']."! :D";
        }
        else if($_GET['succ_msg'] == 2)
        {
            $message = "You have successfully logged in. Welcome " . $_SESSION['fName'];
        }
        if($_GET['succ_msg'] == 5)
        {
            $message = "Incorrect username or password";
        }
        if($_GET['succ_msg'] == 4)
        {
            $message = "You need to login!";
        }
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-<?=$alterType?>">
                    <p><?= $message ?></p>
                </div>
            </div>
        </div>
        <?php
    }
            ?>