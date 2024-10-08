<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmFeesPayment extends Model
{
     protected $fillable = [
        "student_id",
        "amount",
        "payment_date" ,
        "payment_mode",
        'academic_id',
        "created_by",
        "school_id",
        "room_id" ,
        "payment_type",
        "email",
        "receipt",
        "fees_type_id",
        "transaction_id"
    ];

    public function studentInfo(){
    	return $this->belongsTo('App\SmStudent', 'student_id', 'id');
    }

    public function feesType(){
    	return $this->belongsTo('App\SmFeesType', 'fees_type_id', 'id');
    }

    public function feesMaster(){
    	return $this->belongsTo('App\SmFeesMaster', 'fees_type_id', 'fees_type_id');
    }

    public static function discountMonth($discount, $month){
        try {
            return SmFeesPayment::where('active_status',1)->where('fees_discount_id', $discount)->where('discount_month', $month)->first();
        } catch (\Exception $e) {
            $data=[];
            return $data;
        }
    }

    public function scopeOnlyAssigned($query)
	{
		return $query->whereNotNull('assign_id');
	}
}
