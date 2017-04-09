<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('controllers/search_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

<?php
//    echo '<pre>';
//    var_dump($result);
//    echo '</pre>';
?>

    <div id="content">
        <?php require_once ('include/welcome.php'); ?>
        <h1>myBrackets - Search Page</h1>
        <div class="contentArea">
            <div class="row">
                <div class="col-lg-6 col-offset-lg-3 col-md-8 col-offset-md-2 col-sm-12">
                    <form method="get" action="search.php">
                        <h2>Search Events</h2>
                        <input type="text" name="search" placeholder="Search Events">
                        <br>
                        <input type="submit" value="Search">
                    </form>
                </div>
            </div>
            <?php if (isset($_GET['search']) && $_GET['search'] != "" && $result != null): ?>
                <div class="row">
                    <div class="col-lg-6 col-offset-lg-3 col-md-8 col-offset-md-2 col-sm-12">
                        <table>
                            <tr>
                                <th>Event Name</th>
                                <th>View</th>
                            </tr>
                            <?php foreach ($result as $ev): ?>
                                <tr>
                                    <td><?= $ev['event_name'] ?></td>
                                    <td>
                                        <form method="GET" action="event.php">
                                            <input type="hidden" name="eid" value="<?= $ev['_id'] ?>">
                                            <button type="submit" value="View"><i class="fa fa-eye fa-fw fa-lg" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php require_once ('include/footer.php'); ?>