<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAsset extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryItemFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'ctgy_ast_id';
    protected $blameablePrefix = 'ctgy_ast_';

    const CREATED_AT = 'ctgy_ast_created_at';
    const UPDATED_AT = 'ctgy_ast_updated_at';
    const DELETED_AT = 'ctgy_ast_deleted_at';

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class, 'ast_category_id', 'ctgy_ast_id');
    }
}
