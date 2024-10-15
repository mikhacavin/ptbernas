<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Portfolio;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolio = Portfolio::with('clients')->get();
        return response()->json(['success' => true, 'data' => $portfolio]);
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
            'client_data' => 'required|exists:clients,id',
            'service_id' => 'required|exists:service_items,id',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        $portfolio = new Portfolio();
        $portfolio->client_id = $request->client_data;
        $portfolio->service_id = $request->service_id;
        $portfolio->title = $request->title;
        $portfolio->date = $request->date;
        $portfolio->location = $request->location;
        $portfolio->desc = $request->desc;
        if ($portfolio->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $portfolio->errors()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $portfolio]);
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
        $request->validate([
            'client_data' => 'required|exists:clients,id',
            'service_id' => 'required|exists:service_items,id',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        $portfolio = Portfolio::findOrFail($request->id);
        $portfolio->client_id = $request->client_data;
        $portfolio->service_id = $request->service_id;
        $portfolio->title = $request->title;
        $portfolio->date = $request->date;
        $portfolio->location = $request->location;
        $portfolio->desc = $request->desc;
        if ($portfolio->update()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $portfolio->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $portfolio->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Portfolio::orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="editPorto btn btn-primary btn-sm" data-portfolio-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="deletePorto btn btn-danger btn-sm" data-portfolio-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->editColumn('service_id', function ($row) {
                    return $row->service_items ? $row->service_items->name : 'N/A';
                })
                ->editColumn('client_id', function ($row) {
                    return $row->clients ? $row->clients->name : 'N/A';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
