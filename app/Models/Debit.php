<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'patient_id', 'debit', 'description','is_online', 'status',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
