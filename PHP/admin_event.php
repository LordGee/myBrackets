<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('include/header.php'); ?>
<?php require_once ('controllers/admin_event_controller.php'); ?>

<?php
echo '<pre>';
var_dump($event);
echo '</pre>';
?>

<?php
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>

    <div id="content">
        <h1>myBrackets - Admin Event</h1>
        <div class="contentArea">
            <div class="row">
                <h2>You made it!</h2>
                <div class="eventContainer">
                    <?php $size = $event['bracket_size']; ?>
                    <?php $pos = 0; ?>
                    <?php for ($r = 0; $r < $event['no_rounds']; $r++): ?>
                        <div class="round-<?= $r + 1 ?>">
                            <h4><?= $event['games'][$pos]['round_name'] ?> - <?= $r + 1 ?></h4>
                            <br>
                            <?php $size = $size / 2; ?>
                            <?php for ($g = 0; $g < $size; $g++): ?>
                                <div class="game-<?= $r + 1 ?>">
                                    <div class="player">
                                        <label for="player1"><?= $event['games'][$pos]['player1'] ?></label>
                                        <span><input type="number" min="0" max="99" name="p1" value="<?= $event['games'][$pos]['score1'] ?>" </span>
                                    </div>
                                    <div class="player">
                                        <label for="player2"><?= $event['games'][$pos]['player2'] ?></label>
                                        <span><input type="number" min="0" max="99" name="p2" value="<?= $event['games'][$pos]['score2'] ?>" </span>
                                    </div>
                                </div>
                                <?php $pos++; ?>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once ('include/footer.php'); ?>