<?php
session_start();
if(empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 'true') {
    header('Location: index.php');
}

if (isset($_GET['id'])) {
    include 'db_connection.php';

    DeleteService($_GET['id']);

    header("Location: http://localhost:63342/htdocs/index.php");
    exit();
}
?>