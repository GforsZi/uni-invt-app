<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'ast_id';
    protected $blameablePrefix = 'ast_';

    const CREATED_AT = 'ast_created_at';
    const UPDATED_AT = 'ast_updated_at';
    const DELETED_AT = 'ast_deleted_at';


    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryAsset::class, 'ast_category_id', 'ctgy_ast_id');
    }

    public function origin(): BelongsTo
    {
        return $this->belongsTo(AssetOrigin::class, 'ast_origin_id', 'ast_orgn_id');
    }

    public function parentRelations(): HasMany
    {
        return $this->hasMany(RelationAsset::class, 'rm_ast_item_id', 'ast_id');
    }

    public function childRelations(): HasMany
    {
        return $this->hasMany(RelationAsset::class, 'rm_ast_room_id', 'ast_id');
    }

    public function descriptions(): BelongsToMany
    {
        return $this->belongsToMany(
            DescriptionAsset::class,
            'tb_asset_descriptions',
            'ast_desc_item_id',
            'ast_desc_description_id'
        )->using(AssetDescription::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(AssetLog::class, 'ast_lg_asset_id', 'ast_id');
    }

    public function loaningAssets(): HasMany
    {
        return $this->hasMany(LoaningAsset::class, 'lng_ast_asset_id', 'ast_id');
    }

    public function loanLocations(): HasMany
    {
        return $this->hasMany(LoanLocation::class, 'ln_lctn_asset_id', 'ast_id');
    }

    public function returningAssets(): HasMany
    {
        return $this->hasMany(ReturningAsset::class, 'rtrng_ast_asset_id', 'ast_id');
    }
}
