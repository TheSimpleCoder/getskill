'use strict';

(function () {
  var cabinetMenu = $('.menu-cabinet');

  cabinetMenu.slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    centerMode: true,
    centerPadding: '54px',
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          infinite: true,
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 991,
        settings: {
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 1209,
        settings: "unslick"
      }
    ]
  });

})();
