<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\SocialMediaList;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SocialMediaListController extends GlobalSettingController
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
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image_url');
        $imageName = Str::random(10) . '-' . $image->getClientOriginalName();
        $image_url = $image->storeAs('images/sosmed', $imageName, 'public');


        $data = new SocialMediaList();
        $data->title = $request->title;
        $data->name = $request->name;
        $data->url = $request->url;
        $data->icon =  $request->icon;
        $data->image_url = $image_url;
        $data->save();

        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $socialmedialist = SocialMediaList::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $socialmedialist]);
        } else {
            // return view('client.socialmedialist.show', compact('socialmedialist'));
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
        $socialmedialist = SocialMediaList::findOrFail($id);

        $rules = [
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $request->validate($rules);

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = Str::random(10) . '-' . $image->getClientOriginalName();
            $image_url = $image->storeAs('images/sosmed', $imageName, 'public');

            if ($socialmedialist->image_url) {
                $image_path = public_path('storage/' . $socialmedialist->image_url);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $socialmedialist->image_url = $image_url;
        }

        $socialmedialist->title = $request->title;
        $socialmedialist->name = $request->name;
        $socialmedialist->url = $request->url;
        $socialmedialist->icon = $request->icon;
        if ($socialmedialist->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $socialmedialist->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $socialmedialist = SocialMediaList::findOrFail($id);

        if ($socialmedialist->image_url) {
            $image_path = public_path('storage/' . $socialmedialist->image_url);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        if ($socialmedialist->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $socialmedialist->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = SocialMediaList::orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-sosmed-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-sosmed-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
