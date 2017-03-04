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
                    <h2><?= $game['games'][0]['round_name'] ?> <?= $game['games'][0]['round'] ?> - Game <?= $game['games'][0]['game'] ?></h2>
                    <h3><?= $game['games'][0]['player1'] ?> VS <?= $game['games'][0]['player2'] ?></h3>
                    <form method="post" action="admin_event.php">
                        <div class="inputItem">
                            <label for="score1"><?= $game['games'][0]['player1'] ?> : </label>
                            <div class="inputWrap">
                                <span class="inputIcon"><i class="fa fa-user fa-fw fa-lg" aria-hidden="true"></i></span>
                                <input type="number" name="score1" min="0" max="99" step="1" value="<?= $game['games'][0]['score1'] ?>">
                            </div>
                        </div>
                        <div class="inputItem">
                            <label for="score2"><?= $game['games'][0]['player2'] ?> : </label>
                            <div class="inputWrap">
                                <span class="inputIcon"><i class="fa fa-user fa-fw fa-lg" aria-hidden="true"></i></span>
                                <input type="number" name="score2" min="0" max="99" step="1" value="<?= $game['games'][0]['score2'] ?>">
                            </div>
                        </div>
                        <div class="inputItem">
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <input type="hidden" name="gid" value="<?= $game['games'][0]['id'] ?>">
                            <input type="hidden" name="code" value="updateScore">
                            <input type="submit" value="Update Score">
                            <a href="admin_event.php?id=<?= $_GET['id'] ?>"><button type="button" value="Cancel">Cancel</button></a>
                        </div>
                    </form>

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