<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('include/header.php'); ?>
<?php require_once ('controllers/admin_event_controller.php'); ?>

<?php
//echo '<pre>';
//var_dump($event);
//echo '</pre>';
?>

    <div id="content">
        <h1>myBrackets - Admin Event</h1>
        <div class="contentArea">
            <div class="row">
                <?php if (isset($_GET['r']) && isset($_GET['g'])): ?>
                    <h2></h2>

                    <?php
                        echo '<pre>';
                        var_dump($game);
//                        foreach ($game as $g) {
//                            var_dump($g);
//                        }
                        echo '</pre>';
                    ?>

                <?php elseif (isset($_GET['id'])): ?>
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
                                    <div class="player">
                                            <label for="player1"><?= $event['games'][$pos]['player1'] ?></label>
                                            <span><?= $event['games'][$pos]['score1'] ?></span>
                                    </div>
                                    <div class="player">
                                        <label for="player2"><?= $event['games'][$pos]['player2'] ?></label>
                                        <span><?= $event['games'][$pos]['score2'] ?></span>
                                    </div>
                                    <div class="playerButton">
                                        <form method="GET" action="admin_event.php">
                                            <input type="hidden" name="id" value="<?= $event['_id'] ?>">
                                            <input type="hidden" name="r" value="<?= $event['games'][$pos]['round'] ?>">
                                            <input type="hidden" name="g" value="<?= $event['games'][$pos]['game'] ?>">
                                            <button type="submit" ><i class="fa fa-pencil-square-o " aria-hidden="true"></i> Edit</button>
                                        </form>
                                    </div>
                                </div>
                                <?php $pos++; ?>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>

                <?php else: ?>
                    <table>
                        <tr>
                            <th>Event Name</th>
                            <th>Bracket Size</th>
                            <th>Last Updated</th>
                            <th>Edit</th>
                        </tr>
                    <?php foreach ($events as $ev): ?>
                        <h2>Manage your events here</h2>
                                    <tr>
                                        <td><?= $ev['event_name'] ?></td>
                                        <td><?= $ev['bracket_size'] ?></td>
                                        <td><?= $ev['last_update'] ?></td>
                                        <td>
                                            <form method="GET" action="admin_event.php">
                                                <input type="hidden" name="id" value="<?= $ev['_id'] ?>">
                                                <button type="submit" value="Edit"><i class="fa fa-pencil-square-o fa-fw fa-lg" aria-hidden="true"></i> Edit</button>
                                            </form>
                                        </td>
                                    </tr>
                    <?php endforeach; ?>
                    </table>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php require_once ('include/footer.php'); ?>