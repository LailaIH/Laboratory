<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test_Thirdparty extends Model
{
    use HasFactory;

    protected $table = 'test_thirdparty';

    protected $fillable = [
        'test_id',
        'thirdparty_id',
         'user_id'];

         public function user(){
            return $this->belongsTo(User::class);
         }

         public function test(){
            return $this->belongsTo(Test::class);
         }

         public function thirdparty(){
            return $this->belongsTo(Thirdparty::class);
         }
}
