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
    return \Alireza1992\ProcessManager\Events::log('stock-sheet-request', 'create-request', 'test', '1','10');
});

Route::as('admin.process-managers.')
    ->prefix('admin/process-managers')
    ->middleware(['web', 'admin'])
    ->group(function () {
        Route::resource('process', 'ProcessController');
        Route::resource('process-step', 'ProcessStepController');
        Route::resource('process-step-status', 'ProcessStepStatusController');
        Route::resource('process-step-variable', 'ProcessStepVariableController');
    });
