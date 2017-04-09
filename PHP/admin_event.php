<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('include/header.php'); ?>
<?php require_once ('controllers/admin_event_controller.php'); ?>

<?php
//echo '<pre>';
//foreach ($users as $u) {
//    var_dump($u);
//}
//var_dump($users);
//echo '</pre>';
?>

    <div id="content">
        <?php require_once ('include/welcome.php'); ?>
        <h1>Admin Event</h1>
        <div class="contentArea">
            <div class="row">
                <?php if (isset($_GET['r']) && isset($_GET['g'])): ?>
                    <h2><?= $game['round_name'] ?> <?= $game['round'] ?> - Game <?= $game['game'] ?></h2>
                    <h3><?= $game['player1'] ?> VS <?= $game['player2'] ?></h3>
                    <form method="post" action="admin_event.php">
                        <div class="inputItem discrete">
                            <label for="score1"><?= $game['player1'] ?> : <button type="button" onclick="player1edit();">Edit Name</button></label>
                            <input type="hidden" name="player1" class="player1name" value="<?= $game['player1'] ?>">
                            <br><br>
                            <div class="inputWrap">
                                <span class="inputIcon"><i class="fa fa-user fa-fw fa-lg" aria-hidden="true"></i></span>
                                <input type="number" name="score1" min="0" max="99" step="1" value="<?= $game['score1'] ?>">
                            </div>
                        </div>
                        <br>
                        <div class="inputItem discrete">
                            <label for="score2"><?= $game['player2'] ?> : <button type="button" onclick="player2edit();">Edit Name</button></label>
                            <input type="hidden" name="player2" class="player2name" value="<?= $game['player2'] ?>">
                            <br><br>
                            <div class="inputWrap">
                                <span class="inputIcon"><i class="fa fa-user fa-fw fa-lg" aria-hidden="true"></i></span>
                                <input type="number" name="score2" min="0" max="99" step="1" value="<?= $game['score2'] ?>">
                            </div>
                        </div>
                        <div class="inputItem">
                            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                            <input type="hidden" name="gid" value="<?= $game['id'] ?>">
                            <input type="hidden" name="round" value="<?= $game['round'] ?>">
                            <input type="hidden" name="round_name" value="<?= $game['round_name'] ?>">
                            <input type="hidden" name="game" value="<?= $game['game'] ?>">
                            <input type="hidden" name="code" value="updateScore">
                            <input type="submit" value="Update Score">
                            <a href="admin_event.php?id=<?= $_GET['id'] ?>"><button type="button" value="Cancel">Cancel</button></a>
                        </div>
                    </form>
                    <script src="js/editPlayerName.js" type="text/javascript"></script>
                <?php elseif (isset($_POST['iCode']) && $_POST['iCode'] == 'admin' || $_POST['iCode'] == 'addAdmins'): ?>
                    <h2><?= $_POST['event'] ?></h2>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-offset-lg-2 col-offset-md-2">
                            <h2>Current Administrators</h2>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-offset-lg-2 col-offset-md-2">
                            <h4>Add Administrators to This Event</h4>
                            <form method="post" action="admin_event.php">
                                <label>Select Users Name</label>
                                <br>
                                <select name="newAdmins[]" class="select2User" multiple="multiple">
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['name'] ?>"><?= $user['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br><br>
                                <input type="hidden" name="iCode" value="addAdmins">
                                <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                                <input type="submit" value="Add Admins">
                            </form>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(".select2User").select2();
                    </script>
                <?php elseif (isset($_GET['id'])): ?>
                <h2><?= $event['event_name'] ?>
                    <form method="post" action="admin_event.php">
                        <input type="hidden" name="iCode" value="admin">
                        <input type="hidden" name="event" value="<?= $event['event_name'] ?>">
                        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                        <input type="submit" value="Add Admins">
                    </form>
                </h2>
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
                                        <div class="player">
                                            <label for="player1"><?= $event['games'][$pos]['player1'] ?></label>
                                        </div>
                                        <div class="player">
                                            <label for="player2"><?= $event['games'][$pos]['player2'] ?></label>
                                        </div>
                                    </div>
                                    <div class="scores">
                                        <div class="score">
                                            <span><?= $event['games'][$pos]['score1'] ?></span>
                                        </div>
                                        <div class="score">
                                            <span><?= $event['games'][$pos]['score2'] ?></span>
                                        </div>
                                    </div>
                                    <?php if ($event['games'][$pos]['player1'] != null && $event['games'][$pos]['player2'] != null): ?>
                                    <div class="playerButton discrete">
                                        <form method="GET" action="admin_event.php">
                                            <input type="hidden" name="id" value="<?= $event['_id'] ?>">
                                            <input type="hidden" name="r" value="<?= $event['games'][$pos]['round'] ?>">
                                            <input type="hidden" name="g" value="<?= $event['games'][$pos]['game'] ?>">
                                            <input type="hidden" name="gid" value="<?= $event['games'][$pos]['id'] ?>">
                                            <button type="submit" ><i class="fa fa-pencil-square-o " aria-hidden="true"></i> Edit</button>
                                        </form>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php $pos++; ?>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>

                <?php else: ?>
                    <h2>Manage your events here</h2>
                    <table>
                        <tr>
                            <th>Event Name</th>
                            <th>Bracket Size</th>
                            <th>Last Updated</th>
                            <th>Edit</th>
                        </tr>
                    <?php foreach ($events as $ev): ?>
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