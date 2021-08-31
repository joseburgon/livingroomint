<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giver extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
