<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Client\Contact;
use App\Models\Client\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function submit(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        try {
            // Send the email
            $adminEmail = Setting::where('id', 1)->value('email');
            Mail::to($adminEmail)->send(new ContactMail((object)$validatedData));

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us. We will get back to you shortly.'
            ]);
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'There was an error sending your message. Please try again later.'
            ], 500);
        }
    }
}
