"use strict";

(function() {
  var body = document.querySelector('body');
  var popupButtons = Array.from(document.querySelectorAll('.popup-call'));

  if (popupButtons) {
    var closePopup = function () {
      var popup = document.querySelector('.popup');
      popup.classList.remove('popup--open');
      body.classList.remove('overflow-popup');
      document.removeEventListener('keydown', closePopupKeyPressHandler);
      document.removeEventListener('click', closePopupOutsideClickHandler);
    };

    var openPopup = function (element) {
      var popup = element;
      popup.classList.add('popup--open');
      body.classList.add('overflow-popup');
      var closeButton = popup.querySelector('.popup__cancel');
      closeButton.focus();
      closeButton.addEventListener('click', closePopupClickHandler);
      document.addEventListener('keydown', closePopupKeyPressHandler);
      document.addEventListener('click', closePopupOutsideClickHandler);
    };

    var closePopupClickHandler = function (evt) {
      evt.preventDefault();
      closePopup();
    };

    var closePopupKeyPressHandler = function (evt) {
      var isEsc = evt.code === 'Escape' || 'Esc';

      if (isEsc) {
        closePopup();
      }
    };

    var closePopupOutsideClickHandler = function (evt) {
      if (evt.target.classList.contains('popup--open')) {
        closePopup();
      }
    };

    var openPopupClickHandler = function (evt) {
      evt.preventDefault();
      var popupName = document.querySelector('#' + evt.target.dataset.popup);
      openPopup(popupName);
    };

    popupButtons.forEach(function (popupButton) {
      console.log(popupButton);
      popupButton.addEventListener('click', openPopupClickHandler);
    });
  }

})();
