@extends('layouts.master')

@section('title', 'Books')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Book Inventory</h3>
    <a href="{{ route('books.create') }}" class="btn btn-dark">+ Add Book</a>
</div>

<div class="card shadow-sm">
    <table class="table table-hover mb-0 align-middle">
        <thead class="table-light">
            <tr><th>Title</th><th>Author</th><th>Category</th><th>Price</th><th>Status</th><th class="text-end">Actions</th></tr>
        </thead>
        <tbody>
        @forelse ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category }}</td>
                <td>₱{{ number_format($book->unit_price, 2) }}</td>
                <td>
                    <span class="badge {{ $book->availability_status === 'Available' ? 'bg-success' : 'bg-danger' }}">
                        {{ $book->availability_status }}
                    </span>
                </td>
                <td class="text-end">
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                    {{-- DELETE needs @method('DELETE'); confirm() asks before deleting --}}
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this book record?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-4">No books yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $books->links('pagination::bootstrap-5') }}</div>
@endsection