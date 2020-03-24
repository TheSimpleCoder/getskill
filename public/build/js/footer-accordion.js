'use strict';

(function () {
  var menuItems = document.querySelectorAll('.site-footer__column');
  var menuFooter = document.querySelectorAll('.site-footer__menu');
  var toggleButtons = document.querySelectorAll('.site-footer__toggle');

  var closeAllMenuFooter = function () {
    Array.from(menuFooter).forEach(function (currentElement) {
      if (currentElement.classList.contains('site-footer__menu--no-js')) {
        currentElement.classList.remove('site-footer__menu--no-js');
      }
    });
  };

  closeAllMenuFooter();

  var onShowMenuClick = function () {
    var currentMenuBlock = this.closest('.site-footer__column').querySelector('.site-footer__menu');
    currentMenuBlock.classList.toggle('site-footer__menu--open');
    this.classList.toggle('site-footer__toggle--open');

    Array.from(menuItems).forEach(function (item) {
      var menu = item.querySelector('.site-footer__menu');
      var button = item.querySelector('.site-footer__toggle');
      if (button !== this && menu !== currentMenuBlock) {
        button.classList.remove('site-footer__toggle--open');
        menu.classList.remove('site-footer__menu--open');
      }
    });
  };

  toggleButtons.forEach(function (button) {
    button.addEventListener('click', onShowMenuClick);
  });

})();
