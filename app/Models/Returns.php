<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Returns extends Model
{
    /** @use HasFactory<\Database\Factories\ReturnReguestFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'rtrn_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rtrn_user_id', 'usr_id');
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loans::class, 'rtrn_loan_id', 'ln_id');
    }

    public function returningAssets(): HasMany
    {
        return $this->hasMany(ReturningAsset::class, 'rtrng_ast_return_id', 'rtrn_id');
    }
}
