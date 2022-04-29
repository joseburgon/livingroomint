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
        return ucfirst($this->created_at->isoFormat('MMMM D[,] Y'));
    }

    public function getLongDateAttribute()
    {
        return $this->created_at->isoFormat('dddd[,] D [de] MMMM [de] Y');
    }

    public function getCentsAmountAttribute()
    {
        return (integer) $this->amount * 100;
    }

    public function scopeReference($query, $reference)
    {
        return $query->where('reference', $reference);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_DECLINED)->orWhere('status', self::STATUS_EXPIRED);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->format('m'));
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
