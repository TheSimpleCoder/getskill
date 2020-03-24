'use strict';

(function () {
  var body = document.querySelector('body');
  var navigation = document.querySelector('.navigation');
  var mobileMenu = navigation.querySelector('.mobile-menu');
  var buttonMenu = navigation.querySelector('.navigation__open-menu');
  var overlay =  navigation.querySelector('.overlay');
  navigation.classList.remove('navigation--no-js');

  var onCloseMenuClick = function () {
    mobileMenu.classList.remove('mobile-menu--open');
    overlay.classList.remove('overlay--open');
    body.classList.remove('overflow-hidden');
    if (window.sorting.filterFixedElement) {
      window.sorting.filterFixedElement.classList.remove('filter__fixed--hidden');
    }
    overlay.removeEventListener('click', onCloseMenuClick);
  };

  var onOpenMenuClick = function () {
    mobileMenu.classList.add('mobile-menu--open');
    overlay.classList.add('overlay--open');
    body.classList.add('overflow-hidden');
    if (window.sorting.filterFixedElement) {
      window.sorting.filterFixedElement.classList.add('filter__fixed--hidden');
    }
    overlay.addEventListener('click', onCloseMenuClick);
  };

  buttonMenu.addEventListener('click', onOpenMenuClick);

  window.menu = {
    body: body
  };

})();
