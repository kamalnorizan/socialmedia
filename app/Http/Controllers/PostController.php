<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Yajra\DataTables\Facades\DataTables;
// use DataTables;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::pluck('name', 'id');
        return view('posts.index',compact('users'));
    }

    function ajaxloadposts(Request $request) {
        $posts = Post::with('user');

        return DataTables::of($posts)
            // ->addIndexColumn()
            ->addColumn('author', function($post) {
                return '<strong data-id="'.$post->user->id.'" class="author">' . $post->user->name . '</strong>';
            })
            ->addColumn('title', function($post) {
                return '<strong data-id="'.$post->uuid.'" class="title">' . $post->title . '</strong>';
            })
            ->addColumn('action', function($post) {
                return '<input type="hidden" class="uuid" value="'.$post->uuid.'">';
            })
            ->addColumn('description', function($post) {
                $data = '<span class="data" data-full="'.$post->content.'<span class=\'less\'>See Less</span>" data-less="'.Str::limit($post->content, 50, "<span class='more'>... See More</span>").'">'.Str::limit($post->content, 50, '<span class="more">... See More</span>').'</span>';
                return $data;
            })
            ->addColumn('comments', function($post) {
                return $post->comments->count();
            })
            ->rawColumns(['author','action','title','description'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->user_id = auth()->user()->id;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.create', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $uuid)
    {
        $post = $uuid;
        $post->title = $request->value;
        $post->save();
        return response()->json(['status'=>'success','success' => 'Post updated successfully']);
        // return redirect()->route('posts.index');
    }

    function editor() {
        return view('posts.editor');
    }

    public function updateauthor(Request $request, Post $uuid)
    {
        $post = $uuid;
        $post->user_id = $request->value;
        $post->save();

        $data['user_id'] = $post->user->id;
        $data['value'] = $post->user->name;
        $data['status'] = 'success';
        return response()->json($data);
        // return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
