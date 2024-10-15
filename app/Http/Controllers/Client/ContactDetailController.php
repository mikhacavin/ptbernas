<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\ContactDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactDetailController extends Controller
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
        $contactDetail = ContactDetails::findOrFail($id);

        $request->validate([
            'page_title' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            if ($contactDetail->image_url) {
                $imagePath = public_path('storage/' . $contactDetail->image_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/contactpage', $imageName, 'public');
            $contactDetail->image_url = $image_url;
        }

        $contactDetail->page_title = $request->page_title;
        $contactDetail->name = $request->title;
        $contactDetail->subtitle = $request->subtitle;
        $contactDetail->save();

        return redirect()->route('dashboard.contact')->with('success', 'Contact Detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
