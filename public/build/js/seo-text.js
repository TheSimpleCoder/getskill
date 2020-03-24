'use strict';

(function () {
  var SEO_TEXT_VISIBLE_HEIGHT = 84;
  var seoText = document.querySelector('.seo-text');

  if (seoText) {
    var seoContent = seoText.querySelector('.seo-text__info');
    var seoToggle = seoText.querySelector('.seo-text__show-more');

    if (SEO_TEXT_VISIBLE_HEIGHT >= seoContent.offsetHeight) {
      seoToggle.remove();
    } else {
      seoText.classList.add('seo-text--has-open');
    }

    var showSeoContentClickHandler = function (evt) {
      evt.preventDefault();
      seoText.classList.add('seo-text--open');
      seoToggle.remove();
    };

    seoToggle.addEventListener('click', showSeoContentClickHandler);
  }
})();
