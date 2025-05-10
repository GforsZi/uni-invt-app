<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoaningItem extends Model
{
    /** @use HasFactory<\Database\Factories\LoaningItemFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];

    public function loanRequest()
    {
        return $this->belongsTo(LoanRequest::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
