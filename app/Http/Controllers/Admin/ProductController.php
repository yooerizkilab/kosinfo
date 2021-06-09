<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*')->orderBy('created_at', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.product');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->request->add(['password' => Hash::make($request->password)]);
        Product::create($request->all());
    }

    public function show($id)
    {
    }

    public function edit(Product $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, Product $user)
    {
        $user->update($request->all());
    }

    public function destroy(Product $user)
    {
        $user->delete();
    }
}
