<div class="mb-3">
    <label class="form-label">Book Title</label>
    <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}"
           class="form-control @error('title') is-invalid @enderror">
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Author</label>
    <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}"
           class="form-control @error('author') is-invalid @enderror">
    @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category" class="form-select @error('category') is-invalid @enderror">
        <option value="">-- Select --</option>
        @foreach (\App\Models\Book::CATEGORIES as $cat)
            <option value="{{ $cat }}" @selected(old('category', $book->category ?? '') === $cat)>{{ $cat }}</option>
        @endforeach
    </select>
    @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

{{-- type="text" on purpose, so bad values reach the server and you can demo server-side validation --}}
<div class="mb-3">
    <label class="form-label">Unit Price (₱)</label>
    <input type="text" inputmode="decimal" name="unit_price"
           value="{{ old('unit_price', $book->unit_price ?? '') }}"
           class="form-control @error('unit_price') is-invalid @enderror">
    @error('unit_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Availability Status</label>
    <select name="availability_status" class="form-select @error('availability_status') is-invalid @enderror">
        @foreach (\App\Models\Book::STATUSES as $status)
            <option value="{{ $status }}" @selected(old('availability_status', $book->availability_status ?? 'Available') === $status)>{{ $status }}</option>
        @endforeach
    </select>
    @error('availability_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<button class="btn btn-dark">Save</button>
<a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>