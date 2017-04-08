<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

    <div id="content">
        <?php if (isset($_SESSION['user'])): ?>
            <div id="welcome">
                <span>Welcome <?= $_SESSION['name'] ?></span>
            </div>
        <?php endif; ?>
        <h1>myBrackets - Profile Page</h1>
        <div class="contentArea">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <h2 class="profileHeading"><?= $_SESSION['name'] ?></h2>
                    <br>
                    <form method="post" action="profile.php">
                        <input type="submit" value="Edit Profile">
                    </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 discrete profilePic">
                    <img src="profile/GF.jpg" class="profilePic">
                </div>

            </div>
        </div>
    </div>

<?php require_once ('include/footer.php'); ?>