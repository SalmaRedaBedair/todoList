<?php
if (isset($_SESSION['id'])) {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/');
  die();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>My Page</title>
  <link rel="stylesheet"
    href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/css/login&registerForms.css' ?>">
</head>

<body>
  <div class="container">
    <form action='' method="post">
      <h2>Login</h2>
      <?php
      require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/submit.php');
      ?>
      <label for="user_name">user_name:</label>
      <input type="text" id="user_name" name="user_name">
      <?php
      message_underFields('user_name');
      ?>
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
      <?php
      message_underFields('password');
      ?>
      <br>
      <input type="submit" value="Login" name='submit'>
    </form>
    <br>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var closeButton = document.querySelector(".close");
      closeButton.addEventListener("click", function () {
        var Messages = document.querySelectorAll(".error, .success");
        Messages.forEach(function (Message) {
          Message.parentNode.removeChild(Message);
        });
      });
    });
    document.addEventListener("DOMContentLoaded", function () {
      var closeButton = document.querySelector(".close");
      closeButton.addEventListener("click", function () {
        var errorMessage = document.querySelector(".error");
        errorMessage.parentNode.removeChild(errorMessage);
      });
    });
    // Get all menu items
    const menuItems = document.querySelectorAll('a');

    // Loop through each menu item
    menuItems.forEach(item => {
      // Add event listener for click
      item.addEventListener('click', () => {
        // Remove session variables
        <?php
        foreach ($_SESSION["user"] as $key => $value) {
          if (isset($_SESSION["$key"])) {
            unset($_SESSION["$key"]);
          }
        }
        foreach ($_SESSION["task"] as $key => $value) {
          if (isset($_SESSION["$key"])) {
            unset($_SESSION["$key"]);
          }
        }
        ?>
      });
    });
  </script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
  submit($_POST, 'user', 'login');
}
?>