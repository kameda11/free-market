@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div>コンテンツを追加してください</div>
<label for="post_code">郵便番号</label>
<input type="text" name="post_code" id="post_code" value="{{ old('post_code') }}" placeholder="123-4567">

<label for="address">住所</label>
<input type="text" name="address" id="address" value="{{ old('address') }}" required>

<label for="building">建物名</label>
<input type="text" name="building" id="building" value="{{ old('building') }}">

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="profiles_image">プロフィール画像</label>
    <input type="file" name="profiles_image" id="profiles_image">
    <button type="submit">アップロード</button>
</form>
<img src="{{ asset('storage/' . $user->profiles_image) }}" alt="プロフィール画像" width="100">
@endsection