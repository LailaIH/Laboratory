<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antibiotic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'user_id', 'abbreviation', 'is_active', 'permissible_age', 'permissible_gender', 'utilization'
    ];
    protected $table = 'antibiotics';


    public function user(){
        return $this->belongsTo(User::class);
    }

  
}
