<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
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
        Contact::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'string',
            'address_title' => 'string',
            'call_title' => 'string',
            'email_title' => 'string',
            'open_title' => 'string',
            'desc' => 'string',
            'address_desc' => 'string',
            'call_desc' => 'string',
            'email_desc' => 'string',
            'open_desc' => 'string',
            'maps_embed' => 'string',
        ]);

        Contact::where('id', $id)
            ->update($validatedData);

        return redirect()->route('dashboard.contact')->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
