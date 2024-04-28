<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test_Result extends Model
{
    use HasFactory;
    protected $table = 'test_results';

    protected $fillable = [
        'test_id',
        'result',
         'description',
        'status' , 'is_online'];

        public function test(){

            return $this->belongsTo(Test::class);
        }

      

}
