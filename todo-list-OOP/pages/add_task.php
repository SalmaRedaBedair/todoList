<?php
ob_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/check_login.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/menu.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/submit.php');
$user_id = $_SESSION['id'];
?>

<body>
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
            <h1>Add New Task</h1>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>
                            <label for="name">Name:</label>
                        </td>
                        <td>
                            <input type="text" name="name" id="name" placeholder="Task Name">
                            <?php
                            message_underFields('name');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="start_date">Start Date:</label>
                        </td>
                        <td>
                            <input type="date" name="start_date" id="start_date">
                            <?php
                            message_underFields('start_date');
                            ?>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="end_date">End Date:</label>
                        </td>
                        <td>
                            <input type="date" name="end_date" id="end_date">
                            <?php
                            message_underFields('end_date');
                            ?>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="status">Status:</label>
                        </td>
                        <td>
                            <select name="status" id="status">
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                            </select>
                            <?php
                            message_underFields('status');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name='user_id' value="<?= $user_id ?>">
                            <input name="add_task" type="submit" class="btn btn-danger" value="Add Task">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>

</body>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/footer.php');

if (isset($_POST['add_task'])) {
    submit($_POST, 'task', 'add');
}
flush();
ob_end_flush();
?>