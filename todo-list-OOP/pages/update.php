<?php
ob_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/check_login.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/menu.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/submit.php');
$user_id = $_SESSION['id'];
if (isset($_GET['id']))
    $id = $_GET['id'];
else {
    Message('error', 'Unauthorized Access!!', 'database');
    header('LOCATION:' . SITEURL);
}
$data = $GLOBALS['conn']->getById('task', $id);
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
            <h1>Update Task</h1>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>
                            <label for="name">Name:</label>
                        </td>
                        <td>
                            <input type="text" name="name" id="name" value="<?= $data['name'] ?>">
                            <?php
                            message_underFields('name');
                            ?>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="start_date">Start Date:</label>
                        </td>
                        <td>
                            <input type="date" name="start_date" id="start_date" value="<?= $data['start_date'] ?>">
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
                            <input type="date" name="end_date" id="end_date" value="<?= $data['end_date'] ?>">
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
                                <option value="Pending" <?php
                                if ($data['status'] == 'Pending')
                                    echo 'selected'
                                        ?>>Pending
                                    </option>
                                    <option value="In Progress" <?php
                                if ($data['status'] == 'In Progress')
                                    echo 'selected';
                                ?>>In Progress</option>
                                <option value="Time out" <?php if ($data['status'] == 'Time out')
                                    echo 'selected';
                                ?>>Time out</option>
                            </select>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="done" type="hidden" name="done" value=<?= $data['done'] ?>>
                            <input type="hidden" name='user_id' value="<?= $user_id ?>">
                            <input type="hidden" name='id' value="<?= $id ?>">
                            <input name="update_task" type="submit" class="btn btn-danger" value="Update Task">
                            <br>
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>

</body>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/footer.php');

if (isset($_POST['update_task'])) {
    if ($_POST['update_task'] != 'Update Task' || !($_POST['status'] == 'Pending' || $_POST['status'] == 'In Progress' || $_POST['status'] == 'Completed' || $_POST['status'] == 'Time out')) {
        Message('error', 'Invalid data', 'database');
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/userpage.php');
        die();
    } else {
        submit($_POST, 'task', 'update');
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/userpage.php');
        die();
    }

}
flush();
ob_end_flush();
?>