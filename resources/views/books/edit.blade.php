@extends('layouts.master')

@section('title', 'Edit Book')

@section('content')
<h3>Edit Book</h3>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('books.update', $book) }}">
        @csrf @method('PUT')
        @include('books._form')
    </form>
</div></div>
@endsection