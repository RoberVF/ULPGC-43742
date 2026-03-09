@extends('layouts.app')

@section('content')
    <h1>Catálogo de Productos Sostenibles</h1>

    @if($tipo)
        <p>Filtrando por: <strong>{{ $tipo }}</strong> | <a href="{{ route('products.index') }}">Ver todos</a></p>
    @endif

    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h3>{{ $product->productType->name }}</h3>
                <p><strong>Productor:</strong> {{ $product->producer->user->name }}</p>
                <p><strong>Precio:</strong> {{ $product->price }} €/{{ $product->unit_measure }}</p>
                <p><strong>Stock disponible:</strong> {{ $product->stock }} {{ $product->unit_measure }}</p>
                <p><small>Recogido el: {{ $product->collect_date }}</small></p>
            </div>
        @endforeach
    </div>
@endsection