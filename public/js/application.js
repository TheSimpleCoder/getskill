/*****************************************/
/******** Страница Организации ***********/
/*****************************************/

function ShowCatAttr() {

	if(!$(".tg-btn").hasClass("sh")){
		$('.custom-select__body').show();
		$(".tg-btn").addClass("sh")
	}else{
		$('.custom-select__body').hide();
		$(".tg-btn").removeClass("sh");
	}

}

$('.button-add-cat').click(function(){
	$(this).remove();
	$('.container-btn-cat').append(`
		<button type="button" class="custom-select__selected remove-btn-cat" data-id="`+$(this).data('cat-id')+`" data-name="`+$(this).data('cat-name')+`">
			` + $(this).data('cat-name') + `
		</button>
	`);
	checkCat();
});

$(document).on('click', '.remove-btn-cat', function(){
	$('.list-cat').append(`
		<li class="button-add-cat" data-cat-id="`+$(this).data('id')+`" data-cat-name="`+$(this).data('name')+`">
			<button type="button" class="custom-select__option">
				`+$(this).data('name')+`
			</button>
		</li>
	`);
	$(this).remove();
	checkCat();
});

function checkCat(){
	$('input[name="cat-list"]').val(
        $.map($('.container-btn-cat button'),function(el){
          	// return el.getAttribute('data-id') + '-' + el.getAttribute('data-name')
          	return el.getAttribute('data-id')
      	})
    );
};

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#cabinet_user_avatar").change(function(){
    readURL(this);
});

$(document).on('click', '.dynamic-form__toggle', function(){
	if($(this).parent().parent().hasClass('dynamic-form__content--hidden')){
		$(this).parent().parent().removeClass('dynamic-form__content--hidden');
		$(this).parent().parent().addClass('dynamic-form__item--open');
		$(this).removeClass('plus');
	}else{
		$(this).parent().parent().removeClass('dynamic-form__item--open');
		$(this).parent().parent().addClass('dynamic-form__content--hidden');
        $(this).addClass('plus');
	}
});

$(document).on('click', '.trash-btn-fillia', function(){
	var id = $(this).data('id');
	var filia = $(this).data('f');
	$('.class-fillia-' + id).remove();
	$('#count_fillia').val(parseInt($('#count_fillia').val()) - 1);

	deleteFiliaOrganization(filia);
});

function deleteFiliaOrganization(id){
	$.ajax({
        type: 'GET',
        url: "/delete/filia?id=" + id,
        success: function(result){

        }
    });
}

$(document).on('click', '.toggle-list-regions', function(){
	var id = $(this).data('id');
	if($(this).hasClass('close')){
		$(this).removeClass('close');
		$('.list-' + id).show();
	}else{
		$(this).addClass('close');
		$('.list-' + id).hide();
	}
});

$(document).on('click', '.get-region', function(){
	var name = $(this).data('name'),
		id = $(this).data('id');
	$(this).parents('.fillia-li').find('.set-region-new').html(name);
	$('.toggle-list-regions').addClass('close');
	$(this).parent().parent().parent().hide();
	$(this).parents('.fillia-li').find('.in_region').val(id);
});

$(document).on('click', '.clone-add-phone-number', function(){
	var clone = $(this).data('clone');
	if($('.ul-clone-list-'+ clone +' li').length < 3){
		$('.ul-clone-list-' + clone).append(`
			<li>
				<label for="dynamic_form_phone-0" class="label visually-hidden">
					Телефон
				</label>
				<input type="text" name="dynamic_form_phone-0" class="input input--full-width phone-add-list" data-phone-number="">
				<button type="button" class="delete cloned-input__delete delete-clone-phone" aria-label="Удалить">
				 	<svg width="17" height="21">
						<use xlink:href="#icon-trash"></use>
					</svg>
				</button>
			</li>
		`);
	}
});

$(document).on('click', '.delete-clone-phone', function(){
	$(this).parent().remove();
	$(this).parents('.fillia-li').find('.phone_numbers_list').val(
        $.map($(this).parents('.fillia-li').find('.phone-add-list'),function(el){
          	return el.getAttribute('data-phone-number')
      	})
    );
});

$(document).on('input', '.phone-add-list', function() {
	$(this).attr('data-phone-number', $(this).val());
	$(this).parents('.fillia-li').find('.phone_numbers_list').val(
        $.map($(this).parents('.fillia-li').find('.phone-add-list'),function(el){
          	return el.getAttribute('data-phone-number')
      	})
    );
});

$(document).on('click', '.toggle-list-messanger', function(){
	var tg = $(this).parent().data('list');
	if($(this).hasClass('close')){
		$(this).removeClass('close');
		$(this).parents('.messanger-block').find('.list-messenger-' + tg).show();
	}else{
		$(this).addClass('close');
		$(this).parents('.messanger-block').find('.list-messenger-' + tg).hide();
	}
});

$(document).on('click', '.get-messanger', function(){
	var list = $(this).parents('.messanger-block').data('list'),
		name = $(this).data('name');

	$(this).parents('.messanger-block').find('button').addClass('close');
	$('.list-messenger-' + list).hide();

	$(this).parents('.messanger-block').find('.get-name').html(name);
	$(this).parents('.container-c').find('.change-in-messanger-data').attr('data-name', name);
});

$(document).on('click', '.add-method-c', function(){
	var count = $('.container-c').length + 1;
	$(this).parents('.fillia-li').find('.spawn-methods').append(`
		<div class="dynamic-form__elements container-c" style="position: relative;">
			<div class="dynamic-form__left-element">

			<div class="select-standard select-standard--without-search messanger-block"  data-list="`+ count +`">
					<button type="button" class="select-standard__toggle toggle-list-messanger close" aria-label="Открыть список">
						<span class="select-standard__title get-name">
							`+ $('.select_lang').text() +`
					</span>
					<span class="select-standard__arrow">
							<svg width="13" height="7">
								<use xlink:href="#icon-arrow"></use>
							</svg>
					</span>
					</button>
					<div class="select-standard__body list-messenger list-messenger-`+ count +`">

					</div>
			</div>
			</div>
			<div class="dynamic-form__right-element">
			<label for="dynamic_form_communication_0" class="label visually-hidden">
					Метод связи
			</label>
			<input name="dynamic_form_communication_0" class="input input--full-width change-in-messanger-data" placeholder="`+ $('.placeholder').text() +`">
			</div>
			<button type="button" class="delete cloned-input__delete delete-messanger-data" aria-label="Удалить">
                <svg width="17" height="21">
                    <use xlink:href="#icon-trash"></use>
                </svg>
          	</button>
		</div>
	`);

	$('.list-messenger').html($('#list_messenger').html());
});


$("div.dynamic-form__left-element").on("click", function(){
	var id = $(this).parents('.fillia-li').data('filia');
	setTimeout(function(){
		$('.class-fillia-' + id).find('.messanger_list_data').val(
			$.map($('.class-fillia-' + id).find('.change-in-messanger-data'),function(el){

				return el.getAttribute('data-name') + ': ' + el.getAttribute('data-data')
			})
		);
	}, 500);
});

$('body').click(function(){


	var selElems = $('button.select-standard__toggle');
	selElems.each(function() {
		if(!$(this).hasClass('close'))
		{
			$(this).addClass('close');
		}
	});

	if(!$('button.select-standard__toggle').hasClass('close'))
	{
		$('button.select-standard__toggle').addClass('close');
	}

	if(!$('button.sorting__toggle').hasClass('close'))
	{
		$('button.sorting__toggle').addClass('close');
	}

	$(document).mouseup(function (e){ // событие клика по веб-документу
		var div = $("div.select-standard"); // тут указываем ID элемента

        if (!e.target.closest('.select-category__toggle')) {
            $('div.select-standard__body').css('display', 'none');
        }


		$('div.select_list').css('display', 'none');
		$('ul.select_list').css('display', 'none');
		if (!div.is(e.target) && div.has(e.target).length === 0) {

		} else {
			$(e.target).parent().parent().find('.select-standard__body').css('display', 'block');
		}



		//$(e.target.parent()).find('select-standard__body').css('display', 'block');
	});

	//var elems = $('div.select-standard__body').css('display', 'none');
	//var elems = $('div.select_list').css('display', 'none');
});

$(document).on('input', '.change-in-messanger-data', function(){
	$(this).attr('data-data', $(this).val());
	$(this).parents('.fillia-li').find('.messanger_list_data').val(
        $.map($(this).parents('.fillia-li').find('.change-in-messanger-data'),function(el){
          	return el.getAttribute('data-name') + ': ' + el.getAttribute('data-data')
      	})
    );
});

$(document).on('click', '.delete-messanger-data', function(){
	var id = $(this).parents('.fillia-li').data('filia');
	$(this).parents('.container-c').remove();

	console.log($(this).parents('.fillia-li').find('.messanger_list_data').val());
	$('.class-fillia-' + id).find('.messanger_list_data').val(
        $.map($('.class-fillia-' + id).find('.change-in-messanger-data'),function(el){
          	return el.getAttribute('data-name') + ': ' + el.getAttribute('data-data')
      	})
    );
    console.log($(this));
});

function addNewFiliya(){
	var num = $('.fillia-li').length + 1;
	$('#count_fillia').val(parseInt($('#count_fillia').val()) + 1);

	var citySelector = $('div#cSelCopy').html();
	citySelector = citySelector.replace('regions_1', 'regions_' + num);
		citySelector = citySelector.replace('selCityElem_1', 'selCityElem_' + num);
	citySelector = citySelector.replace('selCityElem_1_copy', 'selCityElem_' + num);


	$('#ol_list_fill').append(`

		<li class="dynamic-form__item dynamic-form__item--open fillia-li class-fillia-`+ num +`">
			<div class="dynamic-form__content">
					<div class="dynamic-form__header">
					<p class="dynamic-form__name">

					</p>
					<div class="dynamic-form__switcher">
							<div class="switcher">
							<label class="switcher__label">
								<span class="visually-hidden">
										Переключатель
								</span>
									<input type="checkbox" name="switcher_dynamic_`+ num +`" class="switcher__checkbox visually-hidden" checked>
									<span class="switcher__tumbler"></span>
							</label>
							</div>
					</div>
					<button type="button" class="delete dynamic-form__dynamic trash-btn-fillia" aria-label="Удалить" data-id="`+ num +`">
							<svg width="17" height="21">
							<use xlink:href="#icon-trash"></use>
							</svg>
					</button>
					<button type="button" class="dynamic-form__toggle" aria-label="Открыть форму">
							<span></span>
					</button>

					</div>
					<div class="dynamic-form__body">
					<div class="dynamic-form__elements">
							<div class="dynamic-form__left-element">
							<p class="label">
									`+ $('.city_lang').text() +`
							</p>
							`+ citySelector +`
							</div>
							<div class="dynamic-form__right-element">
							<label for="dynamic_form_address_`+ num +`" class="label">
									`+ $('.address_lang').text() +`
							</label>
							<input type="text" name="dynamic_form_address_`+ num +`" class="input input--full-width" placeholder="Некрасова, 12" id"dynamic_form_address_`+ num +`">
						</div>
					</div>
					<div class="dynamic-form__elements">
							<div class="dynamic-form__left-element">
								<label for="dynamic_form_phone_`+ num +`" class="label">
									`+ $('.phones_lang').text() +`
							</label>
							<input type="hidden" name="phone-numbers-`+ num +`" class="phone_numbers_list">
							<input type="text" name="dynamic-form-phone" class="input input--full-width phone-add-list" id="dynamic_form_phone_`+ num +`" data-phone-number="">
							<div class="cloned-input dynamic-form__cloned">
									<ul class="cloned-input__list ul-clone-list-`+ num +`">

									</ul>
									<button type="button" class="cloned-input__add clone-add-phone-number" data-clone="`+ num +`">
									`+ $('.add_number_lang').text() +`
									</button>
							</div>
							</div>
							<div class="dynamic-form__right-element">
							<label for="dynamic_form_email" class="label">
									E-mail
							</label>
							<input type="email" name="dynamic_form_email_`+ num +`" class="input input--full-width" placeholder="info@gmail.com">
							</div>
					</div>
					<p class="label">
							`+ $('.other_comm_lang').text() +`
					</p>
					<div class="dynamic-form__elements container-c">
							<div class="dynamic-form__left-element">

							<div class="select-standard select-standard--without-search messanger-block"  data-list="`+ num +`">
									<button type="button" class="select-standard__toggle toggle-list-messanger close" aria-label="Открыть список">
										<span class="select-standard__title get-name">
											`+ $('.select_lang').text() +`
									</span>
									<span class="select-standard__arrow">
											<svg width="13" height="7">
												<use xlink:href="#icon-arrow"></use>
											</svg>
									</span>
									</button>
									<div class="select-standard__body list-messenger list-messenger-`+ num +`">

									</div>
							</div>
							</div>
							<div class="dynamic-form__right-element">
							<label for="dynamic_form_communication_0_`+ num +`" class="label visually-hidden">
									Метод связи
							</label>
							<input name="dynamic_form_communication_0" class="input input--full-width change-in-messanger-data" placeholder="Введите значение" id="dynamic_form_communication_0_`+ num +`">
							</div>
						</div>
					<div class="spawn-methods"></div>
					<input type="hidden" name="messanger_list_data_`+ num +`" class="messanger_list_data">
					<div class="cloned-input">
						<button type="button" class="cloned-input__add add-method-c">
							`+ $('.other_comm_add_lang').text() +`
						</button>
					</div>
				</div>
			</div>
			<input type="hidden" name="defaul_id_`+ num +`">
		</li>
	`);

	$('.reg-set-class').html($('#region_list').html());
	$('.list-messenger').html($('#list_messenger').html());


	$('select.selCityElem_' + num).select2({
		matcher: matchCustom,
		placeholder: "Выберите из списка",
	});
}

function init(){
	$('.reg-set-class').html($('#region_list').html());
	$('.list-messenger').html($('#list_messenger').html());

	console.log('App init');
}

init();

//Реализация поиска для седект листов
$(document).on('input', '.search-select', function(){
	var search = $(this).val().toLowerCase(),
		attr = $(this).data('search');

	$(this).parents('ul').find('.list-search-' + attr).each(function(index, element){
		var string = $(this).find('button').text().toLowerCase(); // юрл в котором происходит поиск
		var regV = search;     // шаблон
		var result = string.match(regV);  // поиск шаблона в юрл

		// вывод результата
		if (!result) {
		    $(this).css('display', 'none');
		}else{
			$(this).css('display', 'block');
		}

	});
});

$(document).on('input', '.search-select-course', function(){
	var search = $(this).val(),
		attr = $(this).data('search'),
		c = $('.course_type').val();

	$(this).parents('ul').find('.list-search-' + attr).each(function(index, element){
		var string = $(this).find('button').text(); // юрл в котором происходит поиск
		var regV = search;     // шаблон
		var result = string.match(regV);  // поиск шаблона в юрл

		// вывод результата
		if (result && c == $(this).data('c')) {
		    $(this).css('display', 'block');
		}else{
			$(this).css('display', 'none');
		}

	});
});

function initTypeCourse(){
	var cat = $('.course_type').val();

	$('.list-search-category').each(function(index, element){
		if($(this).data('c') == cat){
			$(this).css('display', 'block');
		}else{
			$(this).css('display', 'none');
		}
	});
}

function deletePhotoForAlbum(id){
	var lang = $('.lang').text();
	$.ajax({
        type: 'GET',
        url: "/" + lang + "/cabinet-organization/drop-file?id=" + id,
        success: function(result){

        }
    });

    $('.gallery-drop-' + id).remove();
}




/*****************************************/
/******** Страница добавления курса ******/
/*****************************************/

$(document).on('click', '.toggle-btn-course', function(){
	if($(this).hasClass('close')){
		$(this).removeClass('close');
		$(this).closest('.select-standard').find('.course-cat-list').show();
	}else{
		$(this).addClass('close');
        $(this).closest('.select-standard').find('.course-cat-list').hide();
	}
});

$('.category-select__list').on('click', '.select-category__toggle', function() {
    $(this).parent().toggleClass('active');
});

$(document).on('click', '.get-type-course', function(){
	var name = $(this).text(),
		id = $(this).data('id');

	$('.course_type').val(id);
	$('.select-type-course').html(name);
	$(this).parents('.course_select_1').find('.toggle-btn-course').addClass('close');
	$(this).parents('.course_select_1').find('.course-cat-list').hide();

	$('.category_add_op').parents('li').hide();
	var cat = $(this).data('cat');
	$('.select_category_' + cat).parents('li').show();

	initTypeCourse();
});

$(document).on('click', '.select_btn', function(){
	if($(this).hasClass('close')){
		$(this).removeClass('close');
		$(this).parents('.select_class').find('.select_list').show();
	}else{
		$(this).addClass('close');
		$(this).parents('.select_class').find('.select_list').hide();
	}
});

$(document).on('click', '.select_option', function(){

	var name = $(this).text(),
		id = $(this).data('id');
	var input = $(this).data('in');

	$(this).parents('.select_class').find('.select_btn').addClass('close');
	$(this).parents('.select_class').find('.select_list').hide();

	if(!$(this).hasClass('option_btn') && !$(this).hasClass('option_btn_t')){
		$(this).parents('.select_class').find('.select_val').html(name);
		if(!$(this).hasClass('select_pagination')){
			$(this).parents('.select_class').find('.select_' + input).val(id);
		}else{
			setNewpaginationUser(id, $(this).data('locale'));
		}
		if(input == 'city_filter' || input == 'order_filter'){
			if(input == 'order_filter'){
				$('.select_' + input).val(id);
			}
			if($(window).width() >= '995'){
				$('.send_filter').trigger('click');
			}
		}
	}else if($(this).hasClass('option_btn_t')){
		$(this).parents('li').hide();
		if($(this).hasClass('btn_option_teachers')){
			$('.result_btn_t').append(`
				<button type="button" class="custom-select__selected select_remove_btn_t btn_option_teachers" data-id="`+ id +`">
					` + name + `
				</button>
			`);
			actionCheckTeachersCourse();
		}
	}else{
		$(this).parents('li').hide();
		if($(this).hasClass('btn_option_filia')){
			$('.result_btn_f').append(`
				<button type="button" class="custom-select__selected select_remove_btn btn_option_filia" data-id="`+ id +`">
					` + name + `
				</button>
			`);
			actionCheckFiliaCourse();
		}
	}
	$('.send_filter').trigger('click');
});

$(document).on('click', '.btn_show_sale', function(){
	$(this).hide();
	$(this).parents('.sale_block_parents').find('.label').css('color', '#0a0a0a');
	$(this).parents('.sale_block_parents').find('.sale_input').attr('type', 'text');
});

$(document).on('click', '.select_remove_btn', function(){
	var id = $(this).data('id');

	if($(this).hasClass('btn_option_filia')){
		$(this).remove();
		$('.filia_options_info_' + id).show();

		actionCheckFiliaCourse();
	}
});

$(document).on('click', '.select_remove_btn_t', function(){
	var id = $(this).data('id');

	if($(this).hasClass('btn_option_teachers')){
		$(this).remove();
		$('.teachers_options_info_' + id).show();

		actionCheckTeachersCourse();
	}
});

function actionCheckFiliaCourse(){
	$('.select_filia').val(
        $.map($('.result_btn_f button'),function(el){
          	return el.getAttribute('data-id')
      	})
    );
}

function actionCheckTeachersCourse(){
	$('.select_teachers').val(
        $.map($('.result_btn_t button'),function(el){
          	return el.getAttribute('data-id')
      	})
    );
}

function setNewpaginationUser(paginate, lang){
    $.ajax({
        type: 'GET',
        url: "/" + lang + "/cabinet-organization/course/pagination?count=" + paginate,
        success: function(result){
            var url = $('.current_url').text();
			location = url;
        }
    });
}

function courseSetNewStatus(status, id){
	$.ajax({
        type: 'GET',
        url: "/" + lang + "/cabinet-organization/course/set-status?status=" + status + "&id=" + id,
        success: function(result){

        }
    });
}

$(document).on('click', '.tabs__link', function(){
	var tab = $(this).data('tab');

	if(!$(this).hasClass('disable')){
		$('.tabs__item').removeClass('tabs__item--active');
		$(this).parents('.tabs__item').addClass('tabs__item--active');

		$('.tabs__info-block').removeClass('tabs__info-block--active');
		$('.tabs__info-block').addClass('tabs__info-block--hidden');

		$('#tab_' + tab).removeClass('tabs__info-block--hidden');
		$('#tab_' + tab).addClass('tabs__info-block--active');
	}
});

$(document).on('change', '.filter_form', function(){
	$('.send_filter').trigger('click');
})

function initEdit(){
	var cat = $('.course_type').val();
	$('.category_add_op').parents('li').hide();

	if(cat == 2){
		$('.select_category_1').parents('li').show();
	}else{
		$('.select_category_2').parents('li').show();
	}
}

initEdit();

/*$(document).on('click', '.filter_form input', function(){
	if(!$(this).hasClass('search-select') || !$(this).hasClass('input--search')){
		if($(window).width() >= '995'){
			$('.send_filter').trigger('click');
		}
	}
});*/

$(document).on('change', '.select_city', function(){
	if($(window).width() >= '995'){
		$('.send_filter').trigger('click');
	}
})

$(document).on('change', '.filter_form_date input', function(){
	if(!$(this).hasClass('search-select') || !$(this).hasClass('input--search')){
		if($(window).width() >= '995'){
			$('.send_filter').trigger('click');
		}
	}

})

$('.filter__submit').click(function(){
	$('.send_filter').trigger('click');
})

$('.tag-city').click(function(){
	$('select[name="city_filter"]').after('<input type="hidden" name="city_filter" value="">');
	if($(window).width() >= '995'){
		$('.send_filter').trigger('click');
	}
})

$('.tag-group-2').click(function(){
	$('#filter_group').trigger('click');
})

$('.tag-group-1').click(function(){
	$('#filter_individual').trigger('click');
})

$('.tag-cert-1').click(function(){
	$('#filter_certificate').trigger('click');
})

$('.tag-cert-2').click(function(){
	$('#filter_diploma').trigger('click');
})

$('.tag-cert-3').click(function(){
	$('#filter_no').trigger('click');
})

$('.tag-date-1').click(function(){
	$('#date_1').val('');
	if($(window).width() >= '995'){
		$('.send_filter').trigger('click');
	}
})

$('.tag-date-2').click(function(){
	$('#date_2').val('');
	if($(window).width() >= '995'){
		$('.send_filter').trigger('click');
	}
})

$('.tag-star-5').click(function(){
	$('#five_stars_5').trigger('click');
})

$('.tag-star-4').click(function(){
	$('#five_stars_4').trigger('click');
})

$('.tag-star-3').click(function(){
	$('#five_stars_3').trigger('click');
})

$('.tag-star-2').click(function(){
	$('#five_stars_2').trigger('click');
})

$('.tag-star-1').click(function(){
	$('#five_stars_1').trigger('click');
})

$('.tag-course-online').click(function(){
	$('#filter_course_online').trigger('click');
})

$('.tag-course-offline').click(function(){
	$('#filter_course_offline').trigger('click');
})

$('.tag-course-master').click(function(){
	$('#filter_course_master').trigger('click');
})

$('.tag-filter-1').click(function(){
	$('#type_course_1').trigger('click');
})

$('.tag-filter-2').click(function(){
	$('#type_course_2').trigger('click');
})

$(document).on('change', '#date_1', function(){
	if($(window).width() >= '995'){
		$('.send_filter').trigger('click');
	}
})

$(document).on('change', '#date_2', function(){
	if($(window).width() >= '995'){
		$('.send_filter').trigger('click');
	}
})

$('.reviews__footer-form').on('click', '.button.button--cancel', function(){
	$(this).closest('.reviews__footer.reviews__footer--answered').removeClass('reviews__footer--answered');
})

$('.js-form-validation').each(function() {
    var form = $(this);
    var inputs = $(form).find(':input');
    var values = [];
    var isFilled = false;

    function checkInputs(form) {
        var isFilled = true;
        $(form).find('input:not([type="hidden"])').each(function() {
            if (!$(this).val()) {
                isFilled = false;
            }
        });

        return isFilled;
    }

    $(form).on('blur  input', ':input', function(e) {
        var isFilled = checkInputs(form);

        if (isFilled) {
            $(form).find('.form__control--submit .button.disabled').removeClass('disabled');
        } else {
            $(form).find('.form__control--submit .button').addClass('disabled');
        }
    });

})


$('#add_curse_organization').find(':input').on('input', function() {
    $('#add_curse_organization').find('.button.button--cabinet-submit.button--save.button--green.button--fixed.show-mobile').addClass('visible');
});


$('form').find(':input').on('input', function() {
    $(this).closest('form').find('.button.button--save.disabled').removeClass('disabled');
});


/*****************************************/
/**************** Serach *****************/
/*****************************************/
$(document).on('input', '#search', function(){
	var lang = $(this).data('lang'),
		search = $(this).val();
	$('.result-search').html('');

	$.ajax({
        type: 'GET',
        url: "/" + lang + "/search?search=" + search,
        success: function(result){
            console.log(result['course']);
            // переберём массив result.course
			$.each(result['course'],function(index,value){
				if(lang == 'ru'){
					var name = value.name_ru;
				}else{
					var name = value.name_ua;
				}
				var cur;
				if(value.currency == 1){
					cur = 'грн';
				}else if(value.currency == 2){
					cur = '$';
				}else{
					cur = '€';
				}
				$('.result-search').append(`
					<div class="result-search__item"><a href="/` + lang + `/course/`+ value.id +`"><div class="result-search__item__name">` + name + `</div><div class="result-search__item__text-and-price"><span class="price__text">Цена за курс:</span><span class="price">`+ value.price_course +` `+ cur +`</span></div></a></div>
				`);

			});
			$.each(result['master'],function(index,value){
				if(lang == 'ru'){
					var name = value.name_ru;
				}else{
					var name = value.name_ua;
				}
				var cur;
				if(value.currency == 1){
					cur = 'грн';
				}else if(value.currency == 2){
					cur = '$';
				}else{
					cur = '€';
				}
				$('.result-search').append(`
					<div class="result-search__item"><a href="/` + lang + `/master/`+ value.id +`"><div class="result-search__item__name">` + name + `</div><div class="result-search__item__text-and-price"><span class="price__text">Цена за курс:</span><span class="price">`+ value.price +` `+ cur +`</span></div></a></div>
				`);

			});

			if ($('.result-search .result-search__item').length === 0) {
                $('.result-search').addClass('hide-results');
            } else {
                $('.result-search').removeClass('hide-results');
            }
        }
    });
})


/*****************************************/
/*************** Favorite ****************/
/*****************************************/

$(document).on('click', '.like-favorite', function(){
	var action = $(this).data('action');
	var lang = $(this).data('lang');
	var search = $(this).data('id');
	var type = $(this).data('type');
	if(typeof type == "undefined"){
		type = 'course';
	}
	console.log(type);

	if($('.favorite_' + search).hasClass('action_add')){
	    $('.fav-info').html('В избранном');
		console.log('add');
		var id = $(this).data('id');
		$.ajax({
	        type: 'GET',
	        url: "/" + lang + "/favorite/add?id=" + id + "&delete=no&type=" + type,
	        success: function(result){
	            if(result['result'] == 'yes'){
	            	$('.favorite_' + result['id']).addClass('like--active');
	            	if(!$('.like--header').hasClass('like--active')){
	            		$('.like--header').addClass('like--active')
	            	}
	            	var count = $('.like__count').text();
	            	$('.like__count').html(parseInt(count) + 1);
	            	$('.favorite_' + id).addClass('favorite_true_' + result['like']);
	            	$('.favorite_' + id).attr('data-action', 'delete');
	            	$('.favorite_' + id).attr('data-like', result['like']);
	            	$('.favorite_' + id).removeClass('action_add');
	            	$('.favorite_' + id).addClass('action_delete');
	            	$('.data-like-' + search).html(result['like']);
	            }
	        }
	    });
	}else{
		$('.fav-info').html('Добавить в избранное');
		var id = parseInt($('.data-like-' + search).text());
		console.log('delete ' + search);
		$.ajax({
	        type: 'GET',
	        url: "/" + lang + "/favorite/add?id=" + id + "&delete=yes&type=" + type + "&analitic=" + search,
	        success: function(result){
            	$('.favorite_true_' + result['id']).removeClass('like--active');
            	var count = parseInt($('.like__count').text()) - 1;
            	$('.like__count').html(count);
            	if(count == 0){
            		$('.like--header').removeClass('like--active');
            	}
            	$('.favorite_true_' + id).removeClass('action_delete');
            	$('.favorite_true_' + id).addClass('action_add');
            	$('.favorite_true_' + id).attr('data-action', 'add');
            	$('.favorite_true_' + id).attr('data-like', 'no');
            	$('.favorite_true_' + id).removeClass('favorite_true_' + result['like']);
	        }
	    });
	}
});

//Для неавторезированого пользователя
function setCookie(name, value, options) {
  	options = options || {};

  	var expires = options.expires;

  	if (typeof expires == "number" && expires) {
    	var d = new Date();
    	d.setTime(d.getTime() + expires*1000);
    	expires = options.expires = d;
  	}
  	if (expires && expires.toUTCString) {
  		options.expires = expires.toUTCString();
  	}

  	value = encodeURIComponent(value);

  	var updatedCookie = name + "=" + value;

  	for(var propName in options) {
    	updatedCookie += "; " + propName;
    	var propValue = options[propName];
    	if (propValue !== true) {
      		updatedCookie += "=" + propValue;
     	}
  	}

  	updatedCookie += "; path=/";

  	document.cookie = updatedCookie;
}

// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
  	var matches = document.cookie.match(new RegExp(
    	"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  	));
  	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function getCountCookie(){
	var count_c = document.cookie.split('Like-course-').length - 1;
	var count_m = document.cookie.split('Like-master-').length - 1;
	var count = count_m + count_c;

	return count;
}

// удаляет cookie
function deleteCookie(name) {
    setCookie(name, null, { expires: -1 })
}


// Добавляем в закладки
$(document).on('click', '.add_favorite', function () {
    var id = $(this).data('favorit');
    var type = $(this).data('type');
    var lang = $(this).data('lang');
    setCookie('Like-'+type+'-'+id, id);
    $('.favorite_'+id).addClass('like--active');
    $('.favorite_'+id).removeClass('add_favorite');

    $('.like--header').addClass('like--active');
    $('.like__count').html(getCountCookie());

    if($(this).hasClass('like-text')){
    	if(lang == 'ru'){
    		$('.fav-info').html('В избранном');
    	}else{
    		$('.fav-info').html('В обраному');
    	}
    }

    sendAnaliticFavorite(id, type, 1);
});

// Удаляем из закладок
$(document).on('click', '.like--active', function () {
    var id = $(this).data('favorit');
    var type = $(this).data('type');
    var lang = $(this).data('lang');
    deleteCookie('Like-'+type+'-'+id);
    $('.favorite_'+id).removeClass('like--active');
    $('.favorite_'+id).addClass('add_favorite');

    var count = getCountCookie();
    $('.like__count').html(count);
    if(count <= 0){
		$('.like--header').removeClass('like--active');
	}

	if($(this).hasClass('like-text')){
    	if(lang == 'ru'){
    		$('.fav-info').html('Добавить в избрное');
    	}else{
    		$('.fav-info').html('Додати до обраного');
    	}
    }

	sendAnaliticFavorite(id, type, 2);
});

function getCountHeader(){
	//like--header
	//like__count
	var count = getCountCookie();
	$('.like__count').html(count);
	if(count > 0){
		$('.like--header').addClass('like--active');
	}
}

function getCountHeaderAuth(){
	//like--header
	//like__count
	var n_count = getCountCookie();
	var a_count = parseInt($('.like__count').text());
	var count = n_count + a_count;
	$('.like__count').html(count);
	if(count > 0){
		$('.like--header').addClass('like--active');
	}
}


/*****************************************/
/*************** Сделки ******************/
/*****************************************/

$('.edit_name_deals_btn').click(function(){
	$('.edit_name_deals').show();
});

$('.tag_select').click(function(){
	if($(this).hasClass('close')){
		$(this).removeClass('close');
		$('.tag_list').show();
	}else{
		$(this).addClass('close');
		$('.tag_list').hide();
	}
});

$('.status_select_btn').click(function(){
	if($(this).hasClass('close')){
		$(this).removeClass('close');
		$('.status_list').show();
	}else{
		$(this).addClass('close');
		$('.status_list').hide();
	}
});

//Скрыть блок с тегами
$(document).mouseup(function (e){ // событие клика по веб-документу
	var div = $('.tag_list, .status_list'); // тут указываем ID элемента
	if (!div.is(e.target) // если клик был не по нашему блоку
	    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			$('.tag_list, .status_list').hide(); // скрываем его
			$('.tag_select, .status_select_btn').addClass('close');
		}
});

$('.tag_btn').click(function(){
	var tag = $(this).data('value');
	var id = $(this).data('id');
	$('.tag_val').html(tag);
	$('.input_tag').val(id);
});

$('.status_option').click(function(){
	var status = $(this).text(),
		id = $(this).data('id');

	var select = $(this).closest('.underline-select');

	switch (id) {
        case 0: {
            $(select).removeClass('underline-select--processing underline-select--cancel underline-select--completed').addClass('underline-select--new');
            break;
        }
        case 1: {
            $(select).removeClass('underline-select--new underline-select--cancel underline-select--completed').addClass('underline-select--processing');
            break;
        }
        case 2: {
            $(select).removeClass('underline-select--new underline-select--cancel underline-select--processing').addClass('underline-select--completed');
            break;
        }
        case 3: {
            $(select).removeClass('underline-select--completed underline-select--processing underline-select--new').addClass('underline-select--cancel');
            break;
        }

        default:
            break;
    }

	$('.input_status').val(id);
	$('.status_val').html(status);
});

if ($('.underline-select').length) {
    var id = parseInt($('.input_status').val(), 10);
    var select = $('.underline-select');

    switch (id) {
        case 0: {
            $(select).removeClass('underline-select--processing underline-select--cancel underline-select--completed').addClass('underline-select--new');
            break;
        }
        case 1: {
            $(select).removeClass('underline-select--new underline-select--cancel underline-select--completed').addClass('underline-select--processing');
            break;
        }
        case 2: {
            $(select).removeClass('underline-select--new underline-select--cancel underline-select--processing').addClass('underline-select--completed');
            break;
        }
        case 3: {
            $(select).removeClass('underline-select--completed underline-select--processing underline-select--new').addClass('underline-select--cancel');
            break;
        }

        default:
            break;
    }
}

$('.deals-edit__button-edit').click(function(){
	$(this).parents('.deals-edit__item').addClass('deals-edit__item--open');
});

$('.action-circle__edit').click(function(){
	$(this).parents('.comment__item').addClass('comment__item--active');
});

$('.comment__cancel').click(function(){
	$(this).parents('.comment__item').removeClass('comment__item--active');
});












/*****************************************/
/*************** Разное ******************/
/*****************************************/

$(document).on('click', '.reviews__answer', function(){
	$(this).parents('.reviews__footer').addClass('reviews__footer--answered');
})

$('.reviews__answer').click(function(){
	//$(this).hide();
	$(this).parents('.reviews__footer').find('.button--save').show();
	$(this).parents('.reviews__review').find('.reviews__main p').hide();
	$(this).parents('.reviews__review').find('.reviews__main textarea').show();
});


//Переключатель тарифов
$('.tariff__item--base').click(function(){
	$('#tariff_plan_input_base').trigger('click');
	$('#tariff_plan_one_month').trigger('click');

	$('.price_1').html(0);
	$('.price_2').html(0);
	$('.price_3').html(0);
	$('.price_4').html(0);

	$('.tariff__calculation-sum span.sp-uah').html(0);
});

$('.tariff__item--standard').click(function(){
	$('#tariff_plan_input_standard').trigger('click');
	$('#tariff_plan_one_month').trigger('click');

	$('.price_1').html('300');
	$('.price_2').html(300 * 3);
	$('.price_3').html(300 * 6);
	$('.price_4').html(300 * 12);

	$('.tariff__calculation-sum span.sp-uah').html(300);
	$('.hidden-summ').val(300);

	getPlanCalc_2();
});

$('.tariff__item--premium').click(function(){
	$('#tariff_plan_input_premium').trigger('click');
	$('#tariff_plan_one_month').trigger('click');

	$('.price_1').html('900');
	$('.price_2').html(900 * 3);
	$('.price_3').html(900 * 6);
	$('.price_4').html(900 * 12);

	$('.tariff__calculation-sum span.sp-uah').html(900);
	$('.hidden-summ').val(900);

	getPlanCalc_3();
});

//Переключатель для месяцов тарифа
$(document).on('click', '.tariff__plan-element--one-month', function(){
	$('#tariff_plan_one_month').trigger('click');

	var plan = $('input[name=tariff__plan]:checked').val();

	$('.hidden-summ').val(parseInt($('.price_1').text()));
	$('.tariff__calculation-sum span.sp-uah').html(parseInt($('.price_1').text()));
});

$(document).on('click', '.tariff__plan-element--three-month', function(){
	$('#tariff_plan_three_month').trigger('click');

	var plan = $('input[name=tariff__plan]:checked').val();

	$('.hidden-summ').val(parseInt($('.price_2').text()));
	$('.tariff__calculation-sum span.sp-uah').html(parseInt($('.price_2').text()));
});

$(document).on('click', '.tariff__plan-element--six-month', function(){
	$('#tariff_plan_six_month').trigger('click');

	var plan = $('input[name=tariff__plan]:checked').val();

	$('.hidden-summ').val(parseInt($('.price_3').text()));
	$('.tariff__calculation-sum span.sp-uah').html(parseInt($('.price_3').text()));
});

$(document).on('click', '.tariff__plan-element--one-year', function(){
	$('#tariff_plan_one_years').trigger('click');

	var plan = $('input[name=tariff__plan]:checked').val(),
		action = parseInt($('.tariff__time-action').data('action'));;

	$('.hidden-summ').val(parseInt($('.price_4').text()));
	$('.tariff__calculation-sum span.sp-uah').html(parseInt($('.price_4').text()));
});

$('.tooltip__toggle').hover(
    function(){ $(this).parents('.tooltip').addClass('tooltip--open') },
    function(){ $(this).parents('.tooltip').removeClass('tooltip--open') }
);


//========================
//Пересчёт тарифного плана
//========================

function getPlanCalc_2(month){
	var time_and = parseInt($('.tariff__time-action').data('unix')),
		pack = parseInt($('.tariff__time-action').data('type')),
		action = parseInt($('.tariff__time-action').data('action'));

	if(pack == 2 || action == 0){
		return false;
	}

	var time_start = parseInt($('.tariff__time-action').data('start')),
		price_day_pack_two = 10,
		price_day_pack_tree = 30,
		now_not_str = Date.now(),
		now_milisecond = now_not_str.toString(),
		now = now_milisecond / 1000,
		left_second = time_and - parseInt(now),
		left_minute = left_second / 60,
		left_houre = left_minute / 60,
		left_day = left_houre / 24,
		grn_left = left_day * price_day_pack_tree;

	if(grn_left < 300){
		var ret = 300 - grn_left,
			ret_2 = 900 - grn_left,
			ret_3 = 1800 - grn_left,
			ret_4 = 3600 - grn_left;

		$('.price_1').html(parseInt(ret));
		$('.price_2').html(parseInt(ret_2));
		$('.price_3').html(parseInt(ret_3));
		$('.price_4').html(parseInt(ret_4));

		$('.sp-uah').html(parseInt(ret));
		$('.hidden-summ').val(parseInt(ret));

		$('#tariff_plan_one_month').trigger('click');
	}else if(grn_left > 300 && grn_left < 900){
		var ret = 900 - grn_left,
			ret_3 = 1800 - grn_left,
			ret_4 = 3600 - grn_left;

		$('.price_1').html(0);
		$('.price_2').html(parseInt(ret));
		$('.price_3').html(parseInt(ret_3));
		$('.price_4').html(parseInt(ret_4));

		$('.sp-uah').html(parseInt(ret));
		$('.hidden-summ').val(parseInt(ret));

		$('#tariff_plan_three_month').trigger('click');
	}else if(grn_left >= 900 && grn_left < 1800){
		var ret = 1800 - grn_left,
			ret_4 = 3600 - grn_left;

		$('.price_1').html(0);
		$('.price_2').html(0);
		$('.price_3').html(parseInt(ret));
		$('.price_4').html(parseInt(ret_4));

		$('.sp-uah').html(parseInt(ret));
		$('.hidden-summ').val(parseInt(ret));

		$('#tariff_plan_six_month').trigger('click');
	}else if(grn_left >= 1800){
		var ret = 3600 - grn_left;
		$('.price_1').html(0);
		$('.price_2').html(0);
		$('.price_3').html(0);
		$('.price_4').html(parseInt(ret));

		$('.sp-uah').html(parseInt(ret));
		$('.hidden-summ').val(parseInt(ret));

		$('#tariff_plan_one_years').trigger('click');
	}
}

function getPlanCalc_3(month){
	var time_and = parseInt($('.tariff__time-action').data('unix')),
		pack = parseInt($('.tariff__time-action').data('type')),
		action = parseInt($('.tariff__time-action').data('action'));

	if(pack == 3 || action == 0){
		return false;
	}

	var time_start = parseInt($('.tariff__time-action').data('start')),
		price_day_pack_two = 10,
		price_day_pack_tree = 30,
		now_not_str = Date.now(),
		now_milisecond = now_not_str.toString(),
		now = now_milisecond / 1000,
		left_second = time_and - parseInt(now),
		left_minute = left_second / 60,
		left_houre = left_minute / 60,
		left_day = left_houre / 24,
		grn_left = left_day * price_day_pack_two;

	if(grn_left < 900){
		var ret = 900 - grn_left,
			ret_2 = 2700 - grn_left,
			ret_3 = 5400 - grn_left,
			ret_4 = 10800 - grn_left;

		$('.price_1').html(parseInt(ret));
		$('.price_2').html(parseInt(ret_2));
		$('.price_3').html(parseInt(ret_3));
		$('.price_4').html(parseInt(ret_4));

		$('.sp-uah').html(parseInt(ret));
		$('.hidden-summ').val(parseInt(ret));

		$('#tariff_plan_one_month').trigger('click');
	}else if(grn_left > 900 && grn_left < 2700){
		var ret = 2700 - grn_left,
			ret_3 = 5400 - grn_left,
			ret_4 = 10800 - grn_left;

		$('.price_1').html(0);
		$('.price_2').html(parseInt(ret));
		$('.price_3').html(parseInt(ret_3));
		$('.price_4').html(parseInt(ret_4));

		$('.sp-uah').html(parseInt(ret));
		$('.hidden-summ').val(parseInt(ret));

		$('#tariff_plan_three_month').trigger('click');
	}else if(grn_left >= 2700 && grn_left < 5400){
		var ret = 2700 - grn_left,
			ret_4 = 10800 - grn_left;

		$('.price_1').html(0);
		$('.price_2').html(0);
		$('.price_3').html(parseInt(ret));
		$('.price_4').html(parseInt(ret_4));

		$('.sp-uah').html(parseInt(ret));
		$('.hidden-summ').val(parseInt(ret));

		$('#tariff_plan_six_month').trigger('click');
	}else if(grn_left >= 5400){
		var ret = 10800 - grn_left;
		$('.price_1').html(0);
		$('.price_2').html(0);
		$('.price_3').html(0);
		$('.price_4').html(parseInt(ret));

		$('.sp-uah').html(parseInt(ret));
		$('.hidden-summ').val(parseInt(ret));

		$('#tariff_plan_one_years').trigger('click');
	}
}

//Аналитика
$('.button__all-numbers').click(function(){
	sendAnaliticPhone($(this).data('user'), $(this).data('type'), $(this).data('course'));
})

function sendAnaliticPhone(id, type, course){
    $.ajax({
        type: 'GET',
        url: "/atalitic/add/open-phone?user=" + id + "&type=" + type + "&course=" + course,
        success: function(result){

        }
    });
}

function sendAnaliticFavorite(id, type, action){
    $.ajax({
        type: 'GET',
        url: "/atalitic/add/favorite?id=" + id + "&type=" + type + "&action=" + action,
        success: function(result){

        }
    });
}

$('.open_analitic_option').click(function(){
	if($(this).hasClass('close')){
		$(this).removeClass('close');
		$('.analytic_list_hidden').show();
	}
});

$(document).mouseup(function (e){ // событие клика по веб-документу
	var div = $('.analytic_list_hidden'); // тут указываем ID элемента
	if (!div.is(e.target) // если клик был не по нашему блоку
	    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			$('.analytic_list_hidden').hide(); // скрываем его
			$('.open_analitic_option').addClass('close');
		}
});

$('.btn_report').click(function(){
	$(this).parents('.reviews__option-wrap').find('.div_report').show();
});

$(document).mouseup(function (e){ // событие клика по веб-документу
	var div = $('.div_report'); // тут указываем ID элемента
	if (!div.is(e.target) // если клик был не по нашему блоку
	    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			$('.div_report').hide(); // скрываем его
		}
});

$('.reviews__option-wrap').click(function(){
	$(this).addClass('reviews__option-wrap--open');
})

$('.sort-view').click(function () {
    var c = jQuery.makeArray($(".table-cabinet__list-item"));
    if($(this).hasClass('max')){
	    c.sort(function (a, b) {
	        a = $(a).attr("data-view");
	        b = $(b).attr("data-view");
	        return b - a
	    });

	    $(this).removeClass('max');
    	$(this).addClass('min');
	}else{
		c.sort(function (a, b) {
	        a = $(a).attr("data-view");
	        b = $(b).attr("data-view");
	        return a - b
	    });

	    $(this).removeClass('min');
    	$(this).addClass('max');
	}
    $(c).appendTo(".table-cabinet__list");
});

$('.sort-phone').click(function () {
    var c = jQuery.makeArray($(".table-cabinet__list-item"));
    if($(this).hasClass('max')){
	    c.sort(function (a, b) {
	        a = $(a).attr("data-phone");
	        b = $(b).attr("data-phone");
	        return b - a
	    });

	    $(this).removeClass('max');
    	$(this).addClass('min');
	}else{
		c.sort(function (a, b) {
	        a = $(a).attr("data-phone");
	        b = $(b).attr("data-phone");
	        return a - b
	    });

	    $(this).removeClass('min');
    	$(this).addClass('max');
	}
    $(c).appendTo(".table-cabinet__list");
});

$('.sort-like').click(function () {
    var c = jQuery.makeArray($(".table-cabinet__list-item"));
    if($(this).hasClass('max')){
	    c.sort(function (a, b) {
	        a = $(a).attr("data-like");
	        b = $(b).attr("data-like");
	        return b - a
	    });

	    $(this).removeClass('max');
    	$(this).addClass('min');
	}else{
		c.sort(function (a, b) {
	        a = $(a).attr("data-like");
	        b = $(b).attr("data-like");
	        return a - b
	    });

	    $(this).removeClass('min');
    	$(this).addClass('max');
	}
    $(c).appendTo(".table-cabinet__list");
});

$('.sort-deal').click(function () {
    var c = jQuery.makeArray($(".table-cabinet__list-item"));
    if($(this).hasClass('max')){
	    c.sort(function (a, b) {
	        a = $(a).attr("data-deal");
	        b = $(b).attr("data-deal");
	        return b - a
	    });

	    $(this).removeClass('max');
    	$(this).addClass('min');
	}else{
		c.sort(function (a, b) {
	        a = $(a).attr("data-deal");
	        b = $(b).attr("data-deal");
	        return a - b
	    });

	    $(this).removeClass('min');
    	$(this).addClass('max');
	}
    $(c).appendTo(".table-cabinet__list");
});

function transliterate(text, engToRus) {
	var x;
	var
		rus = "щ   ш  ч  ц  ю  я  ё  ж  ъ  ы  э  а б в г д е з и й к л м н о п р с т у ф х ь".split(/ +/g),
		eng = "shh sh ch cz yu ya yo zh `` y' e` a b v g d e z i j k l m n o p r s t u f x `".split(/ +/g)
	;
	for(x = 0; x < rus.length; x++) {
		text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
		text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase());
	}
	return text.toLowerCase();
}

$('.sort-name').click(function(){
	var items = document.querySelectorAll('.deals__item');

  	// get all items as an array and call the sort method
  	Array.from(items).sort(function(a, b) {
    	// get the text content
    	// a = transliterate($(a).data('name'))
    	// b = transliterate($(b).data('name'))

    	a = $(a).data('name')
    	b = $(b).data('name')
    	console.log(a);
    	return (a > b) - (a < b)
  	}).forEach(function(n, i) {
    	n.style.order = i
  	})
})

$('.sort-email').click(function(){
	var items = document.querySelectorAll('.deals__item');

  	// get all items as an array and call the sort method
  	Array.from(items).sort(function(a, b) {
    	// get the text content

    	a = $(a).data('email')
    	b = $(b).data('email')
    	console.log(a);
    	return (a > b) - (a < b)
  	}).forEach(function(n, i) {
    	n.style.order = i
  	})
})

function sortOrders(){
	$('input[name="sort_gallery"]').val(
        $.map($('.ui-sortable-handle'),function(el){
          	return el.getAttribute('data-id')
      	})
    );

    setTimeout(sendNewOrder, 500);
}

$('.gallery__img').mouseup(function(){
	console.log('mouseup');

	setTimeout(sortOrders, 500);
})

function sendNewOrder(){
	$.ajax({
        type: 'GET',
        url: "/sort/file?sort_gallery=" + $('input[name="sort_gallery"]').val(),
        success: function(result){

        }
    });
}

$('.send_city_result_btn').click(function(){
	setTimeout(ChangeRegionFilter, 500);
})

function ChangeRegionFilter(){
	$('#send_city_result').trigger('click');
}


$('.noUi-handl').mouseup(function(){
	if($(window).width() >= '995'){
		$('.send_filter').trigger('click');
	}
})

$(document).on('mouseup', '.noUi-handle', function(){
	if($(window).width() >= '995'){
		$('.send_filter').trigger('click');
	}
})

