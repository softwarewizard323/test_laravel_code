<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'IndexController@index');
Route::get('features', 'FeaturesController@index');
Route::get('faq', 'FaqController@index');
Route::post('contact', 'ContactController@process');
Route::get('tos', 'TosController@index');

/*
 * AUTH
 */
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

/*
 * DASHBOARD
 */
Route::group(['prefix' => 'dashboard'], function()
{
    Route::get('/', 'Dashboard\DashboardController@dashboard');
    Route::get('/campaign/{type?}', 'Dashboard\DashboardController@index');
    Route::get('/banned', 'Dashboard\BannedController@index');
    Route::get('/maintenance', 'Dashboard\MaintenanceController@index');

    Route::get('/settings', 'Dashboard\SettingsController@index');
    Route::post('/settings', 'Dashboard\SettingsController@process');

    Route::get('/balance', 'Dashboard\BalanceController@index');
    Route::post('/balance', 'Dashboard\BalanceController@PayPal');
    Route::post('/skrill', 'Dashboard\BalanceController@skrill');
    Route::post('/voucher', 'Dashboard\BalanceController@voucher');

    Route::get('/messages', 'Dashboard\MessagesController@index');
    Route::get('/message/{id}', 'Dashboard\MessagesController@view');
    Route::post('/message/{id}', 'Dashboard\MessagesController@answer');

    Route::get('/orders', 'Dashboard\OrdersController@index');
    Route::post('/order/{id}', 'Dashboard\OrdersController@process');

    Route::get('/programs/{name}', 'Dashboard\ProgramsController@index');

    Route::get('/analytics', 'Dashboard\AnalyticsController@index');

    Route::post('/check/{name}', 'Dashboard\CheckController@check');

    Route::group(['prefix' => 'support'], function()
    {
        Route::get('/', 'Dashboard\SupportController@index');
        Route::get('/new/{type}', 'Dashboard\SupportController@create');
        Route::post('/new/{type}', 'Dashboard\SupportController@process');
        Route::get('/view/{id}', 'Dashboard\SupportController@view');
        Route::post('/answer/{id}', 'Dashboard\SupportController@answer');
        Route::post('/delete/{id}', 'Dashboard\SupportController@delete');
        Route::post('/star/{id}', 'Dashboard\SupportController@star');
    });

    Route::group(['prefix' => 'booster'], function()
    {
        /*** Google Booster ***/
        Route::get('/google', 'Dashboard\BoosterController@google');
        Route::post('/google/setup', 'Dashboard\BoosterController@googleSetup');
        Route::post('/google/confirm', 'Dashboard\BoosterController@googleConfirm');
        Route::any('/google/complete', 'Dashboard\BoosterController@googleComplete');

        /*** Direct Booster ***/
        Route::get('/direct', 'Dashboard\BoosterController@direct');
        Route::post('/direct/setup', 'Dashboard\BoosterController@directSetup');
        Route::post('/direct/confirm', 'Dashboard\BoosterController@directConfirm');
        Route::any('/direct/complete', 'Dashboard\BoosterController@directComplete');
    });

    Route::group(['prefix' => 'traffic'], function()
    {
        /*** High Clicks Booster ***/
        Route::get('/clicks', 'Dashboard\TrafficController@clicks');
        Route::post('/clicks/setup', 'Dashboard\TrafficController@clicksSetup');
        Route::post('/clicks/confirm', 'Dashboard\TrafficController@clicksConfirm');
        Route::any('/clicks/complete', 'Dashboard\TrafficController@clicksComplete');
        /*** Adsense Booster ***/
        Route::get('/adsense', 'Dashboard\TrafficController@adsense');
        Route::post('/adsense/setup', 'Dashboard\TrafficController@adsenseSetup');
        Route::post('/adsense/confirm', 'Dashboard\TrafficController@adsenseConfirm');
        Route::any('/adsense/complete', 'Dashboard\TrafficController@adsenseComplete');
    });
});

/*
 * ADMIN
 */
Route::group(['prefix' => 'admin'], function()
{
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/settings', 'Admin\AdminController@settings');
    Route::post('/settings', 'Admin\AdminController@process');

    Route::get('/messages', 'Admin\MessagesController@index');
    Route::group(['prefix' => 'message'], function()
    {
        Route::any('/new/{id}/{template?}', 'Admin\MessagesController@create');
        Route::any('/cnew/{id}/{template?}', 'Admin\MessagesController@ccreate');
        Route::post('/delete', 'Admin\MessagesController@delete');
        Route::get('/unread/{id}', 'Admin\MessagesController@unread');
        Route::get('/{id}', 'Admin\MessagesController@view');
        Route::post('/{id}', 'Admin\MessagesController@answer');
    });

    Route::group(['prefix' => 'orders'], function()
    {
        Route::get('/hidden', 'Admin\OrdersController@hidden');
        Route::get('/end', 'Admin\OrdersController@end');
        Route::group(['prefix' => 'update'], function()
        {
            Route::any('/edit/{id}', 'Admin\OrdersController@edit');
            Route::get('/delete/{id}', 'Admin\OrdersController@delete');
            Route::get('/hide/{id}', 'Admin\OrdersController@hide');
            Route::get('/reveal/{id}', 'Admin\OrdersController@reveal');
            Route::post('/start/{id}', 'Admin\OrdersController@startCampaign');
            Route::post('/end/{id}', 'Admin\OrdersController@endCampaign');
            Route::post('/confirm/{id}', 'Admin\OrdersController@confirmCampaign');
        });
        Route::get('/{filter?}', 'Admin\OrdersController@index');
    });

    Route::group(['prefix' => 'conversion'], function()
    {
        Route::group(['prefix' => 'update'], function()
        {
            Route::get('/delete/{id}', 'Admin\CampaignsController@delete');
            Route::post('/start/{id}', 'Admin\CampaignsController@startCampaign');
            Route::post('/end/{id}', 'Admin\CampaignsController@endCampaign');
        });
        Route::get('/{filter?}', 'Admin\CampaignsController@index');
    });

    Route::get('/sources', 'Admin\SourcesController@index');
    Route::any('/source/add', 'Admin\SourcesController@add');
    Route::any('/source/{id}', 'Admin\SourcesController@edit');
    Route::get('/source/delete/{id}', 'Admin\SourcesController@delete');
    Route::post('/sources/dripfeed', 'Admin\SourcesController@dripFeed');

    /*** News ***/
    Route::group(['prefix' => 'news'], function()
    {
        Route::get('/', 'Admin\NewsController@index');
        Route::any('/add', 'Admin\NewsController@add');
        Route::any('/edit/{id}', 'Admin\NewsController@edit');
        Route::get('/status/{id}', 'Admin\NewsController@status');
        Route::any('/delete/{id?}', 'Admin\NewsController@delete');
    });

    /*** Balances ***/
    Route::group(['prefix' => 'balance'], function()
    {
        Route::get('/manage', 'Admin\BalancesController@manageBalance');
        Route::get('/manage/all', 'Admin\BalancesController@manageBalanceAll');
        Route::post('/manage/update', 'Admin\BalancesController@manageBalanceUpdate');
        Route::get('/manage/deduct', 'Admin\BalancesController@deductDate');
        Route::get('/payments', 'Admin\BalancesController@viewPayments');
        Route::get('/vouchers', 'Admin\BalancesController@voucher');
        Route::get('/vouchers/delete/{id}', 'Admin\BalancesController@voucherDelete');
        Route::post('/vouchers/create', 'Admin\BalancesController@voucherCreate');
        Route::get('/vip', 'Admin\BalancesController@vipUser');
        Route::get('/vip/delete/{id}', 'Admin\BalancesController@vipUserDelete');
        Route::post('/vip/create', 'Admin\BalancesController@vipUserCreate');
    });

    /*** Manage FAQs ***/
    Route::get('/faq', 'Admin\ManageFaqsController@index');
    Route::get('/faq/add', 'Admin\ManageFaqsController@addFaq');
    Route::get('/faq/edit/{id}', 'Admin\ManageFaqsController@editFaq');
    Route::get('/faq/delete/{id}', 'Admin\ManageFaqsController@deleteFaq');
    Route::post('/faq/save', 'Admin\ManageFaqsController@save');

    /*** Support ***/
    Route::get('/support', 'Admin\SupportController@index');
    Route::get('/support/archives', 'Admin\SupportController@archiveSupport');
    Route::post('support/ticket/delete', 'Admin\SupportController@groupDelete');
    Route::get('/support/ticket/{id}', 'Admin\SupportController@ticketRead');
    Route::post('/support/ticket/reply', 'Admin\SupportController@ticketReply');
    Route::get('/support/ticket/close/{id}', 'Admin\SupportController@ticketClose');
    Route::get('/support/ticket/unread/{id}', 'Admin\SupportController@ticketUnread');

    /*** Users ***/
    Route::group(['prefix' => 'users'], function()
    {
        Route::get('/', 'Admin\UsersController@index');
        Route::post('/level/', 'Admin\UsersController@level');
        Route::post('/password/', 'Admin\UsersController@password');
        Route::post('/delete/', 'Admin\UsersController@delete');
        Route::post('/clear/', 'Admin\UsersController@clear');
        Route::post('/ban/', 'Admin\UsersController@ban');
        Route::post('/banned/', 'Admin\UsersController@banned');
    });

    /*** Signatures ***/
    Route::get('/signatures', 'Admin\SignaturesController@index');
    Route::get('/signature/create', 'Admin\SignaturesController@create');
    Route::post('/signature/create', 'Admin\SignaturesController@save');
    Route::get('/signature/delete/{id}', 'Admin\SignaturesController@delete');
    Route::post('/signature/delete', 'Admin\SignaturesController@groupDelete');
});

/*
 * PayPal
 */
Route::post('/ipn-balance', 'PaymentController@ipnBalance');
Route::post('/ipn-builder', 'PaymentController@ipnBuilder');

Route::get('/cron/{action}', 'CronController@index');