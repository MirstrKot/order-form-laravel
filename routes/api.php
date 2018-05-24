<?php

Route::get('/plan/list', 'PlanController@list');
Route::post('/order', 'OrderController@store');
