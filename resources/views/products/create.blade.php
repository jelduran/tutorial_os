@extends('layouts.app')
@section('content')
    <div class="container white">
        <h1>Nuevo Producto</h1>
        <!--Form-->
        @include('products.form', ['product' => $product, 'url' => 'products', 'method' => 'POST'])
    </div>
@endsection