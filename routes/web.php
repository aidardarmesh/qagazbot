<?php

Auth::routes();

// Бот
Route::post('/vk_bot', 'VkBotController@messageNew');

// Домашняя страница
Route::get('/home', 'HomeController@index');

Route::get('link', function(){
	return '{"type":"message_new","object":{"id":1193,"date":1520871169,"out":0,"user_id":207690737,"read_state":0,"title":"","body":"","attachments":[{"type":"doc","doc":{"id":446688146,"owner_id":207690737,"title":"PDF.pdf","size":4967272,"ext":"pdf","url":"https:\/\/vk.com\/doc207690737_446688146?hash=46c657e80431c00b41&dl=GIYDONRZGA3TGNY:1520871169:78bbda10d17923d21a&api=1&no_preview=1","date":1497029386,"type":1,"access_key":"df36717f54f744ef6d"}}]},"group_id":152165726,"secret":"sdf23rfsd98m9n"}';
});

Route::get('/after', 'InvoiceController@after');

// Клиенты
Route::get('/clients', 'ClientsViewController@index');
Route::get('/clients/addGet', 'ClientsViewController@addGet');
Route::post('/clients/addPost', 'ClientsViewController@addPost');
Route::get('/clients/{client}', 'ClientsViewController@details');
Route::get('/clients/{client}/editGet', 'ClientsViewController@editGet');
Route::post('/clients/{client}/editPost', 'ClientsViewController@editPost');
Route::get('/clients/{client}/delete', 'ClientsViewController@delete');

// Заказы
Route::get('/orders', 'OrdersViewController@index');
Route::get('/orders/addGet', 'OrdersViewController@addGet');
Route::post('/orders/addPost', 'OrdersViewController@addPost');
Route::get('/orders/{order}', 'OrdersViewController@details');
Route::get('/orders/{order}/editGet', 'OrdersViewController@editGet');
Route::post('/orders/{order}/editPost', 'OrdersViewController@editPost');
Route::get('/orders/{order}/delete', 'OrdersViewController@delete');

// Инвойсы
Route::get('/invoices', 'InvoicesViewController@index');
Route::get('/invoices/{invoice}', 'InvoicesViewController@details');
Route::get('/invoices/{invoice}/delete', 'InvoicesViewController@delete');

// Терминалы
Route::get('/terminals', 'TerminalsViewController@index');
Route::get('/terminals/addGet', 'TerminalsViewController@addGet');
Route::post('/terminals/addPost', 'TerminalsViewController@addPost');
Route::get('/terminals/{terminal}', 'TerminalsViewController@details');
Route::get('/terminals/{terminal}/editGet', 'TerminalsViewController@editGet');
Route::post('/terminals/{terminal}/editPost', 'TerminalsViewController@editPost');
Route::get('/terminals/{terminal}/delete', 'TerminalsViewController@delete');

// Оплата
Route::get('/invoice/{order}', 'InvoiceController@invoice');
Route::get('/backlink', 'InvoiceController@backlink');
Route::get('/fail_backlink', 'InvoiceController@fail_backlink');
Route::post('/postlink', 'InvoiceController@postlink');
Route::get('/fail_postlink', 'InvoiceController@fail_postlink');

// Выгрузка заказов
Route::get('/order/{id}', 'TerminalController@order');
Route::get('/terminal/{terminal_id}/printed/{order}', 'TerminalController@printed');
Route::get('/terminal/{terminal}/info', 'TerminalController@info');