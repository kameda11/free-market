<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Exhibition;

class UserController extends Controller
{
    //
    public function index()
    {
        $exhibitions = Exhibition::all();
        return view('index', compact('exhibitions'));
    }

    public function detail($id)
    {
        $product = Exhibition::findOrFail($id);
        return view('detail', compact('product'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'profiles_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profiles_image')) {
            // 画像を storage/app/public/profiles に保存
            $path = $request->file('profiles_image')->store('profiles', 'public');
            $user->profiles_image = $path;
        }

        $user->save();

        return back()->with('success', 'プロフィール画像を更新しました');
    }

    public function edit()
    {
        $user = auth()->user();
        $address = $user->address;
        return view('edit', compact('user'));
    }

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'post_code' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $address = auth()->user()->address; // ログインユーザーに紐づく住所を更新

        // ユーザーが住所を持っていない場合、新しく作成する
        if (!$address) {
            $address = new Address();
            $address->user_id = auth()->id();
        }

        $address->update($validated);

        return redirect()->route('purchase.confirm', [
            'id' => session('purchase_item_id'),
            'quantity' => session('purchase_quantity'),
        ])->with('success', '住所を更新しました');
    }
}
