<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Muli" rel="stylesheet">
    <script src="https://use.fontawesome.com/1f7de7248c.js"></script>
    <link href="style/elements.css" rel="stylesheet" type="text/css" />
    <link href="style/main.css" rel="stylesheet" type="text/css" />
    <link href="style/content.css" rel="stylesheet" type="text/css" />
    <link href="style/responsive.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>-->
    <title>myBrackets</title>
</head>
<body>
<div id="sideBar">
    <nav>
        <div id="navItems">
            <a class="navLink" href="index.php">Home<i class="fa fa-home navIcon" aria-hidden="true"></i></a>
            <?php if (isset($_SESSION['user'])): ?>
                <a class="navLink" href="create.php">Create<i class="fa fa-plus navIcon" aria-hidden="true"></i></a>
                <a class="navLink" href="event.php">Event Test<i class="fa fa-bars fa-spin navIcon" aria-hidden="true"></i></a>
                <a class="navLink" href="signout.php">Logout<i class="fa fa-sign-out navIcon" aria-hidden="true"></i></a>
            <?php else: ?>
                <a class="navLink" href="signin.php">Login<i class="fa fa-sign-in navIcon" aria-hidden="true"></i></a>
                <a class="navLink" href="signup.php">Sign-Up<i class="fa fa-user-plus navIcon" aria-hidden="true"></i></a>
            <?php endif; ?>
        </div>
    </nav>
</div>
<div id="mainArea">
    <div id="headerArea">
        <div id="menuButton"><button id="menuToggle" class="button">Show Menu</button></div>
        <div id="mobileMenuButton"><i id="mobileMenuToggle" class="fa fa-bars fa-3x" aria-hidden="true"></i></div>
        <img src="image/myBrackets Logo 400w200h.png" alt="myBrackets Logo" title="myBrackets" id="logoImage" />
    </div>

            
