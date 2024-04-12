<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'acronym',
        'campaign_id',
        'department_id',
        'group_id',
        'price',
        'normal_rate',
        'sample_type',
        'sample_quantity',
        'preservation_type',
        'transfer_type',
        'is_available',
        'results',
        'test_unit',
        'test_importance',
        'sop',
        'machine',
        'doctor_approval_need',
        'manager_approval_need',
        'admin_approval_need',
        'time_needed',
        'user_id',
    ];

    protected $casts = [
        'results' => 'array',
        'test_unit' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function samples(){
        return $this->hasMany(Sample::class);
    }

    public function test_thirdparties(){
        return $this->hasMany(Test_Thirdparty::class());
    }
}
