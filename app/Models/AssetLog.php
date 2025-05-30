<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetLog extends Model
{
    /** @use HasFactory<\Database\Factories\ItemLogFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'ast_lg_id';

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'ast_lg_asset_id', 'ast_id');
    }
}
