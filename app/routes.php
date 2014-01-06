<?php

/**
 * Package theme example.
 */
Route::group(array('prefix' => 'config'), function()
{
    Route::get('/', function()
    {
        s(Config::get('app.url'));
    });
});

/**
 * SSH run.
 */
Route::group(array('prefix' => 'ssh'), function()
{
    Route::get('/git', function()
    {

    });
});

/**
 * Caching example.
 */
Route::group(array('prefix' => 'cache'), function()
{
    Route::get('/put', function()
    {
        // Tag not support on file, database.
        return Cache::tags('people', 'user:1')->put('name', 'Tee', 10);
    });

    Route::get('/get', function()
    {
        return Cache::tags('people', 'user:1')->get('name');
    });

    Route::get('/flush', function()
    {
        return Cache::tags('people')->flush();
    });
});

/**
 * Eloquent and database example.
 */
Route::group(array('prefix' => 'eloquent'), function()
{
    /**
     * Relationship with scope.
     */
    Route::get('/relation', function()
    {
        $blogs = Blog::with(array('comments' => function($q)
        {
            $q->recent();
        }))
        ->get();

        foreach ($blogs as $blog)
        {
            foreach ($blog->comments as $comment)
            {
                s($comment->toArray());
            }
        }

        sd(DB::getQueryLog());
    });

    /**
     * Eloquent traversal.
     */
    Route::get('/traversal', function()
    {
        // $graph = User::with(array('Applications', 'Applications.PushMessages'))
        //              ->where("users.id", "=", Auth::user()->id)
        //              ->get();

        // $messages = $graph->fetch('applications.pushMessages')->merge();

        $blogs = Blog::with('Comments', 'Comments.Authors')->get();

        sd($blogs->fetch('comments')->toArray());
    });

    /**
     * Eloquent collection merge.
     */
    Route::get('/merge', function()
    {
        $blogs = Blog::get();

        $comments = Comment::get();

        sd( $comments->merge($blogs)->toArray() );
    });
});

/**
 * Package teepluss/restable example.
 */
Route::group(array('prefix' => 'restable'), function()
{
    Route::get('/unprocess', function()
    {
        Input::replace(array(
            'title'       => '',
            'description' => ''
        ));

        $validator = Validator::make(Input::all(), array(
            'title'       => 'required',
            'description' => 'required'
        ));

        if ($validator->fails())
        {
            return Restable::unprocess($validator)->render();
        }

        return 'OK';
    });
});

/**
 * Queue example.
 */
Route::group(array('prefix' => 'queue'), function()
{
    Route::get('/push', function()
    {
        Queue::push('Email@send', array('message' => 'Hellosadasd man!'));
    });
});

/**
 * Nothing here.
 */
Route::get('/', function()
{
	return View::make('hello');
});