<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\FooterLinks;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FooterLinksController extends Controller
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
            'link' => 'required|string|max:255',
            'type' => 'required|in:0,1',
        ]);

        $footerLink = new FooterLinks();
        $footerLink->title = $request->title;
        $footerLink->link = $request->link;
        $footerLink->type = $request->type;
        if ($footerLink->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $footerLink->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $footerLink = FooterLinks::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $footerLink]);
        } else {
            // return view('client.footer_links.show', compact('footerLink'));
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
        $footerLink = FooterLinks::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'type' => 'required|in:0,1',
        ]);

        $footerLink->title = $request->title;
        $footerLink->link = $request->link;
        $footerLink->type = $request->type;
        if ($footerLink->update()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $footerLink->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerLink = FooterLinks::findOrFail($id);

        if ($footerLink->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $footerLink->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = FooterLinks::orderBy('created_at', 'asc')->select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit-footer btn btn-primary btn-sm" data-footer-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete-footer btn btn-danger btn-sm" data-footer-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
