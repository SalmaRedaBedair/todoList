<?php 
define('SITEURL', 'http://localhost/helpers/todo-list-OOP/');
define('URL', $_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/');
require_once(URL . '/config/printSessionMessage.php'); // include start session
foreach (glob(URL . "/validation/*.php") as $filename) {
    require_once $filename;
}
require_once(URL . '/config/session_messages.php');
// dataBase default values
$_SESSION['user']=array(
    'name'=>"",
    'user_name'=>"",
    'password'=>"",
    'confirm_password'=>'',
    'deleted_tasks'=>""
);
$_SESSION['task']=array(
    'name'=>"",
    'start_date'=>date('Y-m-d'),
    'end_date'=>date('Y-m-d'),
    'status'=>'',
    'done'=>0,
    'user_id'=>0
);

?>