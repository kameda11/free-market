@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="product-detail">
    <h2>{{ $product->name }}</h2>
    <img src="{{ asset($product->product_image) }}" alt="商品画像" class="product-image">
    <p>{{ $product->detail }}</p>
    <p>価格：&yen; {{ number_format($product->price) }}</p>

    <form action="{{ route('purchase.confirm') }}" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">
        <button type="submit">購入手続きへ</button>
    </form>
</div>
@endsection