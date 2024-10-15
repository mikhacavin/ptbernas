<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Usp;
use Illuminate\Http\Request;

class UspController extends Controller
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
            'specialization' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        Usp::create([
            'specialization' => $request->specialization,
            'desc' => $request->desc,
        ]);

        return redirect()->route('dashboard.home')->with('success', 'USP updated successfully');
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
            'specialization' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        $usp = Usp::findOrFail($id);

        $usp->specialization = $request->specialization;
        $usp->desc = $request->desc;
        $usp->save();

        return redirect()->route('dashboard.home')->with('success', 'USP updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
