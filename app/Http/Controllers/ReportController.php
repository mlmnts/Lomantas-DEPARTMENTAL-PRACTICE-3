<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public const TYPES = [
        'available' => 'Available Books',
        'unavailable' => 'Unavailable Books',
        'by_category' => 'Books by Category',
        'price_list' => 'Book Price List',
    ];

    /**
     * ONE method builds the data for the page, the PDF and the Excel file,
     * so all three always contain the same matching records.
     */
    private function buildReport(Request $request): array
    {
        $filters = $request->validate([
            'type' => ['nullable', Rule::in(array_keys(self::TYPES))],
            'category' => ['nullable', Rule::in(Book::CATEGORIES)],
            'availability_status' => ['nullable', Rule::in(Book::STATUSES)],
        ]);

        $type = $filters['type'] ?? 'price_list';
        $query = Book::with('user');

        // The report type sets the base query
        if ($type === 'available') {
            $query->where('availability_status', 'Available');
        } elseif ($type === 'unavailable') {
            $query->where('availability_status', 'Unavailable');
        }

        // Category and availability dropdowns narrow it further (they work together)
        $query->filter($filters);

        $type === 'by_category'
            ? $query->orderBy('category')->orderBy('title')
            : $query->orderBy('title');

        return [
            'books' => $query->get(),
            'title' => self::TYPES[$type],
            'type' => $type,
            'filters' => $filters,
        ];
    }

    public function index(Request $request)
    {
        return view('reports.index', $this->buildReport($request) + ['types' => self::TYPES]);
    }

    public function pdf(Request $request)
    {
        return Pdf::loadView('reports.pdf', $this->buildReport($request))->download('book-report.pdf');
    }

    public function excel(Request $request)
    {
        $report = $this->buildReport($request);

        return Excel::download(new BooksExport($report['books']), 'book-report.xlsx');
    }
}