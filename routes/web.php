<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// http://localhost/promolta/public/contact

Route::get('/login', function (){
    return view('login');
});

Route::get('inbox/{id?}', function ($id = 0) {
	$data = [ 'folder' => 'inbox', 'id' => $id ];
    if($id==0){ error_log('Subject');
    	return view('mail', $data);
	}else{ error_log('Single');
		return view('smail', $data);
	}
})->where('id', '[0-9]+');

Route::get('sent/{id?}', function ($id = 0) {
	$data = [ 'folder' => 'sent', 'id' => $id ];
    if($id==0){
    	return view('mail', $data);
	}else{
		return view('smail', $data);
	}
})->where('id', '[0-9]+');

Route::get('drafts/{id?}', function ($id = 0) {
	$data = [ 'folder' => 'drafts', 'id' => $id ];
    if($id==0){
    	return view('mail', $data);
	}else{
		return view('smail', $data);
	}
})->where('id', '[0-9]+');

Route::get('spam/{id?}', function ($id = 0) {
	$data = [ 'folder' => 'spam', 'id' => $id ];
    if($id==0){
    	return view('mail', $data);
	}else{
		return view('smail', $data);
	}
})->where('id', '[0-9]+');

Route::get('trash/{id?}', function ($id = 0) {
	$data = [ 'folder' => 'trash', 'id' => $id ];
    if($id==0){
    	return view('mail', $data);
	}else{
		return view('smail', $data);
	}
})->where('id', '[0-9]+');

