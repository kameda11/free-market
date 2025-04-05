@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content">
    @foreach($exhibitions as $exhibition)
    <div class="l-wrapper">
        <article class="card">
            <div class="card__header">
                <h3 class="card__title">{{$exhibition->name}}</h3>
                <figure class="card__thumbnail">
                    <img src="{{$exhibition->product_image}}" alt="image" class="card__image">
                </figure>
            </div>
            <div class="card__body">
                <p class="card__text">{{$exhibition->detail}}</p>
                <p class="card__text--number">&yen; {{number_format($exhibition->price)}}</p>
            </div>
            <div class="card__footer">
                <p class="card__text">
                    <a href="{{ route('detail', $exhibition->id) }}" class="card__button card__button--compact">商品詳細を見る</a>
                </p>
                <form action="{{ route('detail', ['id' => $exhibition->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="{{$exhibition->id}}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="card__button--add">カートに入れる</button>
                </form>
            </div>
        </article>
    </div>
    @endforeach
</div>
@endsection