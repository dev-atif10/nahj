<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'bank_name',
        'account_holder_name',
        'account_number',
        'iban',
        'swift_code',
        'country',
        'branch',
        'is_primary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
