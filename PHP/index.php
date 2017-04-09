<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('controllers/index_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

<?php
//echo '<pre>';
//var_dump($events);
//echo '</pre>';
?>

    <div id="content">
        <?php require_once ('include/welcome.php'); ?>
        <h1>myBrackets - Home</h1>
        <div class="contentArea">
            <h2>About</h2>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <p>Blah Blah Blah</p>
                </div>
            </div>
        </div>
        <br/>
        <div class="contentArea">
            <h2>Recently update events</h2>
            <div class="row">
                <?php foreach ($events as $event): ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 border">
                        <div class="recEvent">
                            <h3><?= $event['event_name'] ?></h3>
                            <?php $subD = substr($event['event_description'], 0, 100); ?>
                            <i>"<?= $subD ?>..."</i>
                            <p>Bracket Size = <?= $event['bracket_size'] ?> <br>Last Updated :<br><?= date("jS F Y - G:i", strtotime($event['last_update'])) ?></p>
                        </div>
                        <div class="gotoEvent">
                            <a href="event.php?eid=<?= $event['_id'] ?>"><button>Go To Event</button></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

<?php require_once ('include/footer.php'); ?>
