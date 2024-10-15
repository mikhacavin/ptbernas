<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TeamsController extends Controller
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
            'title' => 'required|string|max:255',
            'index' => 'nullable|integer|between:0,999',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $originalName = $request->file('image_url')->getClientOriginalName();
        $imageName = Str::random(10) . '-' . $originalName;
        $image_url = $request->file('image_url')->storeAs('images/teams', $imageName, 'public');

        $team = new Teams();
        $team->name = $request->name;
        $team->title = $request->title;
        $team->index = $request->index;
        $team->image_url = $image_url;
        if ($team->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $team->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Teams::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $team]);
        } else {
            // return view('client.teams.show', compact('team'));
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
        $team = Teams::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'index' => 'nullable|integer|between:0,999',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $request->validate($rules);

        if ($request->hasFile('image_url')) {
            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/teams', $imageName, 'public');

            if ($team->image_url) {
                Storage::disk('public')->delete($team->image_url);
            }

            $team->image_url = $image_url;
        }

        $team->name = $request->name;
        $team->title = $request->title;
        $team->index = $request->index;
        if ($team->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $team->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Teams::findOrFail($id);

        if ($team->image_url) {
            $image_path = public_path('storage/' . $team->image_url);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        if ($team->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $team->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Teams::orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-team-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-team-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
