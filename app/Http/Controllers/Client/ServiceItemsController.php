<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\ServiceItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ServiceItemsController extends GlobalSettingController
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
            'slug' => 'required|unique:service_items',
            'desc' => 'required',
            'short_desc' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'icon_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $originalName = $request->file('image_url')->getClientOriginalName();
        $imageName = Str::random(10) . '-' . $originalName;
        $image_url = $request->file('image_url')->storeAs('images/services', $imageName, 'public');

        $originalName = $request->file('icon_url')->getClientOriginalName();
        $iconName = Str::random(10) . '-' . $originalName;
        $icon_url = $request->file('icon_url')->storeAs('images/services', $iconName, 'public');

        $serviceItems = new ServiceItems();
        $serviceItems->name = $request->name;
        $serviceItems->slug = $request->slug;
        $serviceItems->desc = $request->desc;
        $serviceItems->short_desc = $request->short_desc;
        $serviceItems->image_url = $image_url;
        $serviceItems->icon_url = $icon_url;
        if ($serviceItems->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $serviceItems->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceItems = ServiceItems::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $serviceItems]);
        } else {
            // return view('client.service-items.show', compact('serviceItems'));
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
        $serviceItems = ServiceItems::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'desc' => 'required',
            'short_desc' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'icon_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
        if ($request->slug != $serviceItems->slug) {
            $rules['slug'] = 'required|unique:service_items';
        }

        $request->validate($rules);

        if ($request->hasFile('image_url')) {
            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/services', $imageName, 'public');

            if ($serviceItems->image_url) {
                Storage::disk('public')->delete($serviceItems->image_url);
            }

            $serviceItems->image_url = $image_url;
        }

        if ($request->hasFile('icon_url')) {
            $originalName = $request->file('icon_url')->getClientOriginalName();
            $iconName = Str::random(10) . '-' . $originalName;
            $icon_url = $request->file('icon_url')->storeAs('images/services', $iconName, 'public');

            if ($serviceItems->icon_url) {
                Storage::disk('public')->delete($serviceItems->icon_url);
            }

            $serviceItems->icon_url = $icon_url;
        }

        $serviceItems->name = $request->name;
        $serviceItems->slug = $request->slug;
        $serviceItems->desc = $request->desc;
        $serviceItems->short_desc = $request->short_desc;
        if ($serviceItems->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $serviceItems->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceItems = ServiceItems::findOrFail($id);

        if ($serviceItems->image_url) {
            $image_path = public_path('storage/' . $serviceItems->image_url);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        if ($serviceItems->icon_url) {
            $icon_path = public_path('storage/' . $serviceItems->icon_url);
            if (File::exists($icon_path)) {
                File::delete($icon_path);
            }
        }

        if ($serviceItems->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $serviceItems->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = ServiceItems::orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-service-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-service-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
