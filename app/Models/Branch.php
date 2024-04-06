<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'address', 'code', 'is_online', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function samples(){
        return $this->hasMany(Sample::class);
    }
}
