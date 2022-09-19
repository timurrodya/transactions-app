<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use  HasFactory;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function LastTransaction()
    {

        return $this->hasOne(Transaction::class)->orderbydesc('process_date')->with('Provider');
    }
    public function transactions7days()
    {
        $today = Carbon::today();

        return $this->hasMany(Transaction::class)->where('process_date', '>', $today->subDays(7));
    }
}
