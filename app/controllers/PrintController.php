<?php

class PrintController extends BaseController
{

    public function create()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->get();

        return View::make('print.create')
            ->withPosts($posts);
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

    public function reprint($id)
    {
        $post = Post::find($id);
        if (!$post) {
            Notification::error('Post not found');
            return Redirect::route('route.create');
        }
        $post->printed_at = NULL;
        $post->save();

        Notification::success('Re printing');
        return Redirect::route('route.create');

    }

    public function cancel($id)
    {
        $post = Post::find($id);
        if (!$post) {
            Notification::error('Post not found');
            return Redirect::route('print.create');
        }
        $post->delete();

        Notification::success('Deleted');
        return Redirect::route('print.create');

    }

}
