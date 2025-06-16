@extends('layout')

@section('title', 'Edit Product')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.products.form', ['product' => $product])

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
