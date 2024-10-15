<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\Hero;
use Illuminate\Http\Request;

class HeroController extends GlobalSettingController
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
            'subtitle' => 'required|string',
            'video_url' => 'nullable|url',
        ]);

        $hero = new Hero();
        $hero->title = $request->title;
        $hero->subtitle = $request->subtitle;
        $hero->video_url = $request->video_url;
        $hero->save();

        return redirect()->route('dashboard.home')->with('success', 'Hero created successfully');
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
        $hero = Hero::findOrFail($id);
        $hero->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'video_url' => $request->video_url,
        ]);
        return redirect()->route('dashboard.home')->with('success', 'Hero updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
