$('.phone').mask('+0 (000) 000-00-00');


$(".scroll").on('click', '[href*="#"]', function(e){
    var fixed_offset = 50;
    $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
    e.preventDefault();
});

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("scrollUp").style.display = "block";
    } else {
        document.getElementById("scrollUp").style.display = "none";
    }
}

jQuery(window).on('load', function() {
    jQuery('#loader').delay(1000).fadeOut();
});