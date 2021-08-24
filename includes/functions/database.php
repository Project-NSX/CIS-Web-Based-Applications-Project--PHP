<?php

function connect()
{
    $config = parse_ini_file('includes/config.ini');
    @$db = mysqli_connect(
    $config['host'],
    $config['username'],
    $config['password'],
    $config['dbname']);
    return $db;
}
?>