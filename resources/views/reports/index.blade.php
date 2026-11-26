@extends('layouts.master')

@section('title', 'Reports')

@section('content')
<h3>Book Inventory Reports</h3>

{{-- GET form: filters live in the URL, so the export buttons reuse them --}}
<form method="GET" action="{{ route('reports.index') }}" class="card card-body shadow-sm mb-3">
    <div class="row g-2">
        <div class="col-md-3">
            <label class="form-label">Report</label>
            <select name="type" class="form-select">
                @foreach ($types as $key => $label)
                    <option value="{{ $key }}" @selected($type === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
                <option value="">All</option>
                @foreach (\App\Models\Book::CATEGORIES as $cat)
                    <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Availability</label>
            <select name="availability_status" class="form-select">
                <option value="">All</option>
                @foreach (\App\Models\Book::STATUSES as $status)
                    <option value="{{ $status }}" @selected(request('availability_status') === $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end gap-2 flex-wrap">
            <button class="btn btn-dark">Generate</button>
            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary">Reset Filters</a>
            <a href="{{ route('reports.pdf', request()->query()) }}" class="btn btn-danger">PDF</a>
            <a href="{{ route('reports.excel', request()->query()) }}" class="btn btn-success">Excel</a>
        </div>
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">{{ $title }} ({{ $books->count() }})</div>
    <table class="table mb-0">
        <thead class="table-light">
            <tr><th>Title</th><th>Author</th><th>Category</th><th>Price</th><th>Availability</th></tr>
        </thead>
        <tbody>
        @forelse ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category }}</td>
                <td>₱{{ number_format($book->unit_price, 2) }}</td>
                <td>{{ $book->availability_status }}</td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted py-3">No books match the selected filters.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection