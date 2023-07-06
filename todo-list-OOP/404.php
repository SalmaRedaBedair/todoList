<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/menu.php');
?>

<body>
    <div class="menu">
        <div class="wrapper">
            <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/' ?>" class="menu-item">
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

    <div class="main-content">
        <div class="wrapper text-center">
            <h1>404 Not Found</h1>
            <p>The requested URL was not found on this server.</p>
            <p>Go back to the <a href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/' ?>"><i
                        class="fas fa-arrow-left"></i> Main page</a></p>
        </div>
    </div>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/partials/footer.php');
    ?>
</body>
