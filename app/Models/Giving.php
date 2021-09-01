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

    public function giver()
    {
        return $this->belongsTo(Giver::class);
    }

    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
