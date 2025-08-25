<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loans extends Model
{
    /** @use HasFactory<\Database\Factories\LoanReguestFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'ln_id';
    protected $blameablePrefix = 'ln_';

    const CREATED_AT = 'ln_created_at';
    const UPDATED_AT = 'ln_updated_at';
    const DELETED_AT = 'ln_deleted_at';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ln_user_id', 'usr_id');
    }

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(
            Asset::class,
            'loaning_assets',
            'lng_ast_loan_id',
            'lng_ast_asset_id',
        );
    }

    public function loanLocations(): HasMany
    {
        return $this->hasMany(LoanLocation::class, 'ln_lctn_loan_id', 'ln_id');
    }

    public function returns(): HasMany
    {
        return $this->hasMany(Returns::class, 'rtrn_loan_id', 'ln_id');
    }
}
