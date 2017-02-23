﻿
(function () {
    var $sidebarAndWrapper = $("#sideBar,#mainArea,#menuButton");
    $("#menuToggle").on("click",
        function () {
            $sidebarAndWrapper.toggleClass("hide-sidebar");
            if ($sidebarAndWrapper.hasClass("hide-sidebar")) {
                $(this).text("Show Menu");
            } else {
                $(this).text("Hide Menu");
            }
        });
})();