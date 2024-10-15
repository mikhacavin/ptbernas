<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\Clients;
use App\Models\Client\ServiceItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends GlobalSettingController
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
            'name' => 'required|string|max:255',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $originalName = $request->file('image_url')->getClientOriginalName();
        $imageName = Str::random(10) . '-' . $originalName;
        $image_url = $request->file('image_url')->storeAs('images/clients', $imageName, 'public');

        $client = new Clients();
        $client->name = $request->name;
        $client->image_url = $image_url;
        if ($client->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $client->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Clients::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $client]);
        } else {
            // return view('client.clients.show', compact('client'));
        }
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
        $client = Clients::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $request->validate($rules);

        if ($request->hasFile('image_url')) {
            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/clients', $imageName, 'public');

            if ($client->image_url) {
                Storage::disk('public')->delete($client->image_url);
            }

            $client->image_url = $image_url;
        }

        $client->name = $request->name;

        if ($client->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $client->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Clients::findOrFail($id);

        if ($client->image_url) {
            $image_path = public_path('storage/' . $client->image_url);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        if ($client->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $client->errors()]);
        }
    }


    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Clients::orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-client-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-client-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function clientsServices(Request $request)
    {
        $this->clients = Clients::all();
        $this->serviceItems = ServiceItems::all();
        return response()->json(['clients' => $this->clients, 'serviceItems' => $this->serviceItems]);
    }
}
