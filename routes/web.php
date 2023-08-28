<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UninstallController;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\Country_Price_Setting_Controller;
use App\Http\Controllers\Country_Redirect_Setting_Controller;
use App\Http\Controllers\Announcement_Bar_Setting_Controller;
use App\Http\Controllers\App_Setting_Controller;
use App\Http\Controllers\App_feature_controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


    /*-------AppController------------*/
    Route::get('/',[AppController::class, 'index']);
    Route::post('/',[AppController::class, 'index']);
    Route::get('/shopify_app',[AppController::class, 'shopify_app_data']);
    Route::post('/shopify_app',[AppController::class, 'shopify_app_data']);
    Route::get('/customer_data_request',[AppController::class, 'customer_data_request']);
    Route::post('/customer_data_request',[AppController::class, 'customer_data_request']);
    Route::get('/shop_redact',[AppController::class, 'shop_redact']);
    Route::post('/shop_redact',[AppController::class, 'shop_redact']);
    Route::get('/uninstall',[UninstallController::class, 'index']);
    //                         /*-------Module Controller------------*/

    Route::post('/getModule',[AppController::class, 'getModule']);

    //                     /*-------Dashboard Controller------------*/

    Route::get('/dashboard',[Dashboard_Controller::class, 'index']);

    //                                 /*-------Country_Price_Setting_Controller------------*/

    Route::get('/country_price_setting',[Country_Price_Setting_Controller::class, 'index']);
    Route::post('/insert_country',[Country_Price_Setting_Controller::class, 'insert_country']);
    Route::post('/setting_country_update',[Country_Price_Setting_Controller::class, 'setting_country_update']);
    Route::post('/update_status',[Country_Price_Setting_Controller::class, 'update_status']);
    Route::post('/delete_country_price',[Country_Price_Setting_Controller::class, 'delete_country_price']);
    Route::get('/show_country_setting_data',[Country_Price_Setting_Controller::class, 'show_country_setting_data']);
    Route::get('/add_product_variant',[Country_Price_Setting_Controller::class, 'add_product_variant']);
    Route::post('/add_product_variant',[Country_Price_Setting_Controller::class, 'add_product_variant']);
    Route::get('/delete_product_variant',[Country_Price_Setting_Controller::class, 'delete_product_variant']);
    Route::post('/delete_product_variant',[Country_Price_Setting_Controller::class, 'delete_product_variant']);
    Route::get('/save_form_values',[Country_Price_Setting_Controller::class, 'save_form_values']);
    Route::post('/save_form_values',[Country_Price_Setting_Controller::class, 'save_form_values']);
    Route::post('/loadmore',[Country_Price_Setting_Controller::class, 'loadMoreProducts']);  

    //       /*-------Country_Redirect_Setting_Controller------------*/
    //             /*-----Internal Redireaction*/
    Route::get('/country_redirect_setting',[Country_Redirect_Setting_Controller::class, 'index']);
    Route::post('/insert_country_page_internal',[Country_Redirect_Setting_Controller::class, 'insert_country_page_internal']);
    Route::get('/show_data_internal',[Country_Redirect_Setting_Controller::class, 'show_data_internal']);
    Route::post('/delete_data_internal',[Country_Redirect_Setting_Controller::class, 'delete_data_internal']);
    Route::post('/enable_disable_country_redirect',[Country_Redirect_Setting_Controller::class, 'enable_disable_country_redirect']);

    //             /*-----External Redireaction*/
    Route::post('/insert_country_page_external',[Country_Redirect_Setting_Controller::class, 'insert_country_page_external']);
    Route::get('/show_data_external',[Country_Redirect_Setting_Controller::class, 'show_data_external']);
    Route::post('/delete_data_external',[Country_Redirect_Setting_Controller::class, 'delete_data_external']);
    Route::post('/enable_disable_external',[Country_Redirect_Setting_Controller::class, 'enable_disable_external']);

    //                                 /*-------Announcement_Bar_Setting_Controller------------*/

    Route::get('/announcement_bar_setting',[Announcement_Bar_Setting_Controller::class, 'index']);
    Route::post('/announcement_bar_setting_insert',[Announcement_Bar_Setting_Controller::class, 'announcement_bar_setting_insert']);
    Route::get('/show_data_announcement_bar_setting',[Announcement_Bar_Setting_Controller::class, 'show_data_announcement_bar_setting']);
    Route::post('/delete_data_announcement_bar',[Announcement_Bar_Setting_Controller::class, 'delete_data_announcement_bar']);
    Route::post('/module_enable_disable_announcement_bar_setting',[Announcement_Bar_Setting_Controller::class, 'module_enable_disable_announcement_bar_setting']);
    Route::post('/edit_announcement_bar',[Announcement_Bar_Setting_Controller::class, 'edit_announcement_bar']);
    Route::post('/announcement_bar_update',[Announcement_Bar_Setting_Controller::class, 'announcement_bar_update']);

    // /*-------App Setting Controller------------*/

    Route::get('/app_setting',[App_Setting_Controller::class, 'index']);
    Route::post('/app_setting',[App_Setting_Controller::class, 'index']);
    Route::post('/theme_install_fun_ajax',[App_Setting_Controller::class, 'theme_install_fun_ajax']);
    Route::post('/country_selector_list',[App_Setting_Controller::class, 'country_selector_list']);
    Route::post('/get_announcement_bar',[App_Setting_Controller::class, 'get_announcement_bar']);
    Route::post('/country_page_redirect',[App_Setting_Controller::class, 'country_page_redirect']);

    // /*-------App Feature Controller------------*/
    Route::get('/app_feature',[App_feature_controller::class, 'index']);
    Route::post('/app_feature',[App_feature_controller::class, 'index']);

    Route::get('/submit_ticket',[App_feature_controller::class, 'submit_ticket']);
    Route::post('/submit_ticket',[App_feature_controller::class, 'submit_ticket']);

    Route::get('/share_feedback',[App_feature_controller::class, 'share_feedback']);
    Route::post('/share_feedback',[App_feature_controller::class, 'share_feedback']);

    Route::post('/feature_integration_mail',[App_feature_controller::class, 'feature_integration_mail']);
    Route::get('/faq',[App_feature_controller::class, 'faq']);
    Route::post('/change_log',[App_feature_controller::class, 'change_log']);
    Route::get('/change_log',[App_feature_controller::class, 'change_log']);
    Route::get('/install_request',[App_feature_controller::class, 'install_request']);
    Route::post('/install_request',[App_feature_controller::class, 'send_request_installation']);
