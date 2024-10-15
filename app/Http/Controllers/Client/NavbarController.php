<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GlobalSettingController;
use App\Models\Client\Navbar;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NavbarController extends GlobalSettingController
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
            'url' => 'required|string|max:255',
            'index' => 'required|integer',
            'parent' => 'nullable|exists:navbars,id',
        ]);

        $navbar = new Navbar();
        $navbar->name = $request->name;
        $navbar->url = $request->url;
        $navbar->index = $request->index;
        $navbar->parent = $request->parent;
        if ($navbar->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $navbar->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $navbar = Navbar::findOrFail($id);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'data' => $navbar]);
        } else {
            // return view('client.navbars.show', compact('navbar'));
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
        $navbar = Navbar::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'index' => 'required|integer',
            'parent' => 'nullable|exists:navbars,id|not_in:' . $id,
        ]);

        $navbar->name = $request->name;
        $navbar->url = $request->url;
        $navbar->index = $request->index;
        $navbar->parent = $request->parent;
        if ($navbar->update()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $navbar->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $navbar = Navbar::findOrFail($id);

        $navbarsHasParent = Navbar::where('parent', $id)->get();

        foreach ($navbarsHasParent as $navbarHasParent) {
            $navbarHasParent->parent = null;
            $navbarHasParent->save();
        }

        if ($navbar->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'errors' => $navbar->errors()]);
        }
    }

    public function queryDatatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Navbar::orderBy('created_at', 'asc')->select('*');
            $navbars = Navbar::pluck('name', 'id')->toArray();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-menu-id="' . $row->id . '">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-menu-id="' . $row->id . '">Delete</a>';
                    return $btn;
                })
                ->editColumn('parent', function ($row) use ($navbars) {
                    return array_key_exists($row->parent, $navbars) ? $navbars[$row->parent] : '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }




    public function getNavbar()
    {
        $this->navbar = Navbar::all();
        $this->indexNavbar = Navbar::all()->count() + 1;
        return response()->json(['navbar' => $this->navbar, 'index' => $this->indexNavbar]);
    }
}
