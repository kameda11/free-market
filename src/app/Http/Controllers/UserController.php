<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    //
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

        $path = $request->file('profiles_image')->store('profiles', 'public');

        return back()->with('success', 'プロフィール画像を更新しました');
    }

}
