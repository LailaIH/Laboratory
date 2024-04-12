<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pationt_id', 'doctor_id', 'branche_id', 'is_online', 'status',
        'institu_id', 'test_id','payment_id','period_time','pation_note'	,'analysis_id',
        'campaign_id','gross_amount','paid_amount','remain_amount','money_note',
        'status','is_online','is_approved','is_approved_doctor',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function institu(){
    return $this->belongsTo(Institu::class);
      }

   

    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
