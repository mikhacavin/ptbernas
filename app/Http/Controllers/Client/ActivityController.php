<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
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
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $certificationPage = Activity::findOrFail($id);


        if ($request->hasFile('image_url')) {
            if ($certificationPage->image_url) {
                Storage::disk('public')->delete($certificationPage->image_url);
            }

            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/activitypage', $imageName, 'public');
            $certificationPage->image_url = $image_url;
        }

        $certificationPage->title = $request->title;
        $certificationPage->subtitle = $request->subtitle;
        $certificationPage->save();

        return redirect()->route('dashboard.galleries')->with('success', 'Activity page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
