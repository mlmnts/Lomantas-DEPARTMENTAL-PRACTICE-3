@extends('layouts.master')

@section('title', $book->title)

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h3>{{ $book->title }}</h3>
    <dl class="row">
        <dt class="col-sm-3">Author</dt><dd class="col-sm-9">{{ $book->author }}</dd>
        <dt class="col-sm-3">Category</dt><dd class="col-sm-9">{{ $book->category }}</dd>
        <dt class="col-sm-3">Unit Price</dt><dd class="col-sm-9">₱{{ number_format($book->unit_price, 2) }}</dd>
        <dt class="col-sm-3">Availability</dt><dd class="col-sm-9">{{ $book->availability_status }}</dd>
        <dt class="col-sm-3">Description</dt><dd class="col-sm-9">{{ $book->description }}</dd>
        <dt class="col-sm-3">Added By</dt><dd class="col-sm-9">{{ $book->user->name }}</dd>
    </dl>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
</div></div>
@endsection