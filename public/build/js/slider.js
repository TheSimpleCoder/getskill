'use strict';

(function () {
  var cabinetMenu = $('.menu-cabinet');
  var tarrifSlider = $('.tariff__plan');
  var aboutCurseTabs = $('.about-curse__tabs .tabs__list');
  var curseGallerySlider = $('.curse-gallery__slider');
  var infoSiteMenu = $('.info-site__menu');

  cabinetMenu.slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
      prevArrow: '<button class="menu-cabinet__prev"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 443.52 443.52"><path d="M143.492 221.863L336.226 29.129c6.663-6.664 6.663-17.468 0-24.132-6.665-6.662-17.468-6.662-24.132 0l-204.8 204.8c-6.662 6.664-6.662 17.468 0 24.132l204.8 204.8c6.78 6.548 17.584 6.36 24.132-.42 6.387-6.614 6.387-17.099 0-23.712L143.492 221.863z"/></svg></button>',
      nextArrow: '<button class="menu-cabinet__next"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.002 512.002"><path d="M388.425 241.951L151.609 5.79c-7.759-7.733-20.321-7.72-28.067.04-7.74 7.759-7.72 20.328.04 28.067l222.72 222.105-222.728 222.104c-7.759 7.74-7.779 20.301-.04 28.061a19.8 19.8 0 0014.057 5.835 19.79 19.79 0 0014.017-5.795l236.817-236.155c3.737-3.718 5.834-8.778 5.834-14.05s-2.103-10.326-5.834-14.051z"/></svg></button>',
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

  aboutCurseTabs.slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
      prevArrow: '<button class="menu-cabinet__prev"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 443.52 443.52"><path d="M143.492 221.863L336.226 29.129c6.663-6.664 6.663-17.468 0-24.132-6.665-6.662-17.468-6.662-24.132 0l-204.8 204.8c-6.662 6.664-6.662 17.468 0 24.132l204.8 204.8c6.78 6.548 17.584 6.36 24.132-.42 6.387-6.614 6.387-17.099 0-23.712L143.492 221.863z"/></svg></button>',
      nextArrow: '<button class="menu-cabinet__next"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.002 512.002"><path d="M388.425 241.951L151.609 5.79c-7.759-7.733-20.321-7.72-28.067.04-7.74 7.759-7.72 20.328.04 28.067l222.72 222.105-222.728 222.104c-7.759 7.74-7.779 20.301-.04 28.061a19.8 19.8 0 0014.057 5.835 19.79 19.79 0 0014.017-5.795l236.817-236.155c3.737-3.718 5.834-8.778 5.834-14.05s-2.103-10.326-5.834-14.051z"/></svg></button>',
    centerMode: true,
    centerPadding: '40px',
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
        breakpoint: 992,
        settings: "unslick"
      }
    ]
  });

  tarrifSlider.slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    centerPadding: '54px',
    prevArrow: $('.tariff__plan-arrow--prev'),
    nextArrow: $('.tariff__plan-arrow--next'),
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 767,
        settings: "unslick"
      }
    ]
  });

  curseGallerySlider.slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: $('.curse-gallery__arrow--prev'),
    nextArrow: $('.curse-gallery__arrow--next'),
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      },
      {
        breakpoint: 991,
        settings: {
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 1209,
        settings: {
          infinite: false,
          slidesToShow: 4,
          slidesToScroll: 1,
        }
      }
    ]
  });

  infoSiteMenu.slick({
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
