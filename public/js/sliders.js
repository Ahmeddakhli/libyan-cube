

// ( SLIDERS)

// BANNER SLIDER (GALLERY) OPTIONS

var sliderGallery = {
  speed: 500,
  slidesToShow: 1,
  slidesToScroll: 1,
  pauseOnHover: false,
  dots: true,
  rtl: is_rtl ? true : false,
  appendDots: $(".slider__navigation"),
  customPaging: function (slider, i) {
    var slideNumber = (00 + i + 1),
      totalSlides = slider.slideCount;
    return `
                <button>
                    00${slideNumber}
                </button>
                <span class='slash'> / </span>
                <span class='total'>00${totalSlides}</span> `
  },
  pauseOnDotsHover: true,
  cssEase: 'linear',
  fade: true,
  asNavFor: ".slider__thumbnails",
  prevArrow: '<button class="PrevArrow"><img src="img/icons/left-chevron.png"></button>',
  nextArrow: '<button class="NextArrow"><img src="img/icons/right-chevron.png"></button>',
};

// BANNER SLIDER OPTIONS (Thumbnails Options)

var sliderThumbnails = {
  speed: 500,
  slidesToShow: 3,
  dots: false,
  rtl: is_rtl ? true : false,
  arrows: false,
  slidesToScroll: 1,
  pauseOnHover: false,
  cssEase: 'linear',
  centerMode: true,
  focusOnSelect: true,
  asNavFor: ".slider__gallery"
};

// Play & Pause BANNER SLIDER Controllers Buttons
$('.slider__navigation .Play').on('click', function () {
  $(this).toggleClass('is-played')
  if ($(this).hasClass('is-played')) {
    $('.slider__gallery').slick('slickPlay')
    $(this).find('#play-icon').attr('name', 'pause-outline')
  } else {
    $('.slider__gallery').slick('slickPause')
    $(this).find('#play-icon').attr('name', 'play-outline')
  }
});

// Show & Hide Thumbnails Button
$(".slider__navigation .thumbnails").click(function () {
  $(this).toggleClass('is-open');
  $(".slider__thumbnails").toggleClass("slider__thumbnails--ShowThum");
  if ($(this).hasClass('is-open')) {
    $(this).find('ion-icon').attr('name', 'close-outline')
  } else {
    $(this).find('ion-icon').attr('name', 'folder-open-outline')
  }
});

$(".slider__navigation .toggle-nav").click(function () {
  $('.slider__navigation').toggleClass('open')
  $('.slider__thumbnails').toggleClass('open')
  if ($('.slider__navigation').hasClass('open') && $('.slider__thumbnails').hasClass('open')) {
    $(this).find('ion-icon').attr('name', 'close-outline')
  } else {
    $(this).find('ion-icon').attr('name', 'menu-outline')
  }
});

// -----------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------

// HOME PROJECTS SLICK SLIDER OPTIONS

var homeProjectsSlider = {
  speed: 1000,
  slidesToShow: 3,
  slidesToScroll: 1,
  dots: true,
  rtl: is_rtl ? true : false,
  customPaging: function (slider, i) {
    var slideNumber = (00 + i + 1),
      totalSlides = slider.slideCount;
    return `
                <button>
                    00${slideNumber}
                </button>
                <span class='slash'> / </span>
                <span class='total'>00${totalSlides}</span> `
  },
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
  responsive: [{
    breakpoint: 1200,
    settings: {
      slidesToShow: 2,
    }
  }, {
    breakpoint: 650,
    settings: {
      slidesToShow: 1,
    }
  }]
};

// HOME UNITS SLICK SLIDER OPTIONS

var homeUnitsSlider = {
  speed: 1000,
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  rtl: is_rtl ? true : false,
  prevArrow: '<button class="PrevArrow"><img src="img/icons/left-chevron.png"></button>',
  nextArrow: '<button class="NextArrow"><img src="img/icons/right-chevron.png"></button>',
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
      }
    }, {
      breakpoint: 991,
      settings: {
        slidesToShow: 2,
      }
    }, {
      breakpoint: 575,
      settings: {
        slidesToShow: 1,
      }
    }]
};

// HOME BLOGS SLICK SLIDER OPTIONS

var homeBlogsSlider = {
  autoplay: true,
  pauseOnDotsHover: true,
  speed: 1000,
  slidesToShow: 4,
  slidesToScroll: 1,
  dots: false,
  rtl: is_rtl ? true : false,
  prevArrow: '<button class="PrevArrow"><img src="img/icons/left-chevron.png"></button>',
  nextArrow: '<button class="NextArrow"><img src="img/icons/right-chevron.png"></button>',
  responsive: [{
    breakpoint: 1200,
    settings: {
      slidesToShow: 3,
    }
  }, {
    breakpoint: 991,
    settings: {
      slidesToShow: 2,
    }
  }, {
    breakpoint: 650,
    settings: {
      slidesToShow: 1,
    }
  }]
};

// HOME CLIENTS SLICK SLIDER OPTIONS

var homeClientsSlider = {
  autoplay: true,
  pauseOnDotsHover: true,
  speed: 1000,
  slidesToShow: 2,
  slidesToScroll: 1,
  dots: true,
  rtl: is_rtl ? true : false,
  arrows: false,
  responsive: [{
    breakpoint: 991,
    settings: {
      slidesToShow: 1,
    }
  }]
};

// HOME TOP CLIENTS SLICK SLIDER OPTIONS

var homeTopClientSlider = {
  // autoplay: true,
  pauseOnDotsHover: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: true,
  rtl: is_rtl ? true : false,
  arrows: false
};

// INDEX PROPERTY SLICK SLIDER OPTIONS

var ipBox__slider = {
  autoplay: true,
  pauseOnDotsHover: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: true,
  rtl: is_rtl ? true : false,
  customPaging: function (slider, i) {
    var totalSlides = slider.slideCount;
    return `
                <ion-icon name="videocam-sharp"></ion-icon>
                <span class='total'>
                    ${totalSlides}
                </span>  `
  },
  arrows: true,
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
};

// -------------------------------------------------------------------------
// -------------------------------------------------------------------------

//  SINGLE PROPERTY THUMBNAIL SLIDER OPTIONS

var spSliderFor = {
  slidesToShow: 1,
  slidesToScroll: 1,
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
  dots: true,
  rtl: is_rtl ? true : false,
  customPaging: function (slider, i) {
    var slideNumber = (i + 1),
      totalSlides = slider.slideCount;
    return `
                <button>
                    ${slideNumber}
                </button>
                <span class='total'>${totalSlides}</span> `
  },
  fade: true,
  asNavFor: '.sp-slider-nav',
};

var spSliderNav = {
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.sp-slider-for',
  dots: false,
  rtl: is_rtl ? true : false,
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
  centerMode: true,
  focusOnSelect: true,
  responsive: [{
    breakpoint: 450,
    settings: {
      slidesToShow: 2,
    }
  }]
};

var frontSlider = {
  speed: 500,
  slidesToShow: 1,
  dots: false,
  rtl: is_rtl ? true : false,
  prevArrow: '<button class="PrevArrow">&larr;</button>',
  nextArrow: '<button class="NextArrow">&rarr;</button>',
  slidesToScroll: 1,
  pauseOnHover: false,
  waitForAnimate: true,
  cssEase: 'linear',
  fade: true,
  focusOnSelect: true,
  asNavFor: ".behind-slider"
};
var behindSlider = {
  speed: 500,
  slidesToShow: 1,
  dots: false,
  rtl: is_rtl ? true : false,
  arrows: false,
  slidesToScroll: 1,
  pauseOnHover: false,
  cssEase: 'linear',
  fade: true,
  focusOnSelect: true,
  asNavFor: ".front-slider"
};

var propToCompare = {
  autoplay: true,
  pauseOnDotsHover: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: true,
  rtl: is_rtl ? true : false,
  customPaging: function (slider, i) {
    var totalSlides = slider.slideCount;
    return `
                <ion-icon name="videocam-sharp"></ion-icon>
                <span class='total'>
                    ${totalSlides}
                </span>  `
  },
  arrows: true,
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
};

var facilitiesSlider = {
  autoplay: false,
  pauseOnHover: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  rtl: is_rtl ? true : false,
  arrows: true,
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
};

var phasesSlider = {
  autoplay: false,
  pauseOnHover: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  rtl: is_rtl ? true : false,
  arrows: true,
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
};

var proTypesSlider = {
  autoplay: true,
  pauseOnHover: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  rtl: is_rtl ? true : false,
  arrows: true,
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
};

var masterPlanSlider = {
  autoplay: true,
  pauseOnHover: true,
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  rtl: is_rtl ? true : false,
  arrows: true,
  prevArrow: '<button class="PrevArrow"><ion-icon name="chevron-back-outline"></ion-icon></button>',
  nextArrow: '<button class="NextArrow"><ion-icon name="chevron-forward-outline"></ion-icon></button>',
};

var allSliders = {
  ".slider__gallery": sliderGallery,
  ".slider__thumbnails": sliderThumbnails,
  '.home-projects-slider': homeProjectsSlider,
  '.home-units-slider': homeUnitsSlider,
  '.home-blogs-slider': homeBlogsSlider,
  '.home-clients-slider': homeClientsSlider,
  '.home-top-client-slider': homeTopClientSlider,
  '.ip-box__slider': ipBox__slider,
  '.sp-slider-for': spSliderFor,
  '.sp-slider-nav': spSliderNav,
  '.front-slider': frontSlider,
  '.behind-slider': behindSlider,
  '.prop-to-compare': propToCompare,
  '.facilities-slider': facilitiesSlider,
  '.phases-slider': phasesSlider,
  '.pro-types-slider': proTypesSlider,
  '.master-plan-slider': masterPlanSlider,
}

for (let slider in allSliders) {
  if (allSliders.hasOwnProperty(slider)) {
    // if($(slider).length == 0) {
      $(slider).slick(allSliders[slider]);
    // }
  }
}
