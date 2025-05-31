<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturningAsset extends Model
{
    /** @use HasFactory<\Database\Factories\ReturningItemFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'rtrng_ast_id';
    protected $blameablePrefix = 'rtrng_ast_';

    const CREATED_AT = 'rtrng_ast_created_at';
    const UPDATED_AT = 'rtrng_ast_updated_at';
    const DELETED_AT = 'rtrng_ast_deleted_at';

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'rtrng_ast_asset_id', 'ast_id');
    }

    public function return(): BelongsTo
    {
        return $this->belongsTo(Returns::class, 'rtrng_ast_return_id', 'rtrn_id');
    }
}
