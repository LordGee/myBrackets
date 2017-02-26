<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('controllers/user_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

<?php
    echo '<pre>';
    var_dump($user);
    var_dump($_SESSION);
    echo '</pre>';
?>


    <div id="content">
        <h1>Login</h1>
        <div class="result">
            <span class="error"><?= $error ?></span>
            <span class="message"><?= $message ?></span>
        </div>
        <br>
        <div class="contentArea">
            <form method="post" action="signin.php">
                <div class="inputItem">
                    <label for="email">Email Address : </label>
                    <div class="inputWrap">
                        <span class="inputIcon"><i class="fa fa-envelope-o fa-fw fa-lg" aria-hidden="true"></i></span>
                        <input type="email" name="email" placeholder="Enter your email address here" required>
                    </div>
                </div>
                <div class="inputItem">
                    <label for="pass">Enter Password : </label>
                    <div class="inputWrap">
                        <span class="inputIcon"><i class="fa fa-key fa-fw fa-lg" aria-hidden="true"></i></span>
                        <input type="password" name="pass" placeholder="Enter your password" required>
                    </div>
                </div>
                <div class="inputItem">
                    <input type="hidden" name="code" value="login">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>

<?php require_once ('include/footer.php'); ?>