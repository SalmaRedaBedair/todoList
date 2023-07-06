<?php
ob_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/helpers/todo-list-OOP/config/check_login.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/menu.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/submit.php');
$user_id = $_SESSION['id'];
$data = $GLOBALS['conn']->getById('user', $user_id);
$rows = $GLOBALS['conn']->getData('task', 'start_date', "user_id=$user_id"); // print_r($rows); // die(); 
foreach ($rows as $row) {
    $task_data['id']=$row['id'];
    if ($row['start_date'] <= date('Y-m-d')) { 
        if ($row['end_date'] >= date('Y-m-d')) {
            $task_data['status'] = 'In Progress';
        } else {
            $task_data['status'] = 'Time out';
        }
    } else {
        $task_data['status'] = 'Pending';
    }
    $GLOBALS['conn']->updateTask($task_data);
}
?>

<body>
<div class="menu">
  <div class="wrapper">
    <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/' ?>" class="menu-item">
      <i class="fas fa-home"></i>
      <span>Home</span>
    </a>
    <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/logout.php' ?>" class="menu-item">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </div>
</div>

    <div class="main-content">
        <div class="wrapper">
            <h1>Welcome
                <?= ucwords($data['name']) ?> ❤️
            </h1>
            <br>
            <br>
            <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/add_task.php' ?>"
                class="btn btn-primary">Add Task</a>
            <br>
            <br>
            <h2><u>My tasks:</u></h2>
            <form id='my-form' method="post">
                <table>

                    <?php
                    foreach ($rows as $row) {
                        ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="id-<?= $row['id'] ?>" value="<?= $row['id'] ?>">
                                    <input class="done" type="hidden" name="done-<?= $row['id'] ?>" value=<?= $row['done'] ?>>
                                    <input class="checkbox" type="checkbox" id="checkbox-<?= $row['id'] ?>"
                                        data-task-id="<?= $row['id'] ?>" <?php
                                          if ($row['done'] == 1)
                                              echo 'checked' ?>>

                                    </td>
                                    <td>
                                        <label for="checkbox-<?= $row['id'] ?>" class="label <?php
                                          if ($row['status'] == 'Pending')
                                              echo 'not-started';
                                          else if ($row['status'] == 'Time out')
                                              echo 'time-out';
                                          if ($row['done'])
                                              echo ' deleted-text'
                                                  ?>"> <?= $row['name'] ?></label>
                                </td>
                                <td>
                                    <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/delete.php?id=' . $row['id'] ?>"
                                        class="btn btn-danger">Delete</a>
                                    <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/update.php?id=' . $row['id'] ?>"
                                        class="btn btn-primary">Update</a>
                                </td>
                            </tr>
                        <?php
                    }
                    ?>

                </table>
                <input type="submit" class='btn btn-secondary' value='save' name='submit'>
            </form>
        </div>
    </div>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/footer.php');
    if (isset($_POST['submit'])) {
        // print_r($_POST);
        // die;
        foreach ($_POST as $key => $value) {
            if ($key[0] == 'i' && $key[1] == 'd') {
                $data = array('id' => $value, 'done' => $_POST["done-$value"]);
                $GLOBALS['conn']->updateTask($data);
            }
        }
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/pages/userpage.php');
    }
    flush();
    ob_end_flush()
        ?>