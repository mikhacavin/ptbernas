<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends GlobalSettingController
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
            'short_desc' => 'required',
            'desc' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'team_title' => 'required|string|max:255',
            'team_desc' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $originalName = $request->file('image_url')->getClientOriginalName();
        $imageName = Str::random(10) . '-' . $originalName;
        $image_url = $request->file('image_url')->storeAs('images/about', $imageName, 'public');

        About::create([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'desc' => $request->desc,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'team_title' => $request->team_title,
            'team_desc' => $request->team_desc,
            'image_url' => $image_url,
        ]);

        return redirect()->route('dashboard.about')->with('success', 'About created successfully');
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
        if ($request->has('team_title')) {
            $request->validate([
                'team_title' => 'required|string|max:255',
                'team_desc' => 'required',
            ]);

            $about = About::findOrFail($id);

            $about->team_title = $request->team_title;
            $about->team_desc = $request->team_desc;
            $about->save();

            return redirect()->route('dashboard.about')->with('success', 'About team title and description updated successfully');
        } else {
            $request->validate([
                'title' => 'required|string|max:255',
                'short_desc' => 'required',
                'desc' => 'required',
                'vision' => 'required',
                'mission' => 'required',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $about = About::findOrFail($id);

            if ($request->hasFile('image_url')) {
                if ($about->image_url) {
                    Storage::disk('public')->delete($about->image_url);
                }

                $originalName = $request->file('image_url')->getClientOriginalName();
                $imageName = Str::random(10) . '-' . $originalName;
                $image_url = $request->file('image_url')->storeAs('images/about', $imageName, 'public');

                $about->image_url = $image_url;
            }

            $about->title = $request->title;
            $about->short_desc = $request->short_desc;
            $about->desc = $request->desc;
            $about->vision = $request->vision;
            $about->mission = $request->mission;
            $about->save();

            return redirect()->route('dashboard.about')->with('success', 'About updated successfully');
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
