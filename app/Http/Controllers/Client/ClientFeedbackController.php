<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\ClientFeedback;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientFeedbackController extends Controller
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
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:client_feedback',
        ]);

        $request->merge([
            'active' => $request->has('active') && $request->active == 'on' ? 1 : 0,
        ]);

        $clientFeedback = new ClientFeedback();
        $clientFeedback->client_id = $request->client_id;
        $clientFeedback->title = $request->title;
        $clientFeedback->active = $request->active;
        $clientFeedback->slug = $request->slug;
        if ($clientFeedback->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $clientFeedback->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clientFeedback = ClientFeedback::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $clientFeedback]);
        } else {
            // return view('client.client-feedback.show', compact('clientFeedback'));
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
        $clientFeedback = ClientFeedback::findOrFail($id);

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'title' => 'required|string|max:255',
            'slug' => $request->slug != $clientFeedback->slug ? 'required|string|unique:client_feedback' : 'required|string',
        ]);

        $request->merge([
            'active' => $request->has('active') && $request->active == 'on' ? 1 : 0,
        ]);


        $clientFeedback->client_id = $request->client_id;
        $clientFeedback->title = $request->title;
        $clientFeedback->active = $request->active;
        $clientFeedback->slug = $request->slug;
        if ($clientFeedback->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $clientFeedback->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clientFeedback = ClientFeedback::findOrFail($id);

        if ($clientFeedback->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $clientFeedback->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = ClientFeedback::orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-client-feedback-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-client-feedback-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->editColumn('client_id', function ($row) {
                    return $row->clients ? $row->clients->name : 'N/A';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
