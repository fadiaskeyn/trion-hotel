<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cashout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'keterangan',
        'nominal',
        'bukti',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
