<?php
session_start();
$conn = require_once($_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/config/connection.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/config/check_login.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->remove('task',$id);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/userpage.php');
}

?>