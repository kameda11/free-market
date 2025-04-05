<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exhibition;
use App\Models\Address;
use App\Models\Purchase;

class ItemController extends Controller
{
    public function add(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity', 1);

        // 商品情報を取得
        $item = Exhibition::findOrFail($itemId);

        // セッションからカートを取得（なければ空の配列）
        $cart = session()->get('cart', []);

        // すでにカートにある場合は数量を追加
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $quantity;
        } else {
            // カートに追加
            $cart[$itemId] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'image' => $item->product_image,
                'quantity' => $quantity,
            ];
        }

        // カートをセッションに保存
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'カートに追加しました。');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function confirm(Request $request)
    {
        $product = Exhibition::findOrFail($request->item_id);
        $quantity = $request->quantity;
        $user = auth()->user();

        // ユーザーの住所を取得（ここでは1件仮定）
        $address = Address::first(); // 実際はuser_idなどで取得

        session([
            'purchase_item_id' => $product->id,
            'purchase_quantity' => $quantity,
        ]);


        return view('purchase', compact('product', 'quantity', 'address'));
    }

}
