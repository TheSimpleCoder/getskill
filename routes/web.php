<?php


Route::get('/', function () {
    return redirect(app()->getLocale());
});
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/atalitic/add/open-phone','AnaliticController@openPhone')->name('openPhone');
Route::get('/atalitic/add/favorite','AnaliticController@favorite')->name('f_analitic');

Route::get('/delete/filia', 'Cabinet\Organization\HomeController@deleteFilia')->name('deleteFilia');

Route::get('sitemap.xml', 'HomeController@sitemap');

Route::get('/sort/file', 'HomeController@newSortFile');

Route::get('/setlocale/{locale}', 'HomeController@setlocale')->name('setlocale');

Route::post('cabinet-organization/deals/add/user', 'Cabinet\Organization\DealsController@createDeals')->name('createDeals');

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'setlocale'
    ], function(){

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/search', 'Search@index')->name('search');
    Route::get('/search/result', 'Search@page')->name('search_page');

    //Курсы категория + город
    Route::get('/courses', 'HomeController@courses_all')->name('courses_region_all');
    Route::get('/courses/{slug}', 'HomeController@courses_all_region')->name('courses_region_all_slug');
    Route::get('/courses/{slug}/{cat_stage_1}', 'HomeController@courses_all_region_stage_one')->name('courses_region_all_slug_stage_one');
    Route::get('/courses/{slug}/{cat_stage_1}/{cat_stage_2}', 'HomeController@courses_all_region_stage_two')->name('courses_region_all_slug_stage_two');
    Route::get('/courses/{slug}/{cat_stage_1}/{cat_stage_2}/{cat_stage_3}', 'HomeController@courses_all_region_stage_tree')->name('courses_region_all_slug_stage_tree');

    //Мастер-классы категория + город
    Route::get('/masters-class', 'HomeController@masters_all')->name('masters_region_all');
    Route::get('/masters-class/{slug}', 'HomeController@masters_all_region')->name('masters_region_all_slug');
    Route::get('/masters-class/{slug}/{cat_stage_1}', 'HomeController@masters_all_region_stage_one')->name('masters_region_all_slug_stage_one');
    Route::get('/masters-class/{slug}/{cat_stage_1}/{cat_stage_2}', 'HomeController@masters_all_region_stage_two')->name('masters_region_all_slug_stage_two');
    Route::get('/masters-class/{slug}/{cat_stage_1}/{cat_stage_2}/{cat_stage_3}', 'HomeController@masters_all_region_stage_tree')->name('masters_region_all_slug_stage_tree');

    //Blog routs
    Route::get('/articles', 'Blog\ArticleController@index')->name('article');
    Route::get('/articles/category/{cat}', 'Blog\ArticleController@category')->name('article_category');
    Route::get('/articles/category/{cat}/post/{post}', 'Blog\ArticleController@article')->name('article_post');
    Route::post('/articles/add/comment', 'Blog\ArticleController@comment_add')->name('article_comment_add');
    Route::get('/articles/report/comment/{comment}', 'Blog\ArticleController@comment_report')->name('article_comment_report');

    Auth::routes();
    Route::get('/register-person', 'Auth\RegisterController@showPersonRegistrationForm')->name('register-person');
    Route::get('/register-organization', 'Auth\RegisterController@showOrganizationRegistrationForm')->name('register-organization');

    //Page course offline
    Route::get('/course-offline/{cat_stage_1}', 'Course\HomeController@index_off')->name('course_catalog_offline');
    Route::get('/course-offline/{cat_stage_1}/{cat_stage_2}', 'Course\PageController@index_off_stage_2')->name('course_catalog_offline_stage_2');
    Route::get('/course-offline/{cat_stage_1}/{cat_stage_2}/{cat_stage_3}', 'Course\PageController@index_off_stage_3')->name('course_catalog_offline_stage_3');
    Route::get('/morePosts/{id}', 'Course\HomeController@morePosts')->name('morePosts');

    //Page course online
    Route::get('/course-online/{cat_stage_1}', 'Course\HomeController@index_on')->name('course_catalog_online');
    Route::get('/course-online/{cat_stage_1}/{cat_stage_2}', 'Course\PageController@index_on_stage_2')->name('course_catalog_online_stage_2');
    Route::get('/course-online/{cat_stage_1}/{cat_stage_2}/{cat_stage_3}', 'Course\PageController@index_on_stage_3')->name('course_catalog_online_stage_3');

    //Page master - class
    Route::get('/master-class/{cat_stage_1}', 'Master\HomeController@index')->name('master_catalog');
    Route::get('/master-class/{cat_stage_1}/{cat_stage_2}', 'Master\PageController@index_stage_2')->name('master_catalog_stage_2');
    Route::get('/master-class/{cat_stage_1}/{cat_stage_2}/{cat_stage_3}', 'Master\PageController@index_stage_3')->name('master_catalog_stage_3');


    Route::get('/master/{id}', 'Master\HomeController@master')->name('master_page_info');
    Route::get('/morePosts/master/{id}', 'Master\HomeController@morePosts')->name('morePostsMaster');

    //Course info
    Route::get('/course/{id}', 'Course\HomeController@course')->name('course_page_info');
    Route::post('/course/add/new/review', 'Course\HomeController@newReview')->name('course_add_review');
    Route::get('/course/add/complaint/review', 'Course\HomeController@newComplain')->name('course_add_review_complain');
    Route::post('/course/add/new/review/feedback', 'Course\HomeController@newReviewFeedback')->name('course_add_review_feedback');

    //School
    Route::get('/schools/{cat_stage_1}', 'School\HomeController@schools')->name('school_list');
    Route::get('/schools/{cat_stage_1}/{cat_stage_2}', 'School\PageController@schools_stage_2')->name('school_list_stage_2');
    Route::get('/schools/{cat_stage_1}/{cat_stage_2}/{cat_stage_3}', 'School\PageController@schools_stage_3')->name('school_list_stage_3');


    Route::get('/school/{id}', 'School\HomeController@description')->name('school_description');
    Route::get('/catalog/school/{id}', 'School\HomeController@courses')->name('school_catalog');
    Route::get('/master/school/{id}', 'School\HomeController@master')->name('school_master');
    Route::get('/reviews/school/{id}', 'School\HomeController@reviews')->name('school_reviews');
    Route::get('/morePosts/school/{id}', 'School\HomeController@morePosts')->name('morePostsSchool');

    //Link add to favorite
    Route::get('/favorite/add', 'User\FavoriteController@add')->name('add_favorite');
    Route::get('/favorite', 'User\FavoriteController@index')->name('index_favorite');

    //Info pages
    Route::get('/about-us', 'User\InfoController@about')->name('about_us');

    Route::get('/services', 'User\InfoController@services')->name('services');

    Route::get('/faq', 'User\InfoController@faq')->name('faq');
    Route::get('/faq/{article}', 'User\InfoController@faq_show')->name('faq_show');

    Route::get('/contact', 'User\InfoController@contacts')->name('contacts');
    Route::post('/contact', 'User\InfoController@report')->name('contacts_report');

    Route::get('/improvement', 'User\InfoController@improvement')->name('improvement');

    Route::get('/terms', 'User\InfoController@rulles')->name('terms');

    Route::get('/offer', 'User\InfoController@offer')->name('offer');

    Route::get('/term', 'User\InfoController@terms')->name('term');



    Route::group(
        [
            'prefix' => 'cabinet-person',
            'as' => 'cabinet.person.',
            'namespace' => 'Cabinet\Person',
            'middleware' => ['auth', 'can:cabinet-person'],
        ],
        function () {
            Route::get('/', 'HomeController@index')->name('home');

            Route::get('/favorite', 'FavController@index')->name('favorite');

            Route::get('/reviews', 'ReviewsController@index')->name('reviews');

            Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                Route::get('/', 'ProfileController@index')->name('home');
                Route::put('/update', 'ProfileController@update')->name('update');
                Route::delete('/delete-image', 'ProfileController@deleteImage')->name('delete-image');
                Route::get('/change-password', 'ProfileController@changePasswordShowForm')->name('change-password');
                Route::put('/change-password', 'ProfileController@changePassword')->name('update-password');
                Route::get('/change-email', 'ProfileController@changeEmailShowForm')->name('change-email');
                Route::put('/change-email', 'ProfileController@changeEmail')->name('update-email');

            });


        }
    );


    Route::group(
        [
            'prefix' => 'cabinet-organization',
            'as' => 'cabinet.organization.',
            'namespace' => 'Cabinet\Organization',
            'middleware' => ['auth', 'can:cabinet-organization'],
        ],
        function () {
            Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                Route::get('/setting', 'OrganizationController@setting')->name('setting');
                Route::put('/update', 'OrganizationController@update')->name('update');
                Route::delete('/delete-image', 'OrganizationController@deleteImage')->name('delete-image');
                Route::get('/setting/change-password', 'OrganizationController@changePasswordShowForm')->name('change-password');
                Route::put('/setting/change-password', 'OrganizationController@changePassword')->name('update-password');
                Route::get('/setting/change-email', 'OrganizationController@changeEmailShowForm')->name('change-email');
                Route::put('/change-email', 'OrganizationController@changeEmail')->name('update-email');

            });

            Route::get('/info', 'HomeController@index')->name('home');
            Route::get('/delete-avatar', 'HomeController@deleteAvatar')->name('deleteAvatar');

            Route::get('/favorite', 'OrganizationController@favorite')->name('favorite');

            Route::get('/teachers', 'TeacherController@index')->name('teachers');
            Route::get('/teachers/add', 'TeacherController@add')->name('teachers_add');
            Route::get('/teachers/edit/{id}', 'TeacherController@edit')->name('teachers_edit');
            Route::post('/teachers/save', 'TeacherController@save')->name('teachers_add_save');
            Route::post('/teachers/save-edit', 'TeacherController@saveEdit')->name('teachers_add_save_edit');


            Route::get('/course', 'CourseController@index')->name('course');
            Route::get('/course/add', 'CourseController@add')->name('course_add');
            Route::get('/course/pagination', 'CourseController@setPagination')->name('pagination_course');
            Route::get('/course/set-status', 'CourseController@setStatus')->name('status_course');
            Route::get('/course/edit/{id}', 'CourseController@edit')->name('course_edit');
            Route::post('/course/add/new', 'CourseController@addCourseDB')->name('course_add_new');
            Route::post('/course/edit/update', 'CourseController@update')->name('course_edit_update');
            Route::get('/course/edit/{id}/delete-avatar', 'CourseController@deleteAvatar')->name('courseDeleteAvatar');

            Route::get('/master', 'MasterController@index')->name('master');
            Route::get('/master/add', 'MasterController@add')->name('master_add');
            Route::get('/master/set-status', 'MasterController@setStatus')->name('status_master');
            Route::get('/master/edit/{id}', 'MasterController@edit')->name('master_edit');
            Route::get('/master/edit/{id}/delete-avatar', 'MasterController@deleteAvatar')->name('masterDeleteAvatar');
            Route::post('/master/add/new', 'MasterController@addCourseDB')->name('master_add_new');
            Route::post('/master/edit/update', 'MasterController@update')->name('master_edit_update');

            Route::post('/up-organization', 'HomeController@updateOrganization')->name('updateOrganization');

            Route::get('/payment', 'PaymentController@index')->name('pay');
            Route::get('/payment/controller', 'PaymentController@controller')->name('control');
            Route::post('/payment/send', 'PaymentController@createPay')->name('createPay');
            Route::post('/payment/callback', 'PaymentController@callback')->name('callback');
            Route::post('/payment/callback/user', 'PaymentController@callbackUser')->name('callbackUser');

            Route::post('/up/photo/albom', 'HomeController@uploadPhotoMass')->name('uploadPhotoMass');
            Route::post('/up/photo/albom/course', 'CourseController@uploadPhotoMass')->name('uploadPhotoMassCourse');
            Route::post('/up/photo/albom/master', 'MasterController@uploadPhotoMass')->name('uploadPhotoMassMaster');
            Route::get('/drop-file', 'HomeController@dropFiles')->name('dropFiles');

            Route::get('/reviews', 'ReviewsController@index')->name('reviews');
            Route::get('/reviews/delete', 'ReviewsController@delete')->name('reviewsDelete');
            Route::post('/reviews/edit', 'ReviewsController@saveEdit')->name('reviews_edit');

            Route::post('/deals/delete', 'DealsController@delete')->name('deleteDeals');
            Route::post('/deals/update', 'DealsController@update')->name('updateDeals');
            Route::post('/deals/comments', 'DealsController@addComment')->name('addCommentDeals');
            Route::post('/deals/comments/delete', 'DealsController@deleteComment')->name('deleteCommentDeals');
            Route::post('/deals/comments/update', 'DealsController@updateComment')->name('updateCommentDeals');
            Route::post('/deals/add/new', 'DealsController@addNew')->name('dealsAddNew');
            Route::get('/deals/delete/get', 'DealsController@deleteGet')->name('deleteDealsGet');
            Route::get('/deals', 'DealsController@index')->name('deals');
            Route::get('/deals/add', 'DealsController@add')->name('dealsAdd');
            Route::get('/deals/show/{id}', 'DealsController@show')->name('showDeals');
            Route::get('/deals/arhiv', 'DealsController@arhiv')->name('dealsArhiv');
            Route::get('/deals/arhiv/show/{id}', 'DealsController@arhivShow')->name('dealsArhivShow');
            Route::get('/deals/arhiv/show/{id}/revoke', 'DealsController@revoke')->name('revoke');

            Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
                Route::get('/', 'ClientsController@index')->name('index');
                Route::get('/add', 'ClientsController@add')->name('add');
                Route::post('/add/save', 'ClientsController@save')->name('save');
                Route::post('/add/delete', 'ClientsController@delete')->name('delete');
                Route::get('/add/delete/get', 'ClientsController@delete')->name('deleteGet');
                Route::get('/edit/{id}', 'ClientsController@edit')->name('edit');
                Route::post('/update', 'ClientsController@update')->name('update');
            });

            Route::get('/analitic', 'AnaliticController@index')->name('analitic');
            
        }
    );


});

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('verify');
Route::get('/confirm-new-email/{token}', 'Auth\EmailController@confirmNewEmail')->name('confirm-new-email');



Route::group(
    [
        'prefix' =>  'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'can:admin-panel'],
    ],
    function (){
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('users', 'UsersController'); //crud
        Route::post('/users/{user}/verify', 'UsersController@verify')->name('users.verify');


        Route::resource('categories', 'CategoryController');
        Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
            Route::get('/list', 'CategoryController@list')->name('list');
            Route::get('/create', 'CategoryController@create')->name('create');
            Route::get('/show', 'CategoryController@show')->name('show');
            Route::post('/first', 'CategoryController@first')->name('first');
            Route::post('/up', 'CategoryController@up')->name('up');
            Route::post('/down', 'CategoryController@down')->name('down');
            Route::post('/last', 'CategoryController@last')->name('last');
            Route::get('/delete-photo', 'CategoryController@deletePhoto')->name('delete-photo');
            Route::resource('attributes', 'AttributeController')->except('index');
        });

        Route::resource('regions', 'RegionController');

        Route::group(['prefix' => 'publisher', 'as' => 'publisher.', 'namespace' => 'Publisher'], function () {

            Route::resource('categories', 'CategoryController');
            Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.',], function () {
                Route::post('/first', 'CategoryController@first')->name('first');
                Route::post('/up', 'CategoryController@up')->name('up');
                Route::post('/down', 'CategoryController@down')->name('down');
                Route::post('/last', 'CategoryController@last')->name('last');
                Route::get('/delete-photo', 'CategoryController@deletePhoto')->name('delete-photo');
            });

        });

        Route::group(['prefix' => 'course', 'as' => 'course.'], function () {
            Route::get('/list', 'CourseController@index')->name('list');
            Route::get('/list/{id}', 'CourseController@show')->name('show');
            Route::get('/list/{id}/update', 'CourseController@update')->name('update');
        });

        Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], function () {
            Route::get('/list', 'ReviewsController@index')->name('list');
            Route::get('/list/{id}/update', 'ReviewsController@update')->name('update');
        });

        Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
            Route::get('/list', 'MasterController@index')->name('list');
            Route::get('/list/{id}', 'MasterController@show')->name('show');
            Route::get('/list/{id}/update', 'MasterController@update')->name('update');
        });

        Route::group(['prefix' => 'article', 'as' => 'article.', 'namespace' => 'Article'], function () {
            //Категории
            Route::get('/category', 'ArticleController@index_category')->name('index_category');
            Route::get('/category/add', 'ArticleController@add_category')->name('add_category');
            Route::get('/category/edit/{category}', 'ArticleController@edit_category')->name('edit_category');
            Route::get('/category/delete/{category}', 'ArticleController@delete_category')->name('delete_category');

            Route::post('/category/add', 'ArticleController@add_category_save')->name('add_category_save');
            Route::post('/category/edit/update', 'ArticleController@edit_category_save')->name('edit_category_save');

            //Статьи
            Route::get('/posts', 'ArticleController@index_article')->name('index_article');
            Route::get('/posts/add', 'ArticleController@add_article')->name('add_article');
            Route::get('/posts/edit/{article}', 'ArticleController@edit_article')->name('edit_article');

            Route::post('/posts/add', 'ArticleController@add_article_save')->name('add_article_save');
            Route::post('/posts/edit/update', 'ArticleController@edit_article_save')->name('edit_article_save');
        });

        Route::get('/feedback', 'InfoController@feedback')->name('info_feedback');

        Route::get('/faq/category', 'InfoController@faq_category')->name('faq_category');
        Route::get('/faq/category/add', 'InfoController@faq_category_add')->name('faq_category_add');
        Route::get('/faq/category/edit/{category}', 'InfoController@faq_category_edit')->name('faq_category_edit');
        Route::post('/faq/category/add', 'InfoController@faq_category_add_save')->name('faq_category_add_save');
        Route::post('/faq/category/update', 'InfoController@faq_category_add_update')->name('faq_category_add_update');

        Route::get('/faq/article', 'InfoController@faq_article')->name('faq_article');
        Route::get('/faq/article/add', 'InfoController@faq_article_add')->name('faq_article_add');
        Route::get('/faq/article/edit/{article}', 'InfoController@faq_article_edit')->name('faq_article_edit');
        Route::post('/faq/article/add', 'InfoController@faq_article_add_save')->name('faq_article_add_save');
        Route::post('/faq/article/update', 'InfoController@faq_article_add_update')->name('faq_article_add_update');

        Route::get('/terms', 'InfoController@terms')->name('terms');
        Route::post('/terms', 'InfoController@terms_update')->name('terms_update');

        Route::post('/send/tarif', 'HomeController@box')->name('send_box_tarif');

        Route::group(['prefix' => 'parser', 'as' => 'parser.'], function () {
            Route::get('/', 'ParserController@index')->name('parser');
            Route::get('/cron', 'ParserController@cron')->name('cron');
            Route::post('/', 'ParserController@start_parsing')->name('start_parsing');
            Route::post('/add-task', 'ParserController@add_task')->name('add_task');
            Route::post('/delete-task', 'ParserController@delete_task')->name('delete_task');
        });
    }
);

