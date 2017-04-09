<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('controllers/profile_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

    <div id="content">
        <?php require_once ('include/welcome.php'); ?>
        <h1>myBrackets - Profile Page</h1>
        <div class="contentArea">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 discrete">
                    <h2 class="profileHeading"><?= $_SESSION['name'] ?></h2>
                    <br>
                    <form class="centerText" method="post" action="profile.php">
                        <input type="submit" value="Edit Profile">
                    </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 centerText">
                    <img src="profile/GF.jpg" class="profilePic">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-offset-lg-3 col-md-8 col-offset-md-2 col-sm-12">
                    <h2>Events You Participate</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-offset-lg-3 col-md-8 col-offset-md-2 col-sm-12">
                    <h2>Events You Administrate</h2>
                    <?php if ($admin != null): ?>
                    <table>
                        <tr>
                            <th>Event Name</th>
                            <th>Edit</th>
                        </tr>
                        <?php foreach ($admin as $ev): ?>
                            <tr>
                                <td><?= $ev['event_name'] ?></td>
                                <td>
                                    <form method="GET" action="admin_event.php">
                                        <input type="hidden" name="id" value="<?= $ev['_id'] ?>">
                                        <button type="submit" value="Edit"><i class="fa fa-pencil-square-o fa-fw fa-lg" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php else: ?>
                        <label>You are not administrating any events.</label>
                        <a href="create.php"><button>Create New Event</button></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once ('include/footer.php'); ?>