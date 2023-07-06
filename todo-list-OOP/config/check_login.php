<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/config/session_messages.php');
if(!isset($_SESSION['id'])){
    Message('error','login first.','login');
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/login.php');
    die();
}
?>