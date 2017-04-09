<?php if (isset($_SESSION['user'])): ?>
    <div id="welcome">
        <span id="welcomeMessage">Welcome <a href="profile.php"><?= $_SESSION['name'] ?></a></span>
        <span id="welcomeSearch">Search <button type="button" onclick="searchToggle()"><i class="fa fa-search fa-1x" aria-hidden="true"></i></button></span>
        <div class="searchBox">
            <form method="get" action="search.php">
                <button type="submit"><i class="fa fa-search fa-1x" aria-hidden="true"></i></button>
                <input type="text" name="search" placeholder="Search Events">
                <button type="button" onclick="searchToggle()"><i class="fa fa-times fa-1x" aria-hidden="true"></i></button>
            </form>
        </div>
    </div>
<?php endif; ?>