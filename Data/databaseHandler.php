<?php

//insert name of server here
$dbServername = "ec2-3-142-242-98.us-east-2.compute.amazonaws.com";
//database Username
$dbUsername = "root";
//database password
$dbPassword = "dAk!Z@1*BCd@";
//name of the data base
$dbName = "websiteDatabase";

//connection to database
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);