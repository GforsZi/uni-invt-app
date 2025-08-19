<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationAsset extends Pivot
{
    use HasFactory, SoftDeletes, Blameable;
    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'rltn_ast_id';
    protected $blameablePrefix = 'rltn_ast_';
    protected $table = 'relation_assets';

    const CREATED_AT = 'rltn_ast_created_at';
    const UPDATED_AT = 'rltn_ast_updated_at';
    const DELETED_AT = 'rltn_ast_deleted_at';

    public function room(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'rltn_ast_room_id', 'ast_id');
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'rltn_ast_asset_id', 'ast_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'rltn_ast_location_id', 'lctn_id');
    }
}
