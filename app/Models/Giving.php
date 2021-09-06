<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giving extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_CREATED = 1;
    public const STATUS_APPROVED = 2;
    public const STATUS_DECLINED = 3;
    public const STATUS_EXPIRED = 4;

    public function getShortDateAttribute()
    {
        return $this->created_at->format('F j, Y');
    }

    public function getLongDateAttribute()
    {
        return $this->created_at->format('l, j \d\e F \d\e Y');
    }

    public function scopeReference($query, $reference)
    {
        return $query->where('reference', $reference);
    }

    public function giver()
    {
        return $this->belongsTo(Giver::class);
    }

    public function type()
    {
        return $this->belongsTo(GivingType::class, 'giving_type_id', 'id');
    }

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
