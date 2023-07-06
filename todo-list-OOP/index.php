<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/config/check_login.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/config/submit.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/partials/menu.php');
// echo $_SESSION['id'];
// die();
?>

<body>
    <!-- menu section starts -->
    <div class="menu">
        <div class="wrapper">
            <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/userpage.php' ?>" class="menu-item">
                <i class="fas fa-tasks"></i>
                <span>Tasks</span>
            </a>
            <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/logout.php' ?>" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
    <!-- menu section ends -->

    <div class="main-contet">
        <div class="wrapper">

            <h1>Dashboard</h1>
            <br>
            <br>
            <?php
            $data = $conn->getData('user', 'id');
            foreach ($data as $key => $value) {
                $name = $value['name'];
                $deleted_tasks = $value['deleted_tasks'];
                $id=$value['id'];
                $tasks=$conn->getData('task','start_date',"user_id=$id");
                $numberOfTasks=count($tasks);
                $tasks=$conn->getData('task','start_date',"user_id=$id AND status='done'");
                $doneTasks=count($tasks);
                $notdone=$numberOfTasks-$doneTasks;
                ?>
                <div>
                    <h2 class="text-center link"><?=$name?></h2>
                    <div class="col-4 text-center">
                        <h2><?=$numberOfTasks?></h2>
                        <br />
                        Added Tasks
                    </div>
                    <div class="col-4 text-center">
                        <h2><?=$deleted_tasks?></h2>
                        <br />
                        Deleted Tasks
                    </div>
                    <div class="col-4 text-center">
                        <h2><?=$doneTasks?></h2>
                        <br />
                        Done Tasks
                    </div>
                    <div class="col-4 text-center">
                        <h2><?=$notdone?></h2>
                        <br />
                        Not done yet
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
            }
            ?>


        </div>
    </div>

    <?php
  include_once($_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/partials/footer.php');
    ?>