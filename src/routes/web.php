<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/2/18
 * Time: 4:32 PM
 */
Route::get('/hello','Alireza1992\ProcessManagerTestController@index');

Route::get('/start',function (){
    return \Alireza1992\ProcessManager\Events::log('stock-sheet-request','create-request','test','1','1','1');
});
