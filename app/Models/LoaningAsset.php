<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoaningAsset extends Model
{
    /** @use HasFactory<\Database\Factories\LoaningItemFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'lng_ast_id';

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'lng_ast_asset_id', 'ast_id');
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loans::class, 'lng_ast_loan_id', 'ln_id');
    }
}
