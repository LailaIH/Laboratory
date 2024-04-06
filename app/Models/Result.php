<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'body', 'is_online', 'status',
        'sample_id', 'is_approved', 'is_approved_doctor',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sample(){
        return $this->belongsTo(Sample::class);
    }
}
