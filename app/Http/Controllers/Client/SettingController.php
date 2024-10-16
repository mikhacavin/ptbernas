<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
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
        $setting = Setting::findOrFail($id);

        $rules = [
            'site_name' => 'required|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $request->validate($rules);

        if ($request->hasFile('image_url')) {
            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/setting', $imageName, 'public');

            if ($setting->image_url) {
                Storage::disk('public')->delete($setting->image_url);
            }

            $setting->image_url = $image_url;
        }

        $setting->site_name = $request->site_name;
        $setting->email = $request->email;

        if ($setting->save()) {
            return redirect()->route('dashboard.setting')->with('success', 'data updated successfully');
        } else {
            return response()->json(['success' => false, 'errors' => $setting->errors()]);
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
