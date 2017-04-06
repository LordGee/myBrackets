<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('controllers/create_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

<?php
//    echo '<pre>';
//    var_dump($_SESSION);
//    var_dump($_POST);
//    echo '</pre>';
?>


<div id="content">
    <h1>Create New Event</h1>
    <div class="contentArea">
        <?php if (!isset($_SESSION['e_step']) || $_SESSION['e_step'] == 1): ?>
        <h2>Step 1 - Basic Details</h2>
        <form method="post" action="create.php">
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 col-offset-md-1 col-offset-lg-2">
                    <label for="e_name">Event Name : </label>
                    <div class="inputWrap">
                        <span class="inputIcon"><i class="fa fa-trophy fa-fw fa-lg" aria-hidden="true"></i></span>
                        <input type="text" name="e_name" <?= (isset($_SESSION['e_step'])) ? "value='" . $_SESSION['e_name'] . "'" : ""; ?> placeholder="Enter the name of your event" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 col-offset-md-1 col-offset-lg-2">
                    <label for="e_description">Event Description : </label>
                    <div class="inputWrap">
                        <span class="inputIcon"><i class="fa fa-pencil-square-o fa-fw fa-lg" aria-hidden="true"></i></span>
                        <textarea name="e_description" placeholder="Describe your event" rows="10"><?= (isset($_SESSION['e_step'])) ? $_SESSION['e_description'] : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="inputItem">
                        <input type="hidden" name="code" value="addBasic">
                        <input type="submit" value="Add Players">
                    </div>
                </div>
            </div>
        </form>
        <br/>
        <?php elseif (isset($_SESSION['e_step']) && $_SESSION['e_step'] == 2): ?>
        <h2>Step 2 - Add Players</h2>
            <h3>Event - <?= $_SESSION['e_name'] ?></h3>
        <form method="post" action="create.php">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
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
                </div>

                <div id="next"></div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <button class="button" type="button" id="addPlayer"><i class="fa fa-plus fa-fw fa-lg" aria-hidden="true"></i> Add Another Player</button>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <button class="button" type="button" id="removePlayer"><i class="fa fa-times fa-fw fa-lg" aria-hidden="true"></i> Remove Last Player</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <input type="hidden" name="code" value="addParticipants">
                    <button type="submit" name="btn" value="Confirm Players"><i class="fa fa-check fa-fw fa-lg" aria-hidden="true"></i> Confirm Players</button>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <button type="submit" name="btn" value="Cancel"><i class="fa fa-ban fa-fw fa-lg" aria-hidden="true"></i> Cancel</button>
                </div>
            </div>
        </form>
        <?php elseif (isset($_SESSION['e_step']) && $_SESSION['e_step'] == 3): ?>
            <h2>Step 3 - Manage Player Positions</h2>
            <h3>Event - <?= $_SESSION['e_name'] ?></h3>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 centerText">
                    <h5>No. Players = <?= $_SESSION['e_pcount'] ?></h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 centerText">
                    <h5>Bracket Size = <?= $_SESSION['e_bsize'] ?></h5>
                </div>
            </div>
            <div class="row">
                <form method="POST" id="orderPlayers" action="create.php">
                    <?php $g = 1 ?>
                    <?php $pos = 1 ?>
                    <?php for ($i = 0; $i < count($_SESSION['e_pname']); $i++): ?>
                        <div class="col-lg-8 col-md-10 col-sm-12 col-offset-md-1 col-offset-lg-2 centerText">
                            <h5>Game <?= $g ?></h5>
                            <table>
                                <tr>
                                    <th>Position <?= $pos ?> - </th>
                                    <td>
                                        <select class="select" form="orderPlayers" name="e_order[]">
                                            <option value="not" selected>Choose Player</option>
                                            <?php for ($j = 0; $j < count($_SESSION['e_pname']); $j++): ?>
                                                <option value="<?= $j ?>" ><?= $_SESSION['e_pname'][$j] ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Position <?= $pos + 1 ?> - </th>
                                    <td>
                                        <select class="select" form="orderPlayers" name="e_order[]">
                                            <option value="not" selected>Choose player</option>
                                            <?php for ($j = 0; $j < count($_SESSION['e_pname']); $j++): ?>
                                                <option value="<?= $j ?>" ><?= $_SESSION['e_pname'][$j] ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php $i++; ?>
                        <?php $g++; ?>
                        <?php $pos = $pos + 2; ?>
                    <?php endfor; ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 centerText">
                            <p id="genMessage"></p>
                            <input type="hidden" name="code" value="generate">
                            <input type="submit" id="gen" value="Generate Event" disabled>
                        </div>
                    </div>

                </form>
            </div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript" src="js/manageMultipleIdenticalComboBoxes.js"></script>
<script type="text/javascript" src="js/addAnotherPlayer.js"></script>

<?php require_once ('include/footer.php'); ?>
