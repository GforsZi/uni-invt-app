<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanLocation extends Model
{
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'ln_lctn_id';
    protected $blameablePrefix = 'ln_lctn_';

    const CREATED_AT = 'ln_lctn_created_at';
    const UPDATED_AT = 'ln_lctn_updated_at';
    const DELETED_AT = 'ln_lctn_deleted_at';

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'ln_lctn_location_id', 'lctn_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'ln_lctn_room_id', 'ast_id');
    }

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loans::class, 'ln_lctn_loan_id', 'ln_id');
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'ln_lctn_asset_id', 'ast_id');
    }
}
