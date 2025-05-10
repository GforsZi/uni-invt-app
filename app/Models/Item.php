<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];

    public function categories()
    {
        return $this->belongsToMany(CategoryItem::class, 'item_category');
    }

    public function logs()
    {
        return $this->hasMany(ItemLog::class);
    }

    public function loaningItems()
    {
        return $this->hasMany(LoaningItem::class);
    }

    public function returningItems()
    {
        return $this->hasMany(ReturningItem::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'item_location')
            ->withPivot('many_item')
            ->withTimestamps();
    }
}
