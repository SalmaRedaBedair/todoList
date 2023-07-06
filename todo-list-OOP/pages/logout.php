<?php
session_start();
if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/login.php');
}

?>