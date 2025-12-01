<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles; 


 
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , SoftDeletes ,HasRoles, HasApiTokens;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
 protected $fillable = [
    'name',
    'email',
    'password',
    'nationality',
    'gender',
    'age',
    'passport_number',
    'mobile_number',
    'heir_mobile_number',
    'heir_name',
    'role', // add role
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function bankAccounts()
{
    return $this->hasMany(BankAccount::class);
}

// convenient helpers (اختياري)
public function isAdmin() { return $this->role === 'admin'; }
public function isInvestor() { return $this->role === 'investor'; }
public function isUser() { return $this->role === 'user'; }

}
