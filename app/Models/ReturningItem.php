<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturningItem extends Model
{
    /** @use HasFactory<\Database\Factories\ReturningItemFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];

    public function returnRequest()
    {
        return $this->belongsTo(ReturnRequest::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
