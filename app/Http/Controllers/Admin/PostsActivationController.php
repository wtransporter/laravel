<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsActivationController extends Controller
{
    public function update(Post $post)
    {
		// dd(request()->boolean('activated'));
		if (request()->boolean('activated')) {
		    $post->activate();
		    $message = 'Post activated';
		} else {
			$post->deactivate();
			$message = 'Post deactivated';
		}

		if (request()->wantsJson()) {
            return response([], 204);
        }

    	return redirect('/posts')->with('status', $message);
    }
}
