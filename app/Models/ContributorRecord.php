<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContributorRecord extends Model
{
    /** @use HasFactory<\Database\Factories\ContributorRecordFactory> */
    use HasFactory, SoftDeletes, Blameable;

    protected $guarded = ['id', 'timestamps'];

    public function contributor()
    {
        return $this->belongsTo(Contributor::class);
    }
}
