
$('.slider__main').owlCarousel({
	// animateIn: 'fadeIn',
	// animateOut: 'fadeOut',
	margin: 7,
	nav: false,
	stagePadding:16,
	 navContainer: '.slider__navigation',
	 navText: ['<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 1.168l-6 6 6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>', '<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.168l6 6-6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
	dots: true,
	dotsContainer: '.slider__dots',
	loop: true,
	autoWidth: false,
	autoplay: true,
	autoplayTimeout: 6000,
	responsive: {
		0: {
			items: 1,
		},
		767: {
			items: 1
		},
		1024: {
			items: 1
		},
		1280: {
			items: 1
		}
	}
});

$('.slider__offer').owlCarousel({
	animateIn: 'fadeIn',
	animateOut: 'fadeOut',
	margin: 30,
	nav: true,
	navContainer: '.slider__navigation--offer',
	navText: ['<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 1.168l-6 6 6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>', '<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.168l6 6-6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
	dots: true,
	dotsContainer: '.slider__dots--offer',
	loop: true,
	autoWidth: false,
	autoplay: false,
	autoplayTimeout: 5000,
	responsive: {
		0: {
			items: 1,
		},
		767: {
			items: 1
		},
		1024: {
			items: 1
		},
		1280: {
			items: 1
		}
	}
});

$('.popular__list').owlCarousel({
	animateIn: 'fadeIn',
	animateOut: 'fadeOut',
	margin: 30,
	nav: true,
	navContainer: '.popular__navigation',
	navText: ['<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 1.168l-6 6 6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>', '<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.168l6 6-6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
	dots: false,
	loop: false,
	autoWidth: true,
	autoplay: false,
	autoplayTimeout: 5000,
	responsive: {
		0: {
			items: 2,
			autoWidth: false,
			margin: 0
		},
		767: {
			items: 3
		},
		1024: {
			items: 5
		},
		1280: {
			items: 5
		}
	}
});

$('.hits__list').owlCarousel({
	animateIn: 'fadeIn',
	animateOut: 'fadeOut',
	margin: 30,
	nav: true,
	navContainer: '.hits__navigation',
	navText: ['<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 1.168l-6 6 6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>', '<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.168l6 6-6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
	dots: false,
	loop: false,
	autoWidth: true,
	autoplay: false,
	autoplayTimeout: 5000,
	responsive: {
		0: {
			items: 2,
			autoWidth: false,
			margin: 0
		},
		767: {
			items: 3
		},
		1024: {
			items: 5
		},
		1280: {
			items: 5
		}
	}
});


$('.recomend__list').owlCarousel({
	animateIn: 'fadeIn',
	animateOut: 'fadeOut',
	margin: 30,
	nav: true,
	navContainer: '.recomend__navigation',
	navText: ['<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 1.168l-6 6 6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>', '<svg viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.168l6 6-6 6" stroke="#552FEC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
	dots: false,
	loop: false,
	autoWidth: true,
	autoplay: false,
	autoplayTimeout: 5000,
	responsive: {
		0: {
			items: 2,
			autoWidth: false,
			margin: 0
		},
		767: {
			items: 3
		},
		1024: {
			items: 5
		},
		1280: {
			items: 5
		}
	}
});




/*
$('#big').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '#thumbs',
    vertical: true,
    verticalSwiping: true,
    arrows: false,
    infinite: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          verticalSwiping: false,
          vertical: false
        }
      }
    ]
  });
  
  $('#thumbs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '#big',
    focusOnSelect: true,
    vertical: true,
    verticalSwiping: true,
    prevArrow: $('.card__prev'),
    nextArrow: $('.card__next'),
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToScroll: 1,
          slidesToShow: 3,
          verticalSwiping: false,
          vertical: false,
          dots:true,
          appendDots:$('.card__dots')
        }
      }
    ]
  });
  
  */


/*
  ymaps.ready(init);

  function init () {
      var myMap = new ymaps.Map("map-1", {
              center: [55.669494, 37.624530],
              zoom: 16,
              controls: ['zoomControl']
          });
  
      myPlacemark = new ymaps.Placemark([55.669518, 37.630472], {
  
      }, {
              iconLayout: 'default#image',
              iconImageHref: './images/pointer-map.svg',
              iconImageSize: [40, 40],
              iconImageOffset: [ -25, -30]
          });
  
   myMap.geoObjects.add(myPlacemark);
  
  }
*/