<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/2/18
 * Time: 4:32 PM
 */

Route::get('hello',
    function () {
       dd('asd');});

Route::get('/start', function () {
    return \Processmanager\Events::log('request_stock_sheet', 'create_request', 'registered', '1','10',['symbol'=>'سایپا','desc'=>'لطفا برگه سهم من را بدهید']);
});

Route::as('admin.process-managers.')
    ->prefix('admin/process-managers')
    ->middleware(['web', 'admin'])
    ->group(function () {
        Route::resource('process', 'ProcessController');
        Route::resource('process-step', 'ProcessStepController');
        Route::resource('process-step-status', 'ProcessStepStatusController');
        Route::resource('process-step-variable', 'ProcessStepVariableController');
        Route::resource('event-notification', 'EventNotificationController');
        Route::get('event-notification/step-choose/{processId}/{notificationId}','EventNotificationController@stepChoose')->name('event-notification.stepChoose');
        Route::get('stepVariable/{processId}','EventNotificationController@stepVariables');
        Route::post('save-notification-parameters','EventNotificationController@saveParameters')->name('event-notification.saveParameters');
    });
