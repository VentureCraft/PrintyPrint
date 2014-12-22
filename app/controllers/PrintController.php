<?php

class PrintController extends BaseController
{

    public function create()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        View::make('print.create');
    }

    public function store()
    {
        $task = Input::get('text');
        $post = new Post();
        $post->comment = trim($task);
        $post->save();

        Notification::success('Message added to queue');

        return Redirect::route('print.create');

    }

}
