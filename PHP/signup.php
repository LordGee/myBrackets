<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('controllers/user_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

<?php
//    echo '<pre>';
//    var_dump($_POST);
//    echo '</pre>';
?>


    <div id="content">
        <h1>Create Account</h1>
        <div class="result">
            <span class="error"><?= $error ?></span>
            <span class="message"><?= $message ?></span>
        </div>
        <br>
        <div class="contentArea">
            <form method="post" action="signup.php">
                <div class="inputItem">
                    <label for="name">Your Name : </label>
                    <div class="inputWrap">
                        <span class="inputIcon"><i class="fa fa-user fa-fw fa-lg" aria-hidden="true"></i></span>
                        <input type="name" name="name" placeholder="Enter your name" required>
                    </div>
                </div>
                <div class="inputItem">
                    <label for="email">Email Address : </label>
                    <div class="inputWrap">
                        <span class="inputIcon"><i class="fa fa-envelope-o fa-fw fa-lg" aria-hidden="true"></i></span>
                        <input type="email" name="email" placeholder="Enter your email address here" required>
                    </div>
                </div>
                <div class="inputItem">
                    <label for="pass1">Enter Password : </label>
                    <div class="inputWrap">
                        <span class="inputIcon"><i class="fa fa-key fa-fw fa-lg" aria-hidden="true"></i></span>
                        <input type="password" name="pass1" placeholder="Enter your desired password" required>
                    </div>
                </div>
                <div class="inputItem">
                    <label for="pass2">Re-enter Password : </label>
                    <div class="inputWrap">
                        <span class="inputIcon"><i class="fa fa-key fa-fw fa-lg" aria-hidden="true"></i></span>
                        <input type="password" name="pass2" placeholder="Re-enter your desired password" required>
                    </div>
                </div>
                <div class="inputItem">
                    <input type="hidden" name="code" value="registration">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>

<?php require_once ('include/footer.php'); ?>