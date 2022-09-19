<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $dates = ['process_date'];

    protected $fillable = [
        'sum',
        'currency',
        'user_id',
        'provider_id',
        'process_date'
    ];

    public function provider()
    {
        return $this->belongsto(Provider::class);
    }
    public function user()
    {
        return $this->belongsto(User::class);
    }
}
