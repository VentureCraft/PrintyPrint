<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return Redirect::to('http://www.venturecraft.com.au');
});

Route::post('print', function(){
    $trigger = Input::get('trigger_word');
    $task = str_replace($trigger, '', Input::get('text'));

    $post = new Post();
    $post->comment = trim($task);
    $post->save();

    return Response::json(['text' => "On it, " . Input::get('user_name') . "\nPrinting: _" . $task . "_"]);
});

Route::get('printed', function(){
    if(!Input::has('test')) {
        $post = Post::find(Input::get('id'));
        $post->printed_at = Carbon\Carbon::now();
        $post->save();
    }
    return Response::json(['response' => 'Printed: ' . $post->comment]);
});

Route::get('latest', function(){

    $posts = Post::whereNull('printed_at')->get();
    $to_print = [];
    foreach ($posts as $post) {
        $to_print[] = [
            'id' => $post->id,
            'task' => $post->comment
        ];
    }

    return Response::json($to_print);
});

Route::get('print/create', ['uses' => 'PrintController@create', 'as' => 'print.create']);
Route::post('print/store', ['uses' => 'PrintController@store', 'as' => 'print.store']);

Route::get('print/cancel/{id}', ['uses' => 'PrintController@cancel', 'as' => 'print.cancel']);
Route::get('print/reprint/{id}', ['uses' => 'PrintController@reprint', 'as' => 'print.reprint']);
