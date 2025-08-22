<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DescriptionAsset extends Model
{
    /** @use HasFactory<\Database\Factories\DescriptionAssetFactory> */
    use HasFactory, SoftDeletes, Blameable;
    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'desc_ast_id';
    protected $blameablePrefix = 'desc_ast_';

    const CREATED_AT = 'desc_ast_created_at';
    const UPDATED_AT = 'desc_ast_updated_at';
    const DELETED_AT = 'desc_ast_deleted_at';

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'desc_ast_room_id', 'ast_id');
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'desc_ast_item_id', 'ast_id');
    }
}
