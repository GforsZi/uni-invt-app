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

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'ast_origin_id', 'ast_orgn_id');
    }
}
