<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

    <div id="content">
        <?php if (isset($_SESSION['user'])): ?>
            <div id="welcome">
                <span>Welcome <?= $_SESSION['name'] ?></span>
            </div>
        <?php endif; ?>
        <h1>myBrackets - Temp</h1>
        <div class="contentArea">
            <div class="row">


            </div>
        </div>
    </div>

<?php require_once ('include/footer.php'); ?>