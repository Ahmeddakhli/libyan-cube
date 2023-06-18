$(function () {
  if ($(window).width() >= 768) {
    $("body").niceScroll({
      cursorminheight: 32,
      autohidemode: true,
      zindex: "99",
      smoothscroll: true,
      scrollspeed: 70,
      mousescrollstep: 40,
      enabletranslate3d: true,
      hwacceleration: true, // use hardware accelerated scroll when supported
      bouncescroll: true, // (only hw accell) enable scroll bouncing at the end of content as mobile-like 
    });
  }
});

// init tokenfield with typeahead autocomplete
const initTokenfield = () => {

  const data = [
    { "id": "1", "value": "Cairo" },
    { "id": "2", "value": "Giza" },
    { "id": "3", "value": "Hurghada" },
    { "id": "4", "value": "North Coast" },
    { "id": "5", "value": "marsa matrouh" },
    { "id": "6", "value": "Sharm Elsheikh" },
  ];

  const options = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    identify: function (obj) { return obj.value; },
    local: data
  });

  function optionsWithDefaults(q, sync) {
    if (q === '') {
      sync(options.get('Cairo', 'Giza', 'North Coast', "Sharm Elsheikh"));
    } else {
      options.search(q, sync);
    }
  }

  $('.autocomplete-input').tokenfield({
    limit: 3,
    typeahead: [{
      hint: true,
      highlight: true,
      minLength: 0,
      classNames: {
        dataset: 'list-group',
        suggestion: "list-group-item"
      },
    },
    {
      name: 'options',
      display: 'value',
      source: optionsWithDefaults,
      templates: {
        empty: [
          `<small class="text-danger p-2">
              We can’t find any location.<br>Please check your spelling or try a different location.
            </small>`
        ],
        suggestion: function (location) {
          return `
            <span>
              <i class="ri-map-pin-line"></i>
              <img class="dev-logo" src="assets/developers/1.svg">
              ${location.value}
              <span class="badge bg-secondary fw-normal">Developer</span>
            </span>
          `;
        }
      }
    }]
  });

  $('.autocomplete-input').on('tokenfield:createtoken', function (event) {
    // prevent duplicate tags from being entered
    const existingTokens = $(this).tokenfield('getTokens');
    $.each(existingTokens, function (index, token) {
      if (token.value === event.attrs.value) {
        event.preventDefault();
      }
    });

    // limiting tags to typeahead
    const availableTokens = options.index.datums;
    let exists = true;
    $.each(availableTokens, function (index, token) {
      if (token.value === event.attrs.value) {
        exists = false;
      }
    });
    if (exists === true) {
      event.preventDefault();
    }
  });

};

initTokenfield();

//////////////////////////////////////////////////////////////////////////////////////////

// multipleSelect INIT
$('select.form-select-checkbox').multipleSelect({
  multiple: true,
  selectAll: false,
  hideOptgroupCheckboxes: true,
  // ellipsis: true
});

$('select.dd-select').multipleSelect({
  selectAll: false
});

//////////////////////////////////////////////////////////////////////////////////////////

// intl tel input plugin
const phoneInputs = document.querySelectorAll('.phone-input');
phoneInputs.forEach((input) => {
  intlTelInput(input, {
    initialCountry: 'eg',
  });
});

//////////////////////////////////////////////////////////////////////////////////////////

// init datepicker
$(".date-input").datepicker({
  format: "mm/yyyy",
  startView: "months",
  minViewMode: "months",
  autoclose: true,
  clearBtn: true,
  language: "en", // should be "ar" in rtl direction.
  zIndexOffset: 15
});

$(".full-date-input").datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  clearBtn: true,
  language: "en", // should be "ar" in rtl direction.
  zIndexOffset: 15
});

//////////////////////////////////////////////////////////////////////////////////////////

// INIT MAGNIFIC PLUGIN
$('.gallery-holder').each(function () {
  $(this).magnificPopup({
    delegate: 'a.mgf-link',
    type: 'image',
    midClick: true,
    gallery: {
      enabled: true
    }
  });
});

//////////////////////////////////////////////////////////////////////////////////////////

// HOME SLIDER
new Swiper('.home-slider', {
  loop: true,
  effect: "fade",
  autoplay: {
    delay: 5000,
  },
  navigation: {
    nextEl: ".home-slider-next-btn",
    prevEl: ".home-slider-prev-btn",
  },
});

// UNITS SLIDER
new Swiper('.units-slider', {
  loop: true,
  autoplay: {
    delay: 3000
  },
  spaceBetween: 15,
  centeredSlides: true,
  centerInsufficientSlides: true,
  breakpoints: {
    // when window width is >= 768px
    768: {
      slidesPerView: 3,
    },
    // when window width is >= 575px
    575: {
      slidesPerView: 1,
    },
  },
  navigation: {
    nextEl: '.units-next-btn',
    prevEl: '.units-prev-btn',
  },
  pagination: {
    el: ".swiper-pagination",
    type: "fraction",
  },
});

// UNIT TYPES SLIDER
new Swiper('.unit-types-slider', {
  loop: true,
  autoplay: {
    delay: 3000
  },
  centeredSlides: true,
  spaceBetween: 5,
  observer: true,
  observeParents: true,
  observeSlideChildren: true,
  centerInsufficientSlides: true,
  breakpoints: {
    // when window width is >= 575px
    575: {
      slidesPerView: 2,
    },
  },
  navigation: {
    nextEl: ".u-types-next-btn",
    prevEl: ".u-types-prev-btn",
  },
});

// projects SLIDER
new Swiper('.projects-slider', {
  loop: true,
  autoplay: {
    delay: 3000
  },
  centeredSlides: true,
  spaceBetween: 15,
  centerInsufficientSlides: true,
  navigation: {
    nextEl: '.proj-next-btn',
    prevEl: '.proj-prev-btn',
  },
  pagination: {
    el: ".swiper-pagination",
    type: "fraction",
  },
  breakpoints: {
    // when window width is >= 768px
    768: {
      slidesPerView: 3,
    },
    // when window width is >= 575px
    575: {
      slidesPerView: 1,
    },
  },
});

// Developers SLIDER
new Swiper('.devs-slider', {
  loop: true,
  autoplay: {
    delay: 3000
  },
  spaceBetween: 10,
  slidesPerView: 2,
  centerInsufficientSlides: true,
  breakpoints: {
    // when window width is >= 991px
    991: {
      slidesPerView: 7,
    },
    // when window width is >= 768px
    768: {
      slidesPerView: 5,
    },
    // when window width is >= 575px
    575: {
      slidesPerView: 3,
    },
  },
});

// BLOGS SLIDER
new Swiper('.blogs-slider', {
  loop: true,
  autoplay: {
    delay: 3000,
  },
  spaceBetween: 10,
  centerInsufficientSlides: true,
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
    clickable: true
  },
  breakpoints: {
    // when window width is >= 768px
    768: {
      slidesPerView: 2,
    }
  },
});

// VIEW page THUMBNAIL SLIDER

const galleryThumbs = new Swiper('.gallery-thumbs', {
  autoplay: {
    delay: 3000
  },
  loop: true,
  spaceBetween: 10,
  slidesPerView: 4,
  centerInsufficientSlides: true
});

const galleryTop = new Swiper('.gallery-large', {
  autoplay: {
    delay: 3000
  },
  loop: true,
  spaceBetween: 10,
  thumbs: {
    swiper: galleryThumbs,
  },
  navigation: {
    nextEl: '.gall-unit-next-btn',
    prevEl: '.gall-unit-prev-btn',
  },
});

new Swiper('.gallery-plans-slider', {
  loop: true,
  // autoplay: {
  //   delay: 3000,
  // },
  spaceBetween: 10,
  centerInsufficientSlides: true,
  observer: true,
  observeParents: true,
  observeSlideChildren: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    dynamicBullets: true
  },
  breakpoints: {
    991: {
      slidesPerView: 3,
    },
    // when window width is >= 768px
    768: {
      slidesPerView: 2,
    },
    // when window width is >= 575px
    575: {
      slidesPerView: 1,
    },
  },
});

// panorama SLIDER
new Swiper('.panorama-slider', {
  autoplay: {
    delay: 3000
  },
  loop: true,
  spaceBetween: 20,
  centerInsufficientSlides: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.panorama-next-btn',
    prevEl: '.panorama-prev-btn',
  },
  breakpoints: {
    991: {
      slidesPerView: 3,
    },
    // when window width is >= 768px
    768: {
      slidesPerView: 2,
    },
    // when window width is >= 575px
    575: {
      slidesPerView: 1,
    },
  },
});

new Swiper('.payments-slider', {
  autoplay: {
    delay: 3000
  },
  loop: true,
  observer: true,
  observeParents: true,
  observeSlideChildren: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    dynamicBullets: true
  },
  breakpoints: {
    // when window width is >= 992
    992: {
      slidesPerView: 1,
    },
    // when window width is >= 768
    768: {
      slidesPerView: 3,
    },
    // when window width is >= 575px
    575: {
      slidesPerView: 2,
    },
  },
});