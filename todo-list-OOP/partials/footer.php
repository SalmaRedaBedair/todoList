<!-- footer section starts -->
<div class="footer">
    <div class="wrapper">
        <p class="text-center">
            2023, Todo-list, Developed by - <a href="https://www.linkedin.com/in/salma-r-bedair-252878221/" class="link"
                target="_blank" style="color:white"> loma </a>
        </p>
    </div>
</div>
<!-- footer section ends -->
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

    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("click", function () {
            var statusInput = checkbox.parentElement.querySelector("i");
            var label = checkbox.parentElement.parentElement.querySelector(".label");
            statusInput.value = checkbox.checked ? 1 : 0;
            if (checkbox.checked) {
                label.classList.add("deleted-text");
            } else {
                label.classList.remove("deleted-text");
            }
        });
    });
    // Get all menu items
    const menuItems = document.querySelectorAll('.menu-item');

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