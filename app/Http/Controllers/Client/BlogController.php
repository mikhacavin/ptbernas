<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $blogPage = Blog::findOrFail($id);

        $request->validate([
            'title' => 'string|max:255',
            'subtitle' => 'string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            if ($blogPage->image_url) {
                $imagePath = public_path('storage/' . $blogPage->image_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/blogpage', $imageName, 'public');
            $blogPage->image_url = $image_url;
        }

        $blogPage->title = $request->title;
        $blogPage->subtitle = $request->subtitle;

        if ($blogPage->save()) {
            return redirect()->route('dashboard.blog')->with('success', 'Blog page updated successfully');
        } else {
            return back()->with('error', 'Failed to update blog page');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
