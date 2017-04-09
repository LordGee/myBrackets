<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once('controllers/view_event_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

<?php
//    echo '<pre>';
//    var_dump($event);
//    echo '</pre>';
?>

<div id="content">
    <?php require_once ('include/welcome.php'); ?>
        <h1>Events Page</h1>
    <div class="contentArea">
        <?php if (isset($_GET['eid'])): ?>
            <h2><?= $event['event_name'] ?></h2>
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
                                <div class="players">
                                    <?php if ($event['games'][$pos]['score1'] != $event['games'][$pos]['score2']): ?>
                                        <div class="player <?= ($event['games'][$pos]['score1'] > $event['games'][$pos]['score2']) ? "won" : "lost"  ?>">
                                    <?php else: ?>
                                        <div class="player">
                                    <?php endif; ?>
                                            <label for="player1"><?= $event['games'][$pos]['player1'] ?></label>
                                        </div>
                                    <?php if ($event['games'][$pos]['score1'] != $event['games'][$pos]['score2']): ?>
                                        <div class="player <?= ($event['games'][$pos]['score2'] > $event['games'][$pos]['score1']) ? "won" : "lost"  ?>">
                                    <?php else: ?>
                                        <div class="player">
                                    <?php endif; ?>
                                        <label for="player2"><?= $event['games'][$pos]['player2'] ?></label>
                                    </div>
                                </div>
                                <div class="scores">
                                    <div class="score <?= ($event['games'][$pos]['score1'] > $event['games'][$pos]['score2']) ? "scoreWon" : ""  ?>">
                                        <span><?= $event['games'][$pos]['score1'] ?></span>
                                    </div>
                                    <div class="score <?= ($event['games'][$pos]['score2'] > $event['games'][$pos]['score1']) ? "scoreWon" : ""  ?>">
                                        <span><?= $event['games'][$pos]['score2'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php $pos++; ?>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once ('include/footer.php'); ?>
