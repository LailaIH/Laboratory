<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'doctor_id', 'name', 'age', 'gender', 'status', 'is_online', 'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function samples(){
        return $this->hasMany(Sample::class);
    }
    public function debits(){
        return $this->hasMany(Debit::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
