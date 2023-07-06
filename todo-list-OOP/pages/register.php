<!DOCTYPE html>
<html>

<head>
  <title>My Page</title>
  <link rel="stylesheet"
    href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/helpers/todo-list-OOP/css/login&registerForms.css' ?>">
</head>

<body>
  <div class="container">
    <form method="post" action="">
      <h2>Register</h2>
      <?php
      require_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/todo-list-OOP/config/submit.php');
      ?>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name">
      <?php
      message_underFields('name');
      ?>
      <br>
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
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password">
      <?php
      message_underFields('confirm_password');
      ?>
      <br>
      <input type="submit" value="Register" name="submit">
    </form>
    <br>
    <p>Already have an account? <a href="login.php">Login here</a></p>
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
  submit($_POST, 'user', 'add');
}
?>