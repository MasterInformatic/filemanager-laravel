<?php 

// Route::post('filemanager/upload','');
Route::group(['namespace' => 'MasterInformatic\filemanagerlaravel\Http\Controllers'], function() {
    //
	Route::get('filemanager/browser','FileManagerController@browser')->name('fmbrowser');

	Route::post('filemanager/upload','FileManagerController@upload')->name('fmupload');

	Route::get('filemanager/ckeditor/browser','FileManagerController@browser_ckeditor')->name('fmckbrowser');

	Route::get('filemanager/ckeditor/upload','FileManagerController@upload_ckeditor')->name('fmckpost');




}); 

// Route::post('filemanager/ckeditor/upload');
// Route::get('filemanager/ckeditor/browser');