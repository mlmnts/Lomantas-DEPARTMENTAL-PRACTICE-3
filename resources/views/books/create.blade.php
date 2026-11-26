@extends('layouts.master')

@section('title', 'Add Book')

@section('content')
<h3>Add Book</h3>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('books.store') }}">
        @csrf
        @include('books._form')
    </form>
</div></div>
@endsection