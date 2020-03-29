(function () {
  var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
  });

  var selectStandardList = $('.select-standard__list');
  var selectategoryList = $('.custom-select__list');

  // $(document).ready(function() {
  //   selectStandardList.mCustomScrollbar({
  //     theme:"dark",
  //     scrollInertia:400
  //   });
  //
  //   selectategoryList.mCustomScrollbar({
  //     theme:"dark",
  //     scrollInertia:400
  //   });
  // });


})();


$(document).ready(function() {
    function matchCustom(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
            return null;
        }

        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
            var modifiedData = $.extend({}, data, true);

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }

    $("select.cityFilter").select2({
        language: "ru",
        matcher: matchCustom
    });
    $("select.selCatCourse").select2({
        language: "ru",
        matcher: matchCustom
    });

    $('select#selSCatList').select2({
        matcher: matchCustom,
        placeholder: "Выберите из списка",
    });

    $('select#filiaSelect').select2({
        matcher: matchCustom,
        placeholder: "Выберите из списка",
    });

    $('select.selCityElem_1').select2({
        matcher: matchCustom,
        placeholder: "Выберите из списка",
    });

    $("select.cityFilter").change(function(){
        $('.send_filter').trigger('click');
    });


    $("a.popup-call").on("click", function(){
        var lnk = $(this).attr('lnk');
        $('a#lnktorep').attr('href', lnk);
        $('section#report').attr('class', 'popup popup--open');
    });
    $("button.popup__cancel").on("click", function(){

        $('section#report').attr('class', 'popup');
    });

    $("#selS").dropdown();
    $(function() {
        $( "#gallery_response" ).sortable();
        $( "#gallery_response" ).disableSelection();
    });

    $('.ui.dropdown').dropdown();
    $('.cityFilter').dropdown({
        onChange: function() {
            $('.send_filter').trigger('click');
        }
    });
    $(function(){
        $(".phone-mask").mask("+380 (99) 999-99-99");
    });
})
