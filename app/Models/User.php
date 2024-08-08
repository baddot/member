<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referral_code',
        'referrer_id',
        'balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->referral_code = self::generateReferralCode();
        });
    }

    private static function generateReferralCode()
    {
        do {
            $code = Str::random(12);
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }

    public function downlines()
    {
        return $this->hasMany(User::class, 'referrer_id');
    }

    public function allDownlines()
    {
        $downlines = $this->downlines;
        foreach ($downlines as $downline) {
            $downline->allDownlines();
        }
        return $downlines;
    }

    public function boosters()
    {
        return $this->belongsToMany(Booster::class)->withTimestamps();
    }
}
