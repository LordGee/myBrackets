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
            <div class="inputItem">
                <input type="hidden" name="code" value="addBasic">
                <input type="submit" value="Add Players">
            </div>
        </form>
        <br/>

        <h2>Add Players</h2>
        <form method="post" action="create.php">
            <div class="inputItem">
                <div class="inputWrap">
                    <span class="inputIcon inputParticipant"><i class="fa fa-user fa-fw fa-lg" aria-hidden="true"></i> 1</span>
                    <input type="text" name="e_name[]" placeholder="Enter the participants name">
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once ('include/footer.php'); ?>
