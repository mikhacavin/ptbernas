<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FooterController extends Controller
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
        Footer::findOrFail($id);

        $validatedData = $request->validate([
            'desc' => 'string',
            'quick_links_title' => 'string',
            'other_pages_title' => 'string',
            'socmed_title' => 'string',
            'socmed_desc' => 'string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            if (Footer::findOrFail($id)->image_url) {
                $imagePath = public_path('storage/' . Footer::findOrFail($id)->image_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/footer', $imageName, 'public');
            $validatedData['image_url'] = $image_url;
        }

        Footer::where('id', $id)
            ->update($validatedData);

        return redirect()->route('dashboard.headerFooter')->with('success', 'Footer updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
