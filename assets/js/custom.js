// ===== Scroll to Top ====
$(window).scroll(function () {
  if ($(this).scrollTop() >= 50) {
    // If page is scrolled more than 50px
    $('#return-to-top').fadeIn(200) // Fade in the arrow
  } else {
    $('#return-to-top').fadeOut(200) // Else fade out the arrow
  }
})

$('#return-to-top').click(function () {
  // When arrow is clicked
  $('body,html').animate(
    {
      scrollTop: 0 // Scroll to top of body
    },
    500
  )
})

$('.scroll').on('click touchstart', function (event) {
  let hashTagActive = ''
  if (hashTagActive != this.hash) {
    //this will prevent if the user click several times the same link to freeze the scroll.
    event.preventDefault()
    //calculate destination place
    let dest = 0
    if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
      dest = $(document).height() - $(window).height()
    } else {
      dest = $(this.hash).offset().top
    }
    //go to destination
    $('html,body').animate(
      {
        scrollTop: dest
      },
      2000,
      'swing'
    )
  }
})

$(document).ready(function () {
  // slick home carousel
  $('.center').slick({
    centerMode: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    variableWidth: true,
    prevArrow: "<button type='button' class='slick-prev pull-left'></button>",
    nextArrow: "<button type='button' class='slick-next pull-right'></button>",
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          slidesToShow: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          slidesToShow: 2
        }
      }
    ]
  })
})
