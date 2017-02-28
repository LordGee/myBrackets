<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('controllers/create_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

<?php
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
?>


<div id="content">
    <h1>Create New Event</h1>
    <div class="contentArea">

        <?php if (!isset($_SESSION['e_step']) || $_SESSION['e_step'] == 1): ?>
        <h2>Step 1 - Basic Details</h2>
        <form method="post" action="create.php">
            <div class="inputItem">
                <label for="e_name">Event Name : </label>
                <div class="inputWrap">
                    <span class="inputIcon"><i class="fa fa-trophy fa-fw fa-lg" aria-hidden="true"></i></span>
                    <input type="text" name="e_name" <?= (isset($_SESSION['e_step'])) ? "value='" . $_SESSION['e_name'] . "'" : "" ?> placeholder="Enter the name of your event" required>
                </div>
            </div>
            <div class="inputItem">
                <label for="e_description">Event Description : </label>
                <div class="inputWrap">
                    <span class="inputIcon"><i class="fa fa-pencil-square-o fa-fw fa-lg" aria-hidden="true"></i></span>
                    <textarea name="e_description" <?= (isset($_SESSION['e_step'])) ? "value='" . $_SESSION['e_name'] . "'" : "" ?> placeholder="Describe your event" rows="10"></textarea>
                </div>
            </div>
            <div class="inputItem">
                <input type="hidden" name="code" value="addBasic">
                <input type="submit" value="Add Players">
            </div>
        </form>
        <br/>
        <?php elseif (isset($_SESSION['e_step']) && $_SESSION['e_step'] == 2): ?>
        <h2>Step 2 - Add Players</h2>
        <form method="post" action="create.php">
            <div class="inputItem">
                <label for="e_pname">Player 1 - Name & Email : </label>
                <div class="inputWrap count">
                    <span class="inputIcon inputParticipant"><i class="fa fa-user fa-fw fa-lg" aria-hidden="true"></i> 1</span>
                    <input type="text" name="e_pname[]" placeholder="Enter the participants name" required>
                </div>
                <div class="inputWrap">
                    <span class="inputIcon inputParticipant"><i class="fa fa-envelope-o fa-fw fa-lg" aria-hidden="true"></i> 1</span>
                    <input type="email" name="e_email[]" placeholder="Enter the participants email">
                </div>
                <br>
                <div id="next"></div>
                <span class="button" id="addPlayer"><i class="fa fa-plus fa-fw fa-lg" aria-hidden="true"></i> Add Another Player</span>
                <br><br><br>
                <div class="inputItem">
                    <input type="hidden" name="code" value="addParticipants">
                    <input type="submit" value="Confirm Players">
                </div>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript" src="js/addAnotherPlayer.js"></script>

<?php require_once ('include/footer.php'); ?>
