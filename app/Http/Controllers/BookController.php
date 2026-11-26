<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    // Server-side rules shared by store() and update()
    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(Book::CATEGORIES)],              // only listed categories
            'unit_price' => ['required', 'numeric', 'min:0', 'max:99999999.99'], // rejects text and negatives
            'description' => ['required', 'string'],
            'availability_status' => ['required', Rule::in(Book::STATUSES)],     // only Available / Unavailable
        ];
    }

    // List all books, newest first
    public function index()
    {
        $books = Book::with('user')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        // Business logic: user_id is taken from the logged-in administrator on the server, never from the form
        $request->user()->books()->create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->validate($this->rules()));

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}