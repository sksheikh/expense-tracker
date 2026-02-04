<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'amount', 'date', 'due_date', 'person', 'description', 'is_settled', 'user_id'];

    protected $casts = [
        'date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'is_settled' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
