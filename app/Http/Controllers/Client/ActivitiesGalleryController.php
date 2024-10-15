<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\ActivitiesGallery;
use App\Models\Client\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ActivitiesGalleryController extends GlobalSettingController
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
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'embed_video' => 'nullable|array',
            'embed_video.*' => 'nullable|string',
            'title' => 'required|string|max:255',
        ], [
            'images.*.image' => 'The uploaded file must be an image',
            'images.*.mimes' => 'The uploaded file must be an image with a format of jpeg, png, jpg, or gif',
            'images.*.max' => 'One of the uploaded images is larger than 2MB. Please ensure that all images are within the 2MB size limit.',
        ]);

        $portfolio = Portfolio::where('id', $request->works)->first();
        $portfolio_id = $portfolio ? $portfolio->id : null;

        $dataToInsert = [];

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = Str::random(10) . '-' . $image->getClientOriginalName();
                $imageUrl = $image->storeAs('images/activity', $imageName, 'public');

                $dataToInsert[] = [
                    'portfolio_id' => $portfolio_id,
                    'title' => $request->input('title'),
                    'file_url' => $imageUrl,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Handle embed videos
        if ($request->has('embed_video')) {
            foreach ($request->input('embed_video') as $embedVideoUrl) {
                if (!empty($embedVideoUrl)) {
                    $dataToInsert[] = [
                        'portfolio_id' => $portfolio_id,
                        'title' => $request->input('title'),
                        'file_url' => $embedVideoUrl,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        if (count($dataToInsert) > 0) {
            $insertedRecords = ActivitiesGallery::insert($dataToInsert); // Store the inserted records

            return response()->json([
                'success' => true,
                'message' => 'Data stored successfully!',
                'data' => $insertedRecords,
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'No data to insert.']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activitiesGallery = ActivitiesGallery::with(['portfolio.clients'])->find($id);
        return response()->json([
            'success' => true,
            'data' => $activitiesGallery,
        ]);
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
        // return response()->json(['success' => false, 'message' =>  $request->all()]);
        $request->validate([
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'embed_video' => 'nullable|array',
            'embed_video.*' => 'nullable|string',
            'title' => 'required|string|max:255',
        ], [
            'images.*.image' => 'The uploaded file must be an image',
            'images.*.mimes' => 'The uploaded file must be an image with a format of jpeg, png, jpg, or gif',
            'images.*.max' => 'One of the uploaded images is larger than 2MB. Please ensure that all images are within the 2MB size limit.',
        ]);

        $activitiesGallery = ActivitiesGallery::find($request->activity_id);

        if (!$activitiesGallery) {
            return response()->json(['success' => false, 'message' => 'Data not found.']);
        }

        $portfolio_id = null;
        if (!is_null($request->works)) {
            $portfolio = Portfolio::where('id', $request->works)->first();
            $portfolio_id = $portfolio ? $portfolio->id : null;
        }

        $activitiesGallery->portfolio_id = $portfolio_id;
        $activitiesGallery->title = $request->input('title');

        // Handle image uploads
        if ($request->hasFile('images')) {
            $image = $request->file('images'); // Ambil file gambar
            $originalName = $image->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $image->storeAs('images/activity', $imageName, 'public');

            // Hapus gambar lama jika ada
            if ($activitiesGallery->file_url) {
                $imagePath = public_path('storage/' . $activitiesGallery->file_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Simpan URL gambar ke dalam model
            $activitiesGallery->file_url = $image_url;
        }

        // Handle embed videos
        if ($request->has('embed_video')) {
            $activitiesGallery->file_url = $request->input('embed_video');
        }

        if ($activitiesGallery->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Data updated successfully!',
                'data' => $activitiesGallery,
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update data.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activityGallery = ActivitiesGallery::findOrFail($id);

        if ($activityGallery->file_url) {
            $imagePath = public_path('storage/' . $activityGallery->file_url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $activityGallery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully!',
        ]);
    }

    public function getPortfolio()
    {
        $this->portfolio = Portfolio::with(['clients' => function ($query) {
            $query->select('id', 'name');
        }, 'service_items' => function ($query) {
            $query->select('id', 'name');
        }])->get();
        return response()->json($this->portfolio);
    }


    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = ActivitiesGallery::orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-activity-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-activity-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->editColumn('clients', function ($row) {
                    return $row->clients ? $row->clients->name : '-';
                })
                ->editColumn('portfolio_id', function ($row) {
                    return $row->portfolio ? $row->portfolio->title : '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
