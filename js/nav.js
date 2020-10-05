var myNav = document.getElementById('navbar');
window.onscroll = function () { 
    "use strict";
    if (document.body.scrollTop >= 200 ) {
        myNav.classList.remove("navbar-dark");
        myNav.classList.add("navbar-light");
    } 
    else {
        myNav.classList.remove("navbar-light");
        myNav.classList.add("navbar-dark");
    }
};