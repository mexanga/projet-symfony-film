
const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    onLoad();
});


function onLoad() {
    const navbar = document.querySelector('.navbar');
    document.addEventListener('scroll', onScroll);
    onScroll(null);
    function onScroll (event) {
        const {scrollY} = window;
        const isTop = 0 === scrollY;
        if (isTop) {
            navbar.classList.remove('affix');
            return;
        }
        navbar.classList.add('affix');
    }

    const ham = document.querySelector('.ham');
    const navbarToggler = document.querySelector('.navbar-toggler');
    navbarToggler.addEventListener('click', navbarTogglerOnClick);
    function navbarTogglerOnClick (event) {
        navbar.classList.toggle('active');
        ham.classList.toggle('active');
    }

    $(document).ready(function(){
    });
}