<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thirdparty extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
    'user_id'];

    public function test_thirdparties(){
        return $this->hasMany(Test_Thirdparty::class());
    }
}
