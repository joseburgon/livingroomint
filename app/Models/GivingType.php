<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GivingType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const ACTIVE = 1;

    public const INACTIVE = 0;

    public function scopeActive($query)
    {
        return $query->where('active', self::ACTIVE);
    }

    public function givings()
    {
        return $this->hasMany(Giving::class);
    }
}
