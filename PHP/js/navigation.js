﻿
(function () {
    var $sidebarAndWrapper = $("#sideBar,#mainArea,#menuButton, #mobileMenuButton");
    $("#menuToggle").on("click",
        function () {
            $sidebarAndWrapper.toggleClass("hide-sidebar");
            if ($sidebarAndWrapper.hasClass("hide-sidebar")) {
                $(this).text("Hide Menu");
                $("#mobileMenuToggle").removeClass("fa fa-bars fa-3x");
                $("#mobileMenuToggle").addClass("fa fa-times fa-spin fa-3x");
            } else {
                $(this).text("Show Menu");
                $("#mobileMenuToggle").removeClass("fa fa-times fa-spin fa-3x");
                $("#mobileMenuToggle").addClass("fa fa-bars fa-3x");
            }
        });
})();

(function () {
    var $sidebarAndWrapper = $("#sideBar,#mainArea,#mobileMenuButton, #menuButton");
    $("#mobileMenuToggle").on("click",
        function () {
            $sidebarAndWrapper.toggleClass("hide-sidebar");
            if ($sidebarAndWrapper.hasClass("hide-sidebar")) {
                $("#menuToggle").text("Hide Menu");
                $(this).removeClass("fa fa-bars fa-3x");
                $(this).addClass("fa fa-times fa-spin fa-3x");
            } else {
                $("#menuToggle").text("Show Menu");
                $(this).removeClass("fa fa-times fa-spin fa-3x");
                $(this).addClass("fa fa-bars fa-3x");
            }
        });
})();