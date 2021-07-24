// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});

$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

var hashTagActive = "";
$(".scroll").on("click touchstart", function (event) {
  if (hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
    event.preventDefault();
    //calculate destination place
    var dest = 0;
    if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
      dest = $(document).height() - $(window).height();
    } else {
      dest = $(this.hash).offset().top;
    }
    //go to destination
    $('html,body').animate({
      scrollTop: dest
    }, 2000, 'swing');
    hashTagActive = this.hash;
  }
});

$(document).ready(function() {
  $('.carousel-news').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    nav: true,
    dots: false,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 3,
        loop: false,
        margin: 20
      }
    }
  })

  $('.carousel-partner').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    nav: true,
    dots: false,
    responsive: {
      0: {
        items: 3,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
        loop: false,
        margin: 20
      }
    }
  })
})