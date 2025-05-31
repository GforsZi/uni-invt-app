<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetDescription extends Pivot
{
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'ast_desc_id';
    protected $blameablePrefix = 'ast_desc_';

    const CREATED_AT = 'ast_desc_created_at';
    const UPDATED_AT = 'ast_desc_updated_at';
    const DELETED_AT = 'ast_desc_deleted_at';

    public $timestamps = false;
}
