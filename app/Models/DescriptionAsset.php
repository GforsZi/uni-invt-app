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
    protected $primaryKey = 'rm_ast_id';
    protected $blameablePrefix = 'rm_ast_';

    const CREATED_AT = 'rm_ast_created_at';
    const UPDATED_AT = 'rm_ast_updated_at';
    const DELETED_AT = 'rm_ast_deleted_at';

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'rm_ast_room_id', 'ast_id');
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'rm_ast_item_id', 'ast_id');
    }
}
