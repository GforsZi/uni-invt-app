<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];

    public function loanLocations()
    {
        return $this->hasMany(LoanLocation::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_location')
            ->withPivot('many_item')
            ->withTimestamps();
    }
}
