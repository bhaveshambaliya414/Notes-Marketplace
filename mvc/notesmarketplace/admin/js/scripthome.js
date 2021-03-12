/* ============================================
           login
===============================================*/

$(".toggle-password").click(function () {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});


/* =======================================================================
                Navigation
======================================================================= */
$(function () {

    // on page load
    showHideNav();

    $(window).scroll(function () {
        showHideNav();
    });

    function showHideNav() {
        if ($(window).scrollTop() > 50) {
            // show white navigation
            $('nav').addClass("white-nav-top");
            // logo
            $(".navbar-brand img").attr("src", "./images/Logos/top-logo-white.png");
        } else {
            // hide white navigation
            $('nav').removeClass("white-nav-top");
            $(".navbar-brand img").attr("src", "./images/Logos/top-logo-white.png");

        }
    }

});

/* =======================================================================
                Mobile Navigation
======================================================================= */
$(function () {
    // show
    $("#mobile-nav-open-btn").click(function () {
        $("#mobile-nav").css("height", "100%");
        $("#mobile-nav-open-btn").css("display", "none");
    });
    // hide
    $("#mobile-nav-close-btn, #mobile-nav a").click(function () {
        $("#mobile-nav").css("height", "0%");
        $("#mobile-nav-open-btn").css("display", "block");
    });
});