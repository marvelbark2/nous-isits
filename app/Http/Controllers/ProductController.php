<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Products;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $cate = $request->input('cate');
        $prod = $request->input('name');
        if (!empty($cate)) {
            $items = Products::where('categorie', 'LIKE', $cate)
                        ->paginate(50);
        }
        elseif (!empty($prod)) {
            $items = Products::where('product', 'LIKE', '%'.$prod.'%')
                        ->paginate(50);
        }
        else{
            $items = Products::paginate(50);
        }

        $cat = Products::select('categorie')->distinct()->get();
       return view('products.index', compact('items', 'cat'));
    //    return response()->json([
    //     'category' => $cate,
    //     'data' => $items
    //    ], 200);
    }
    public function addtolist(Product $id)
    {
        $totalp += $id;
    }
    public function importView()
    {
       return view('products.import');
    }
    public function import()
    {
        Excel::import(new ProductsImport,request()->file('file'));

        return back();
    }
}
