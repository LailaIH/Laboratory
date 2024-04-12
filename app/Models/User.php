<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'jobTitle_id',
        'img',
        'is_admin',
        'is_ban',
        'status',
        'is_deleted',
        'phone',
        'city',
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

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

   /* public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }*/

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function test(){
        return $this->hasMany(Test::class);

    }

    public function doctors()
    {
        return $this->hasManyThrough(Doctor::class, Patient::class);
    }

    public function samples(){
        return $this->hasMany(Sample::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

    public function debits(){
        return $this->hasMany(Debit::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function test_thirdparties(){
        return $this->hasMany(Test_Thirdparty::class());
    }

    public function thirdpartis(){
        return $this->hasMany(Thirdparty::class());
    }
}
