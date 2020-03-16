<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use App\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Список продуктов
     *
     * @return Factory|View
     */
    public function index()
    {
        $products = Product::with('vendor')->orderBy('name')->paginate(25);
        return view('products.index',compact('products'));
    }

    /**
     * Изменить цену
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function editPrice(Request $request, $id)
    {
        try {
            DB::transaction(function() use($request,$id)
            {
                Product::where('id', $id)->update(['price' => $request->price]);

                OrderProduct::where('product_id', $id)->update(['price' => $request->price]);
            });

            return response()->json(['success'=>true]);
        }catch (\Exception $e){
            return response()->json(['success'=>false,'error'=>$e->getMessage()]);
        }
    }
}
