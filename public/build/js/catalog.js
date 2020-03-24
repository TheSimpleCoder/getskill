'use strict';

(function () {
  var catalogList = document.querySelector('.catalog__list');
  var viewInput = document.querySelectorAll('.view__input');

  var orientation = {
    vertical: function () {
      catalogList.classList.add('catalog__list--vertical');
    },

    default: function () {
      catalogList.classList.remove('catalog__list--vertical');
    }
  };

  Array.from(viewInput).forEach(function (element) {
    element.addEventListener('change', orientation[element.value]);
  });

})();
