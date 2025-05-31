<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];
    protected $primaryKey = 'lctn_id';
    protected $blameablePrefix = 'lctn_';

    const CREATED_AT = 'lctn_created_at';
    const UPDATED_AT = 'lctn_updated_at';
    const DELETED_AT = 'lctn_deleted_at';

    public function loanLocations(): HasMany
    {
        return $this->hasMany(LoanLocation::class, 'ln_lctn_location_id', 'lctn_id');
    }
}
