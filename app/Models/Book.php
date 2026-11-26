<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    // Allowed values: used by validation AND the dropdowns
    public const CATEGORIES = ['Fiction', 'Nonfiction', 'Academic', "Children's Books"];
    public const STATUSES = ['Available', 'Unavailable'];

    protected $fillable = [
        'user_id', 'title', 'author', 'category',
        'unit_price', 'description', 'availability_status',
    ];

    // A Book belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Reusable filter. The report page, PDF and Excel all call this,
     * so category and availability filters work together and exports match.
     */
    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['category'] ?? null, fn ($q, $v) => $q->where('category', $v))
            ->when($filters['availability_status'] ?? null, fn ($q, $v) => $q->where('availability_status', $v));
    }
}