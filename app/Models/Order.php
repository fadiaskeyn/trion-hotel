<?php

namespace App\Models;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "invoice",
        "visitor_id",
        "checkin",
        "checkout",
        "extra_bed",
        "rooms",
        "amount",
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}

