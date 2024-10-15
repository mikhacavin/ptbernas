<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\CustomerSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CustomerSupportController extends Controller
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
            'phone' => 'required|string|max:255',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customerSupport = new CustomerSupport();
        $customerSupport->name = $request->name;
        $customerSupport->phone = $request->phone;

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = Str::random(10) . '-' . $image->getClientOriginalName();
            $imageUrl = $image->storeAs('images/customer_support', $imageName, 'public');
            $customerSupport->image_url = $imageUrl;
        }

        if ($customerSupport->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $customerSupport->errors()]);
        }
    }

    public function show(string $id)
    {
        $customerSupport = CustomerSupport::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $customerSupport]);
        } else {
            // return view('client.customer_supports.show', compact('customerSupport'));
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $customerSupport = CustomerSupport::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customerSupport->name = $request->name;
        $customerSupport->phone = $request->phone;

        if ($request->hasFile('image_url')) {
            if ($customerSupport->image_url) {
                $imagePath = public_path('storage/' . $customerSupport->image_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $image = $request->file('image_url');
            $imageName = Str::random(10) . '-' . $image->getClientOriginalName();
            $imageUrl = $image->storeAs('images/customer_support', $imageName, 'public');
            $customerSupport->image_url = $imageUrl;
        }

        if ($customerSupport->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $customerSupport->errors()]);
        }
    }

    public function destroy(string $id)
    {
        $customerSupport = CustomerSupport::findOrFail($id);

        if ($customerSupport->image_url) {
            $imagePath = public_path('storage/' . $customerSupport->image_url);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($customerSupport->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $customerSupport->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomerSupport::orderBy('created_at', 'desc')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit-customer-support btn btn-primary btn-sm" data-customer-support-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete-customer-support btn btn-danger btn-sm" data-customer-support-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
