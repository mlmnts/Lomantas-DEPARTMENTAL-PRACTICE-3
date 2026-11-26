<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h2 { color: #212529; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 5px; text-align: left; }
        th { background: #e9ecef; }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>
        Category: {{ $filters['category'] ?? 'All' }} |
        Availability: {{ $filters['availability_status'] ?? 'All' }}<br>
        Generated: {{ now()->format('M d, Y h:i A') }} | Records: {{ $books->count() }}
    </p>
    <table>
        <thead><tr><th>Title</th><th>Author</th><th>Category</th><th>Price</th><th>Availability</th></tr></thead>
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
            <tr><td colspan="5">No books match the selected filters.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>