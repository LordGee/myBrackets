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
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2>About</h2>
                    <p>Many sports clubs around the world, organise tournament events. These tournaments ensure members
                        or participants, get the opportunity to play at a competitive level. This type of activity,
                        provides the players with a sense of achievement and encourages people to better themselves
                        within the sport. The majority of sports activities, provide a variety of events for their
                        members, such as elimination brackets, leader-boards or round-robins.</p>
                    <p>The problem, is that many organisations or venues, still present this information using
                        traditional methods, such as pen and paper or use spreadsheets to show current standings.
                        These methods can be very time consuming and provide an element of risk, for example, the piece
                        of paper could be lost or destroyed, or the spreadsheet file could become corrupt or get
                        deleted.</p>
                    <p>The solution I propose, is to create a web application, that will allow a user to create a
                        tournament bracket, that can be used by any age group, regardless of technical experience.
                        This should include clear and selective options, that allow for easy manipulation of an event.
                        Participants will be able to select and view desired events and historical achievements, via a
                        profile portal. The solution should be generic, enabling deployment into any custom website,
                        or independent operation, such as a standalone web application.</p>
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
