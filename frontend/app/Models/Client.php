<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'website',
        'industry',
        'total_projects',
        'total_revenue',
        'last_project_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'total_projects' => 'decimal:2',
        'total_revenue' => 'decimal:2',
        'last_project_date' => 'date',
        'status' => 'string',
    ];

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
