<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\TestimonialList;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestimonialListController extends Controller
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
            'client_feedback_id' => 'nullable|exists:client_feedback,id',
            'rating' => 'required|numeric',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'desc' => 'required|string',
            'show' => 'nullable',
        ]);

        $request->merge([
            'show' => $request->has('show') && $request->show == 'on' ? 1 : 0,
        ]);

        $testimonialList = new TestimonialList();
        $testimonialList->client_feedback_id = $request->client_feedback_id;
        $testimonialList->rating = $request->rating;
        $testimonialList->name = $request->name;
        $testimonialList->position = $request->position;
        $testimonialList->desc = $request->desc;
        $testimonialList->show = $request->show;
        if ($testimonialList->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $testimonialList->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonialList = TestimonialList::with('clientFeedback', 'clients')->findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $testimonialList]);
        } else {
            // return view('client.testimonial-list.show', compact('testimonialList'));
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
        $testimonialList = TestimonialList::findOrFail($id);

        $request->validate([
            'client_feedback_id' => $request->client_feedback_id ? 'nullable|exists:client_feedback,id' : 'nullable',
            'rating' => 'required|numeric',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'desc' => 'required|string',
            'show' => 'nullable',
        ]);

        $request->merge([
            'show' => $request->has('show') && $request->show == 'on' ? 1 : 0,
        ]);

        $testimonialList->client_feedback_id = $request->client_feedback_id;
        $testimonialList->rating = $request->rating;
        $testimonialList->name = $request->name;
        $testimonialList->position = $request->position;
        $testimonialList->desc = $request->desc;
        $testimonialList->show = $request->show;
        if ($testimonialList->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $testimonialList->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonialList = TestimonialList::findOrFail($id);

        if ($testimonialList->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $testimonialList->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = TestimonialList::with('clients', 'clientFeedback')
                ->orderBy('created_at', 'desc')
                ->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit-testimonial btn btn-primary btn-sm" data-testimonial-list-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete-testimonial btn btn-danger btn-sm" data-testimonial-list-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->editColumn('client_feedback_id', function ($row) {
                    return $row->client_feedback_id ? $row->clientFeedback->title . ' - ' . $row->clients->name : 'Public Form';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
