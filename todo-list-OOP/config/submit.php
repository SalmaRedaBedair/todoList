<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/menu.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/config.php');
$GLOBALS['conn'] = require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/connection.php');

function submit($data, $tablename, $type)
{
    foreach ($_SESSION["$tablename"] as $key => $value) {
        if (isset($_SESSION["$key"]))
            unset($_SESSION["$key"]);
        if (!isset($data["$key"])) {
            $data["$key"] = $value;
        }
        if ($key == 'name' || $key == 'user_name' || $key == 'status') {
            $data["$key"] = string_validation($GLOBALS['conn']->mysqli, $data["$key"], $key);
        } else if ($key == 'start_date' || $key == 'end_date') {
            date_validation($data["$key"], $key);
        } else if ($key == 'id' || $key == 'user_id' || $key == 'deleted_tasks' || $key == 'done') {
            $data["$key"] = number_validation($GLOBALS['conn']->mysqli, $data["$key"], $key);
        } else if ($key == 'password' || $key == 'confirm_password') {
            $data["$key"] = password_validation($GLOBALS['conn']->mysqli, $data["$key"], $key);
            $data["$key"] = md5($data["$key"]);
        }
        if ($key == 'status' && !($data["$key"] == 'In Progress' || $data["$key"] == 'Pending' || $data["$key"] == 'Time out')) {
            Message('error', 'Invalid data!!', 'database');
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/userpage.php');
            die();
        }
    }
    if ($tablename == 'user') {
        if (($type == 'add' || $type == 'update') && $_POST['password'] != $_POST['confirm_password']) {
            $_SESSION['confirm_password'] = 'Password not match';
        }
        if (($type == 'add' || $type == 'update')) {
            if (!isset($_SESSION['done']) && !isset($_SESSION['name']) && !isset($_SESSION['user_name']) && !isset($_SESSION['password']) && !isset($_SESSION['confirm_password'])) {
                if ($GLOBALS['conn'] instanceof Connection) {
                    if ($type == 'add') {
                        $GLOBALS['conn']->adduser($data);
                    } else if ($type == 'update') {
                        $GLOBALS['conn']->updateUser($data);
                    }
                    $typeUcwords = ucwords($type);
                    Message('success', "$typeUcwords Successfully.", 'login');
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/login.php');
                    die();
                } else {
                    $message = "Error in the connection with database, try to call the admin of the page!!";
                    Message('error', $message, 'database');
                }
            } else {
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/register.php');
                die();
            }
        } else if ($type == 'login' && !isset($_SESSION['user_name']) && !isset($_SESSION['password'])) {
            if ($GLOBALS['conn'] instanceof Connection) {
                if ($type == 'login') {
                    $user_name = $_POST['user_name'];
                    $password = $_POST['password'];
                    $data = $GLOBALS['conn']->getData('user', 'id', "user_name='$user_name' AND password='$password'");
                    if (count($data) > 0) {
                        $_SESSION['id'] = $data[0]['id'];
                        if (isset($_SESSION['id'])) {
                            Message('success', 'Login successfully', 'login');
                            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/');
                            die();
                        } else {
                            Message('error', 'Error!!', 'database');
                            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/login.php');
                            die();
                        }
                    } else {
                        Message('error', 'Username or password is not valid!!', 'database');
                        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/login.php');
                        die();
                    }
                }
            } else {
                $message = "Error in the connection with database, try to call the admin of the page!!";
                Message('error', $message, 'database');
            }
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/login.php');
            die();
        }
    } else {
        if (!isset($_SESSION['name']) && !isset($_SESSION['start_date']) && !isset($_SESSION['end_date'])) {
            if ($GLOBALS['conn'] instanceof Connection) {
                if ($type == 'add') {
                    $GLOBALS['conn']->addTask($data);
                } else if ($type == 'update') {
                    $GLOBALS['conn']->updateTask($data);
                }
                $typeUcwords = ucwords($type);
                Message('success', "$typeUcwords Successfully.", 'login');
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/userpage.php');
                die();
            } else {
                $message = "Error in the connection with database, try to call the admin of the page!!";
                Message('error', $message, 'database');
            }
        } else {
            $message = 'You should complete all data!!';
            Message('error', $message, 'database');
            if ($type == 'update') {
                $id=$data['id'];
                header('Location: http://' . $_SERVER['HTTP_HOST'] . "/helpers/todo-list-OOP/pages/update.php?id=$id");
                die();
            } else {
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/add_task.php');
                die();
            }

        }
    }
}
?>