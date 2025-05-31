<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetOrigin extends Model
{
    /** @use HasFactory<\Database\Factories\ContributorFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'ast_orgn_id';
    protected $blameablePrefix = 'ast_orgn_';

    const CREATED_AT = 'ast_orgn_created_at';
    const UPDATED_AT = 'ast_orgn_updated_at';
    const DELETED_AT = 'ast_orgn_deleted_at';

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'ast_origin_id', 'ast_orgn_id');
    }
}
