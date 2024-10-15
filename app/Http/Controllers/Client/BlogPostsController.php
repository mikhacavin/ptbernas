<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\BlogPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostsController extends GlobalSettingController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:blog_posts,slug',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $originalName = $request->file('thumbnail')->getClientOriginalName();
        $imageName = Str::random(10) . '-' . $originalName;
        $image_url = $request->file('thumbnail')->storeAs('images/blog', $imageName, 'public');

        $blogPost = new BlogPosts();
        $blogPost->title = $request->title;
        $blogPost->author_id =  Auth::id();
        $blogPost->slug = $request->slug;
        $blogPost->thumbnail = $image_url;
        $blogPost->desc = $request->desc;
        $blogPost->excerpt = Str::limit(strip_tags($request->desc), 200);
        $blogPost->category_id = $request->category_id;
        if ($blogPost->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $blogPost->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceItems = BlogPosts::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $serviceItems]);
        } else {
            // return view('client.service-items.show', compact('serviceItems'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blogPost = BlogPosts::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => $request->slug != $blogPost->slug ? 'required|string|unique:blog_posts,slug' : 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'desc' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            $originalName = $request->file('thumbnail')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $thumbnail = $request->file('thumbnail')->storeAs('images/blog', $imageName, 'public');

            // remove old image
            if ($blogPost->thumbnail) {
                Storage::disk('public')->delete($blogPost->thumbnail);
            }
            $blogPost->thumbnail = $thumbnail;
        }



        $blogPost->title = $request->title;
        $blogPost->author_id =  Auth::id();
        $blogPost->slug = $request->slug;
        $blogPost->desc = $request->desc;
        $blogPost->excerpt = Str::limit(strip_tags($request->desc), 200);
        $blogPost->category_id = $request->category_id;
        if ($blogPost->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $blogPost->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blogPost = BlogPosts::findOrFail($id);

        if ($blogPost->thumbnail) {
            Storage::disk('public')->delete($blogPost->thumbnail);
        }

        if ($blogPost->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $blogPost->errors()]);
        }
    }


    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = BlogPosts::with('category')->orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-blogpost-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-blogpost-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
