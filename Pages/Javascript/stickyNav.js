window.onscroll = function() {makeSticky()};

var navbar = document.getElementById('my-nav');
var sticky = navbar.offsetHeight;
console.log(sticky);

function makeSticky(){
    console.log(window.pageYOffset);
    if(window.pageYOffset >= sticky ){
        navbar.classList.add("sticky");
    }
    else{
        navbar.classList.remove("sticky");
    }
}