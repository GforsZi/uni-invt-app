<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Returns extends Model
{
    /** @use HasFactory<\Database\Factories\ReturnReguestFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'rtrn_id';
    protected $blameablePrefix = 'rtrn_';

    const CREATED_AT = 'rtrn_created_at';
    const UPDATED_AT = 'rtrn_updated_at';
    const DELETED_AT = 'rtrn_deleted_at';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rtrn_user_id', 'usr_id');
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loans::class, 'rtrn_loan_id', 'ln_id');
    }

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(
            Asset::class,
            'returning_assets',
            'rtrng_ast_return_id',
            'rtrng_ast_asset_id',
        );
    }

    public function returningAssets(): HasMany
    {
        return $this->hasMany(ReturningAsset::class, 'rtrng_ast_return_id', 'rtrn_id');
    }
}
