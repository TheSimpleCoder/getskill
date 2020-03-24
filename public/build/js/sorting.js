'use strict';

(function () {
  var filter = document.querySelector('.filter');

  if (filter) {
    var buttonFilter = document.querySelectorAll('.button--filter-open');
    var buttonFilterExit = filter.querySelector('.filter__exit');
    var filterFixedElement = filter.querySelector('.filter__fixed');
    filter.classList.remove('filter--no-js');

    var onCloseFilterClick = function () {
      filter.classList.remove('filter--open');
      window.menu.body.classList.remove('overflow-hidden');
      buttonFilterExit.removeEventListener('click', onCloseFilterClick);
    };

    var onOpenFilterClick = function () {
      filter.classList.add('filter--open');
      window.menu.body.classList.add('overflow-hidden');
      buttonFilterExit.addEventListener('click', onCloseFilterClick);
    };

    Array.from(buttonFilter).forEach(function (item) {
      item.addEventListener('click', onOpenFilterClick);
    });
  }

  window.sorting = {
    filterFixedElement: filterFixedElement
  };

})();
