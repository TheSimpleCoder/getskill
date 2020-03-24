(function () {
  var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
  });

  var selectStandardList = $('.select-standard__list');
  var selectategoryList = $('.custom-select__list');

  $(document).ready(function() {
    selectStandardList.mCustomScrollbar({
      theme:"dark",
      scrollInertia:400
    });

    selectategoryList.mCustomScrollbar({
      theme:"dark",
      scrollInertia:400
    });
  });
})();
