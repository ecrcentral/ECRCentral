<?php

namespace App\Http\Controllers;

use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;

use App\Traits\CaptureIpTrait;

use Illuminate\Http\Request;
use Validator;


class PostsController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $posts = new Post;

       $request_append = [];

       if($request->has('q')) {

            $query_string = $request->input('q');

            $request_append['q'] = $query_string;

            $posts = $posts->where('excerpt', 'LIKE', '%' . $query_string . '%')
            ->orWhere('title', 'LIKE', '%' . $query_string . '%')
            ->orWhere('body', 'LIKE', '%' . $query_string . '%');
        }

        if($request->has('category')) {

        $category = Category::where('slug', $request->input('category'))->get();
        $posts = $posts->where('category_id', $category->id);

        }


        $posts = $posts->orderBy('id', 'asc')->paginate(env('USER_LIST_PAGINATION_SIZE'))->appends($request_append);

        $data = [
            'posts' => $posts,
            'categories' => Category::distinct()->get(),
        ];

        return view('posts.show-posts')->with($data);
    }

    public function index_category($category_slug)
    {
       
       $category = Category::where('slug', "=", $category_slug)->get();

       $posts = Post::where('category_id', '=', $category->id)->get();


        $posts = $posts->orderBy('id', 'asc')->paginate(env('USER_LIST_PAGINATION_SIZE'));

        $data = [
            'posts' => $posts,
            'categories' => Category::distinct()->get(),
        ];

        return view('posts.show-posts')->with($data);
    }

    
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        #$post = Post::find($id);
        $post = Post::where('id', '=', $id)->orWhere('slug', '=', $id)->firstOrFail();
        $recent_posts = $posts = Post::orderBy('id', 'asc')->paginate(5);

        $data = [
            'post' => $post,
            'recent_posts' => $recent_posts,
        ];

        return view('posts.show-post')->with($data);
    }

    

    
}