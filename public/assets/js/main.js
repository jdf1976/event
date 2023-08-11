
(function ($) {
  'use strict'


  // Sticky menu
  var $window = $(window)
  $window.on('scroll', function () {
    var scroll = $window.scrollTop()
    if (scroll < 300) {
      $('.sticky').removeClass('is-sticky')
    } else {
      $('.sticky').addClass('is-sticky')
    }
  })

  // Off Canvas Open close
  $('.mobile-menu-btn').on('click', function () {
    $('body').addClass('fix')
    $('.off-canvas-wrapper').addClass('open')
  })

  $('.btn-close-off-canvas,.off-canvas-overlay').on('click', function () {
    $('body').removeClass('fix')
    $('.off-canvas-wrapper').removeClass('open')
  })

  // offcanvas mobile menu
  var $offCanvasNav = $('.mobile-menu')

  var $offCanvasNavSubMenu = $offCanvasNav.find('.dropdown')

  /* Add Toggle Button With Off Canvas Sub Menu */
  $offCanvasNavSubMenu
    .parent()
    .prepend('<span class="menu-expand"><i></i></span>')

  /* Close Off Canvas Sub Menu */
  $offCanvasNavSubMenu.slideUp()

  /* Category Sub Menu Toggle */
    $offCanvasNav.on('click', 'li a, li .menu-expand', function (e) {
        var $this = $(this)
        if (
        $this
        .parent()
        .attr('class')
        .match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
        ($this.attr('href') === '#' || $this.hasClass('menu-expand'))
        ) {
            e.preventDefault()
            if ($this.siblings('ul:visible').length) {
                $this.parent('li').removeClass('active')
                $this.siblings('ul').slideUp()
            } else {
                $this.parent('li').addClass('active')
                $this
                .closest('li')
                .siblings('li')
                .removeClass('active')
                .find('li')
                .removeClass('active')
                $this
                .closest('li')
                .siblings('li')
                .find('ul:visible')
                .slideUp()
                $this.siblings('ul').slideDown()
            }
        }
    })

    // hero slider active js
    $('.hero-slider-active').slick({
        speed: 1000,
        slidesToShow: 1,
        autoplay: false,
        arrows: false,
        dots: true
    })

    // service item carousel active js
    $('.service-item-carousel').slick({
        speed: 1000,
        slidesToShow: 3,
        autoplay: false,
        arrows: false,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]
	})
	
	// work gallery item carousel active js
    $('.work-gallery-active').slick({
        speed: 1000,
        slidesToShow: 3,
        autoplay: false,
        arrows: true,
		adaptiveHeight: true,
		prevArrow: '<button type="button" class="slick-prev"></button>',
		nextArrow: '<button type="button" class="slick-next"></button>',
		appendArrows: ".slick-append",
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]
    })

    // brand logo carousel active js
    $('.blog-post-carousel').slick({
        speed: 1000,
        slidesToShow: 3,
        autoplay: false,
        arrows: true,
        adaptiveHeight: true,
        prevArrow: '<button type="button" class="slick-prev"></button>',
		nextArrow: '<button type="button" class="slick-next"></button>',
		appendArrows: ".slick-append",
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]
    })

    // testimonial carousel active js
    $('.testimonial-active').slick({
        speed: 1000,
        slidesToShow: 1,
        autoplay: false,
        arrows: false
    })

    $('.testimonial-active__style-2').slick({
        speed: 1000,
        slidesToShow: 1,
        arrows: true,
        appendArrows: '.testimonial2-custom-nav',
        prevArrow: '<button type="button" class="slick-prev"></button>',
		nextArrow: '<button type="button" class="slick-next"></button>',
    })

    // gallery carousel active js
    $('.gallery-active').slick({
        speed: 1000,
        arrows: false,
        centerMode: true,
        centerPadding: '200px',
        slidesToShow: 3,
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 1
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                centerPadding: 0
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                centerPadding: 0
            }
        }]
    })

    // team carousel active js
    $('.team-active').slick({
        speed: 1000,
        slidesToShow: 3,
        arrows: true,
        appendArrows: '.testimonial2-custom-nav',
        prevArrow: '<button type="button" class="slick-prev"></button>',
		nextArrow: '<button type="button" class="slick-next"></button>',
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]
	})

  // Background Image JS start
  var bgSelector = $('.bg-img')
  bgSelector.each(function (index, elem) {
    var element = $(elem)

    var bgSource = element.data('bg')
    element.css('background-image', 'url(' + bgSource + ')')
  })


  // Counter Up JS
  $('.odometer').each(function () {
    $(this).appear(function () {
      var $this = $(this)

      var $dataValue = $this.data('count')

      setTimeout(function () {
        $this.html($dataValue)
      }, 1000)
    })
  })

  
  // Scroll to top active js
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 600) {
      $('.scroll-top').removeClass('not-visible')
    } else {
      $('.scroll-top').addClass('not-visible')
    }
  })
  $('.scroll-top').on('click', function (event) {
    $('html,body').animate({
        scrollTop: 0
      },
      1000
    )
  })


  // wow js active
  new WOW().init()

})(jQuery)