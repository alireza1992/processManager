<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 10/2/18
 * Time: 4:32 PM
 */
Route::get('/hello',
    function (\Illuminate\Http\Request $request){
            return $request->process_alias  ;
    }
    );

Route::get('/start',function (){
    return \Alireza1992\ProcessManager\Events::log('stock-sheet-request','create-request','test','1','1','1');
});