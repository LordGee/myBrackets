<?php require_once ('controllers/main_controller.php'); ?>
<?php require_once ('include/header.php'); ?>

<div id="content">
    <h1>Create New Event</h1>
    <div class="contentArea">
        <h2>Step 1 - Basic Details</h2>
        <form method="post" action="create.php">
            <div class="inputItem">
                <label for="e_name">Event Name : </label>
                <div class="inputWrap">
                    <span class="inputIcon"><i class="fa fa-trophy fa-fw fa-lg" aria-hidden="true"></i></span>
                    <input type="text" name="e_name" placeholder="Enter the name of your event" required>
                </div>
            </div>
            <div class="inputItem">
                <label for="e_description">Event Description : </label>
                <div class="inputWrap">
                    <span class="inputIcon"><i class="fa fa-pencil-square-o fa-fw fa-lg" aria-hidden="true"></i></span>
                    <textarea name="e_description" placeholder="Describe your event" rows="10"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once ('include/footer.php'); ?>
