<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'analysis_id', 'name', 'description', 'status', 'is_online',
    ];

    protected $casts = [
        'analysis_id' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function samples(){
        return $this->hasMany(Sample::class);
    }

    public function test(){
        return $this->hasMany(Test::class);

    }
}
