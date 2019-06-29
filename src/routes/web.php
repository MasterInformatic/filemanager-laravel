<?php 

// Route::post('filemanager/upload','');
Route::group(['namespace' => 'MasterInformatic\filemanagerlaravel\Http\Controllers'], function() {
    //
	Route::get('filemanager/browser','FileManagerController@browser')->name('fmbrowser');

	Route::post('filemanager/upload','FileManagerController@upload')->name('fmupload');

	Route::get('filemanager/ckeditor/browser','FileManagerController@browser_ckeditor')->name('fmckbrowser');

	Route::get('filemanager/ckeditor/upload','FileManagerController@upload_ckeditor')->name('fmckpost');


	Route::get('filemanager/rename','FileManagerController@rename_file')->name('fmrnfile');


	Route::get('filemanager/getfiles','FileManagerController@getfiles')->name('fmgetfiles');

	Route::post('filemanager/copyfiles','FileManagerController@copyfiles')->name('fmcpfiles');

	Route::post('filemanager/download','FileManagerController@download')->name('fmdwnfiles');
	
	Route::post('filemanager/mkdir','FileManagerController@fmkdir');
	Route::post('filemanager/delete','FileManagerController@delete');


	Route::get('filemanager/get/{filename}','FileManagerController@getIm');


	// Route::get('filemanager/copyfiles','FileManagerController@copyfiles')->name('fmcpfiles');
	

}); 




// Route::post('filemanager/ckeditor/upload');
// Route::get('filemanager/ckeditor/browser');